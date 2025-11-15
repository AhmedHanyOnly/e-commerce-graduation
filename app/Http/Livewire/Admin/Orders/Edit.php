<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\City;
use App\Models\User;
use App\Models\Order;
use Livewire\Component;
use App\Models\Neighborhood;

class Edit extends Component
{
    public $order, $client_id, $city_id, $neighborhood_id, $tax, $payment_status,$shipping_price, $shipping_tax, $subtotal, $total, $status, $refused_reason, $first_name, $last_name, $additional_phone, /*$delivery_time,*/ $address, $items = [], $neighborhoods = [], $cash_on_delivery_tax;

    public function rules()
    {
        return [
            'client_id' => 'required',
            'city_id' => 'required',
            'neighborhood_id' => 'required',
            'tax' => 'required|numeric',
            'shipping_price' => 'required|numeric',
            'shipping_tax' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'total' => 'required|numeric',
            'cash_on_delivery_tax' => 'required|numeric',
            'status' => 'required',
            'refused_reason' => 'nullable',
            /*'delivery_time' => 'required',*/
            'address' => 'nullable',
            'items' => 'required',
            'payment_status' => 'nullable',

            
        ];
    }

    public function mount(Order $order)
    {
        $this->order = $order;

        $data = array_keys($this->rules());

        foreach ($data as $key) {
            $this->$key = $order->$key;
        }

        $this->neighborhoods = Neighborhood::latest()->where('city_id', $this->city_id)->get();
        $this->items = $order->items->toArray();
    }

    public function updatedCityId()
    {
        if ($this->city_id) {
            $this->neighborhoods = Neighborhood::latest()->where('city_id', $this->city_id)->get();
        } else {
            $this->neighborhoods = [];
        }
    }

    public function render()
    {
        $clients = User::clients()->active()->get();
        $cities = City::get();
        return view('livewire.admin.orders.edit', compact('clients', 'cities'))->extends('admin.layouts.admin')->section('content');
    }

    public function save()
    {
        $data = $this->validate();

        unset($data['items']);
        // dd($data);
        $this->order->update($data);

        session()->flash('success', 'تم الحفظ بنجاح');

        return to_route('admin.orders');
    }
}
