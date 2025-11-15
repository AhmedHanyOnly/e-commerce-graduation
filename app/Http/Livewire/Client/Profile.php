<?php

namespace App\Http\Livewire\Client;

use App\Models\City;
use App\Models\Order;
use Livewire\Component;
use App\Models\Category;
use App\Models\Neighborhood;
use Livewire\WithFileUploads;
use App\Models\BalanceHistory;
use App\Models\Ticket;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    use WithFileUploads;

    public $user_id, $name, $email, $password, $logo, $city_id, $image, $phone, $neighborhood_id, $address;
    public $screen = 'profile', $garden_types;
    public $data, $user;
    protected $queryString = ['screen'];
    protected $listeners = ['refreshComponents' => '$refresh'];
    // orders
    public $garden_type_id, $category_id,
        $garden_status, $garden_type, $delivery_type,
        $place, $description, /*$address*/ $garden_space, $delivery_time, $longitude, $latitude, $rate, $comment, $filter_status, $ticket_status;
    //balance
    public $amount, $filter_maintenance_status;
    public string $title;

    protected function rules()
    {
        return [
            'name' => 'required',
            'phone' => ['required', 'unique:users,phone,' . $this->user?->id, 'digits:9'],
            'email' => ['nullable', 'unique:users,email,' . $this->user?->id],
            'image' => 'nullable',
            'password' => 'nullable',
            'address' => 'nullable',
            'city_id' => 'nullable',
            'neighborhood_id' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ];
    }

    public function mount()
    {
        $this->user = auth()->user();
        $this->setScreenData();

        if ($this->screen == 'orders') {
            $this->title = "طلباتي";
        } elseif ($this->screen == 'balance') {
            $this->title = "محفظتي";
        } else {
            $this->title = "الملف الشخصي";
        }
    }

    public function updatedScreen()
    {
        if ($this->screen != 'profile') {
            $this->resetExcept('screen', 'user');
            
        }
        if ($this->screen == 'orders') {
            $this->title = "طلباتي";
        } elseif ($this->screen == 'balance') {
            $this->title = "محفظتي";
        } elseif ($this->screen == 'create-order') {
            $this->title = "اضافة طلب";
        } else {
            $this->title = "الملف الشخصي";
                    $this->setScreenData();

        }
    }

    public function setScreenData()
    {
        $this->user->refresh();
        $keys = $this->rules();
        unset($keys['password']);
        $keys = array_keys($keys);
        foreach ($keys as $key) {
            $this->{$key} = $this->user->{$key};
        }
        // dd($this->latitude , $this->longitude);
        // $this->garden_types = $this->user->gardens()->pluck('garden_type_id')->toArray();
    }

    public function render()
    {
        $categories = Category::active()->get();
        $cities = City::latest()->pluck('name', 'id')->toArray();
        $neighborhoods = Neighborhood::latest()->where('city_id', $this->city_id)->pluck('name', 'id')->toArray();
        $orders = Order::whereClientId(auth()->id())->where(function ($q) {
            if ($this->filter_status) {
                $q->where('status', $this->filter_status);
            }
        })->latest()->paginate(10);

        $transactions = BalanceHistory::where('user_id', auth()->id())->paginate(10);
        $tickets = Ticket::where('user_id', auth()->user()->id)->where(function ($q) {
            if ($this->ticket_status) {
                $q->where('status', $this->ticket_status);
            }
        })->paginate(10);
        return view('livewire.client.profile', compact('cities', 'orders', 'neighborhoods', 'transactions', 'categories', 'tickets'))->extends('front.layouts.front')->section('content');
    }

    public function submit()
    {
        $this->data = $this->validate();
        
        $this->beforeSubmit();
        auth()->user()->update($this->data);

        $this->reset('data');
        session()->flash('success', 'تم الحفظ بنجاح');
    }

    public function submitAddress()
    {
        $this->data = $this->validate([
            'address' => 'required',
            'city_id' => 'required',
            'neighborhood_id' => 'required',
        ]);
        auth()->user()->update($this->data);

        $this->reset('data');
        session()->flash('success', 'تم الحفظ بنجاح');
    }

    /* Start Order */
    //    public function submitOrder()
    //    {
    //        $data = $this->validate([
    //            'city_id' => 'required',
    //            'neighborhood_id' => 'required',
    //            'garden_type_id' => 'required',
    //            'garden_status' => 'required',
    //            'delivery_time' => 'required',
    //            'longitude' => 'required',
    //            'latitude' => 'required',
    //            'garden_space' => 'required',
    //            'image' => 'nullable',
    //            'description' => 'nullable',
    //            'address' => 'required',
    //            'category_id' => 'required'
    //        ]);
    //        $data['client_id'] = auth()->id();
    //        if ($this->image) {
    //            $data['image'] = store_file($this->image, 'order_images');
    //        }
    //        Maintenance::create($data);
    //        $this->dispatch('alert', type: 'success', message: 'تم اضافة الطلب بنجاح');
    //        $this->screen = 'orders';
    //    }
    //
    //
    //    public function acceptOffer(Maintenance $maintenance)
    //    {
    //        $maintenance->status = 'accepted_by_client';
    //        $maintenance->save();
    //        $this->dispatch('alert', type: 'success', message: 'تم الموافقة علي عرض السعر بنجاح');
    //    }
    //
    //    public function refuseOffer(Maintenance $maintenance)
    //    {
    //        if ($maintenance->vendor_id) {
    //            $maintenance->status = 'waiting_for_vendors';
    //            $maintenance->vendor_id = null;
    //        } else {
    //            // client refuse admin offer , so it returned again to admin to transfer it to vendors , or he takes it with different offer
    //            $maintenance->status = 'accepted_by_admin';
    //            $maintenance->is_by_admin = 0;
    //        }
    //        $maintenance->tax = 0;
    //        $maintenance->subtotal = 0;
    //        $maintenance->shipping_price = 0;
    //        $maintenance->total = 0;
    //        $maintenance->distance = 0;
    //        $maintenance->save();
    //        $this->dispatch('alert', type: 'success', message: 'تم رفض عرض السعر بنجاح');
    //    }


    // public function add_rate($id,$type)
    // {
    //     $item = $type == 'order' ? Order::find($id) : Maintenance::find($id);
    //    if ($item->is_rated_by_user(auth()->id())){
    //        $this->dispatch('alert', type: 'error', message: 'لقد قمت بالتقييم بالفعل');
    //        return 0;
    //    }

    //     $item->rates()->create([
    //         'user_id' => auth()->id(),
    //         'rate' => $this->rate,
    //         'comment' => $this->comment
    //     ]);

    //     $this->dispatch('alert', type: 'success', message: 'تم التقييم بنجاح شكرا لك');

    // }

    /* End Order*/
    public function add_rate(Order $order)
    {
        $data = $this->validate(['rate' => 'required', 'comment' => 'required']);
        $data['user_id'] = auth()->id();
        $order->rates()->create($data);
        $this->dispatch('alert', type: 'success', message: "تم التقييم بنجاح");
    }
    public function add_balance()
    {
        $this->validate(['amount' => 'required']);
        BalanceHistory::action(auth()->user(), $this->amount, true);
        $this->dispatch('alert', type: 'success', message: 'تم اضافة الرصيد بنجاح');
        $this->dispatch('refreshComponents');
    }

    public function beforeSubmit()
    {
        if ($this->password) {
            $this->data['password'] = Hash::make($this->password);
        } else {
            $this->data['password'] = $this->user->password;
        }
        if ($this->image) {
            if ($this->user?->image != $this->image) {
                if ($this->user) {
                    delete_file($this->user->image);
                }
                $this->data['image'] = store_file($this->image, 'vendors');
            }
        } else {
            unset($this->data['image']);
        }
    }
}
