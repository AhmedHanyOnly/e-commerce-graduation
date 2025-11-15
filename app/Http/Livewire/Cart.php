<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Order;
use App\Services\StripeService;
use Livewire\Component;
use App\Services\ClickPay;
use Livewire\Attributes\On;
use App\Services\CartService;
use Livewire\WithFileUploads;
use App\Models\BalanceHistory;
use App\Models\ProductVariant;
use App\Services\OrderService;

class Cart extends Component
{
    use WithFileUploads;

    public $screen = 'level-1', $cart;
    protected $listeners = ['refreshComponent' => '$refresh'];
    // order data
    public $first_name, $last_name, $address, $longitude, $latitude, $additional_phone, $phone_code, $total, $delivery_time;
    public $shipping_price, $cash_on_delivery_tax;
    public $payment_method;
    public $subtotal, $selectedSizes = [], $selectedColors = [];
    public $tax;

    // bank_transfer
    public $bank_id, $transfer_img, $transfer_account_number;

    public function render()
    {
        return view('livewire.cart.index')->extends('front.layouts.front')->section('content');
    }

    public function mount()
    {
        $this->cart = CartService::getCart();
        $this->calculateAll();
        foreach ($this->cart->items as $item) {
            if ($item->variant_id) {
                $this->selectedSizes[$item->id] = $item->variant_id;
            }
            $this->selectedColors[$item->id] = $item->color_id;
        }
    }

    public function updateSize($item_id)
    {
        if ($this->selectedSizes[$item_id]) {
            $item = Item::find($item_id);
            $variant = ProductVariant::find($this->selectedSizes[$item->id]);
            $item->variant_id = $variant->id;
            $item->save();
            CartService::updateCalculateForItem($item);
            $this->calculateAll();
        }
    }

    public function updateColor($item_id)
    {
        if ($this->selectedColors[$item_id]) {
            $item = Item::find($item_id);
            $item->update(['color_id' => $this->selectedColors[$item_id]]);
        }
    }

    public function increment($id)
    {
        CartService::increment($id);
        $this->dispatch('productAdded');
        $this->calculateAll();
    }

    public function decrement($id)
    {
        CartService::decrement($id);
        $this->dispatch('productAdded');

        $this->calculateAll();
    }

    public function remove($id)
    {
        CartService::removeFromCart($id);
        $this->dispatch('productAdded');
        $this->calculateAll();
    }

    public function updatedPaymentMethod()
    {
        $this->calculateAll();
    }

    public function back()
    {
        //        $this->dispatch('initMap', lat: $this->latitude, lng: $this->longitude);
        $this->screen = 'level-1';
    }

    public function rules()
    {
        return [
            'total' => 'nullable',
            'cash_on_delivery_tax' => 'nullable',
            'shipping_price' => 'nullable',
            'subtotal' => 'nullable',
            'tax' => 'nullable',
            'payment_method' => $this->screen == 'level-2' ? 'required|in:clickpay,cash,tamara,bank,stc' : 'nullable',
            'bank_id' => $this->screen == 'level-2' ? 'required_if:payment_method,bank' : 'nullable',
            'transfer_img' => $this->screen == 'level-2' ? 'required_if:payment_method,bank' : 'nullable',
            'transfer_account_number' => $this->screen == 'level-2' ? 'required_if:payment_method,bank' : 'nullable'
        ];
    }

    public function setData()
    {
        $data = $this->validate(null, [
            'bank_id.required_if' => 'الحقل الحساب  مطلوب في حال ما إذا كان وسيلة الدفع يساوي حساب بنكي.',
            'transfer_img.required_if' => 'الحقل صورة التحويل  مطلوب في حال ما إذا كان وسيلة الدفع يساوي حساب بنكي.',
            'transfer_account_number.required_if' => 'الحقل رقم الحساب المحول منة مطلوب في حال ما إذا كان وسيلة الدفع يساوي حساب بنكي.',
            'payment_method.required' => 'يرجى اختيار طريقة الدفع.',
        ]);
        $user = auth()->user();
        $data['client_id'] = $user->id;
        $data['city_id'] = $user->city_id;
        $data['neighborhood_id'] = $user->neighborhood_id;
        $data['first_name'] = $user->name;
        $data['last_name'] = $user->name;
        $data['address'] = $user->address;
        $data['additional_phone'] = $user->phone;
        $data['longitude'] = $user->longitude;
        $data['latitude'] = $user->latitude;
        $data['client_id'] = auth()->id();
        return $data;
    }

