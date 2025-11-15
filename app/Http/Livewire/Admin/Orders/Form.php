<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Category;
use App\Models\City;
use App\Models\Neighborhood;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Traits\livewireResource;
use Livewire\Component;

class Form extends Component
{
    use livewireResource;

    public $category_id, $distance, $city_id, $longitude, $latitude,
        $client_id, $description, $image, $driver_id, $status = 'accepted', $total = 0, $tax = 0
        /*$delivery_time*/, $neighborhood_id, $order, $place, $subtotal;

    public $categories, $cities, $shipping_price, $shipping_tax, $address,$payment_status, $p_search;

    public $clients = [], $items = [], $drivers = [], $neighborhoods = [], $products = [];

    public $driver;

    public function rules()
    {
        return [
            'category_id' => 'required',
            'distance' => 'required',
            'city_id' => 'required',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
            'client_id' => 'required',
            'description' => 'required',
            'image' => 'nullable',
             'driver_id' => 'nullable',
            'status' => 'required',
            'total' => 'required',
            'tax' => 'required',
//            'delivery_time' => 'required',
            'neighborhood_id' => 'nullable',
            'place' => 'required',
            'subtotal' => 'nullable',
            'shipping_tax' => 'nullable',
            'shipping_price' => 'nullable',
            'address' => 'nullable',
            'payment_status' => 'nullable',

        ];
    }

    public function updated($attr)
    {
        $this->calculate_all();
        $this->dispatch('refreshSelect2');
        if ($this->latitude && $this->longitude) {
            $response = \Http::get("https://nominatim.openstreetmap.org/reverse?lat=$this->latitude&lon=$this->longitude&format=json");
            if ($response->successful()) {
                $this->address = $response['address']['state'] ?? '';
            }
        }
    }

    public function updatedDriverId($val)
    {
        if ($val) {
            $this->driver = User::find($this->driver_id);
        }
    }
    public function updatedCityId($val)
    {
        if ($val) {
            $this->drivers = User::drivers()->active()
                ->where('neighborhood_id', $this->neighborhood_id)
                ->orWhere('city_id', $this->city_id) //->where('can_serve', "all")
                ->pluck('name', 'id')->toArray();
            $this->neighborhoods = Neighborhood::latest()->where('city_id', $this->city_id)->pluck('name', 'id')->toArray();;
        }
    }

    public function updatedNeighborhoodId($val)
    {
        if ($val) {

            $this->drivers = User::drivers()->active()
                ->where('neighborhood_id', $this->neighborhood_id)
                ->orWhere('city_id', $this->city_id)//->where('can_serve', "all")
                ->pluck('name', 'id')->toArray();
            $this->clients = User::clients()->active()->where('neighborhood_id', $this->neighborhood_id)
                ->pluck('name', 'id')->toArray();
            //            $this->products = Product::active()->whereRelation('user', 'city_id',$this->neighborhood_id)
            //                ->latest()->when($this->p_search,fn($q)=>$q->where('name','like',"$this->p_search"))
            //                ->get();
        }
    }

    //    public function addToItems(Product $product)
    //    {
    //        $this->items[] =[
    //            'product_id' =>$product->id,
    //            'qty' =>1,
    //            'total' =>$product->sell_price,
    //            'vendor_id' =>$product->user_id
    //        ];
    //    }
    public function setModelName()
    {
        $this->model = 'App\Models\Order';
    }

    public function mount($id = null)
    {
        if ($id) {
            $this->obj = Order::find($id);
            $array = array_keys($this->rules());
            foreach ($array as $key) {
                $this->$key = $this->obj->$key;
            }
            $this->items = $this->obj->items()->pluck('product_id')->toArray();
             $this->driver = $this->driver_id ? User::find($this->driver_id) : null;
        }
        $categoriesParent = Category::whereNull('parent_id')->whereStatus(1)->get();
        $categoriesChildren = Category::whereNotNull('parent_id')->whereRelation('parent', 'status', 1)->whereStatus(1)->get();

        $this->categories = $categoriesParent->merge($categoriesChildren);
        $this->cities = City::get();
    }

    public function beforeValidate()
    {
        $this->dispatch('refreshSelect2');
    }

    public function beforeSubmit()
    {

        if ($this->image) {
            if ($this->obj) {
                if ($this->obj->image !== $this->image) {
                    delete_file($this->obj->image);
                    $this->data['image'] = store_file($this->image, 'order_images');
                }
            } else {
                $this->data['image'] = store_file($this->image, 'order_images');
            }
        }

        if ($this->driver_id) {
            $this->data['status'] = 'in_progress';
        }
    }


    public function afterSubmit()
    {
        //        foreach ($this->items as $item) {
        //            $product = Product::find($item);
        //            $this->obj->items()->create([
        //                'product_id' => $product->id,
        //                'qty' => 1,
        //                'total' => $product->sell_price,
        //                'tax' => 0,
        //                'vendor_id' => $product->user_id
        //            ]);
        //        }
        return to_route('admin.orders');
    }



    private function calculate_all()
    {
        $distance = 0;
        $shipping_price = 0;
        $tax = 0;

        if ($this->driver) {
            $driver = $this->driver;
            $car = $driver->carType;
            $ship_tax = $car->commission;
            $shipping_price = ceil($distance) * $car->kilo_price;
            $tax = round($ship_tax / 100 * $shipping_price, 2);
        }
        // it 1 qty for now
        $subtotal = Product::whereIn('id', $this->items)->sum('sell_price');
        //
        $this->distance = $distance;
        $this->total = $subtotal + $shipping_price;
        $this->shipping_price = $shipping_price;
        $this->shipping_tax = $tax;
        $this->subtotal = $subtotal;
    }

    public function render()
    {
        return view('livewire.admin.orders.form');
    }
}