    public function submit()
    {
        if (!auth()->check()){
            return to_route('login');
        }

        $this->calculateAll();
        $data = $this->setData();
        try {
            \DB::beginTransaction();

            $order = Order::create($data);
            $this->cart->items()->update(['model_type' => 'App\Models\Order', 'model_id' => $order->id]);
            $order->refresh();

            (new OrderService($order))->decrementProductQuantity();
            (new OrderService($order))->addSalesToProduct();


            $url = (new StripeService())->generatePayLink(order: $order);
            if (!$url) {
                \DB::rollBack();
                $this->addError('error', "حدث خطا في عملية الدفع ");
                return;
            }

            \DB::commit();
            return $this->redirect($url);

        } catch (\Exception  $e) {
            \DB::rollBack();
            $this->addError('error', $e->getMessage());
        }
    }

    private function calculateAll()
    {
        $isDigitalProducts = isset($this->cart->items[0]) ? $this->cart->items[0]->product->digital_product : 0;
        $this->total = CartService::getTotal();
        $this->shipping_price = $isDigitalProducts ? 0 : setting('shipping_price');
        $this->subtotal = $this->cart->items->sum('total') - $this->cart->items->sum('tax');
        $this->cash_on_delivery_tax = 0;

        $this->tax = $this->cart->items->sum('tax');

        if ($this->payment_method == 'cash') {
            $this->cash_on_delivery_tax = setting('cash_on_delivery_tax');
            $this->total += $this->cash_on_delivery_tax;
        }
    }

    public function changeScreen()
    {
        $validationRules = [
            'selectedSizes.*' => 'required',
        ];

        foreach ($this->cart->items as $item) {
            if ($item->product->colors()->exists() || ($item->variant_id && $item->variant->colors()->exists())) {
                $validationRules['selectedColors.' . $item->id] = 'required';
            }
        }

        $this->validate($validationRules, [
            'selectedColors.*.required' => 'اللون مطلوب'
        ]);

        if (auth()->check()) {
            $unavailable_products = [];
            $digital_products = [];
            $notDigitalProducts = [];
            foreach ($this->cart->items as $item) {
                if ($item->product->digital_product) {
                    $digital_products[] = $item->product->name;
                } else {
                    $notDigitalProducts[] = $item->product->name;
                }
                if (!CartService::checkProductAvailable($item->product_id, $item->qty)) {
                    $unavailable_products[] = $item->product->name;
                }
            }
            if (count($unavailable_products)) {
                $msg = "المنتج $unavailable_products[0] غير متوفر في المخزون حاليا قم بازالته للاستكمال ";
                $this->dispatch('alert', type: 'error', message: $msg);
                return 0;
            }
            if (count($digital_products) && count($notDigitalProducts)) {
                $msg = "لا يمكنك شراء منتج رقمي مع منتج عادي";
                $this->dispatch('alert', type: 'error', message: $msg);
                return 0;
            }
            if (!auth()->user()->profile_complete) {
                return to_route('profile')->with('error', 'قم باكمال بياناتك اولا');
            }

            $this->screen = 'level-2';
            return;
        } else {
            session()->put('redirect', route('cart'));
            return to_route('login');
        }
    }

    private function payWithClickPay($total)
    {
        $user = auth()->user();
        $payment = new ClickPay();
        $response = $payment->pay($total, $user->id, $user->name, $user->name, $user->email, $user->phone ?? '11');
        return $response;
    }

    private function payWithBank(Order $order)
    {
        $order->update([
            'bank_id' => $this->bank_id,
            'transfer_img' => store_file($this->transfer_img, 'transfer_images'),
            'transfer_account_number' => $this->transfer_account_number
        ]);
    }
}
