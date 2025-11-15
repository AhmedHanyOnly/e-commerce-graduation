<?php

namespace App\Http\Livewire\Admin;

use App\Exports\OrderExport;
use App\Models\Category;
use App\Models\City;
use App\Models\GardenType;
use App\Models\Maintenance;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Maintenances extends Component
{
    public $refused_reason, $search, $order, $distance, $tax, $shipping_price, $total, $subtotal;
    //filters
    public $filter_status, $filter_category, $filter_garden_type, $filter_city,
        $filter_place, $filter_client, $filter_vendor,
        $filter_driver;
    //data
    public $categories, $cities, $gardenTypes;

    public function render()
    {
        $orders = Maintenance::with('client', 'category')
            ->where(function (Builder $query) {
                if ($this->search) {
                    $query->where('number', $this->search)
                        ->orWhereRelation('client', 'name', 'like', "$this->search")
                        ->orWhereRelation('client', 'phone', 'like', "$this->search");
                }
                if ($this->filter_status) {
                    $query->where('status', $this->filter_status);
                }
                if ($this->filter_city) {
                    $query->where('city_id', $this->filter_city);
                }
                if ($this->filter_category) {
                    $query->where('category_id', $this->filter_category);
                }
                if ($this->filter_garden_type) {
                    $query->where('garden_type_id', $this->filter_garden_type);
                }
                if ($this->filter_place) {
                    $query->where('place', $this->filter_place);
                }
                if ($this->filter_client) {
                    $query->where('client_id', $this->filter_client);
                }
                if ($this->filter_vendor) {
                    $query->where('vendor_id', $this->filter_vendor);
                }
                if ($this->filter_driver) {
                    $query->where('driver_id', $this->filter_driver);
                }
            })->latest()->paginate(10);
        return view('livewire.admin.maintenances.index', compact('orders'))
            ->extends('admin.layouts.admin')
            ->section('content');
    }

    public function updated($attr)
    {
        $col = 'shipping_price' || 'total' || 'tax' || 'subtotal';
        if ($attr == $col){
            $this->total =$this->subtotal + $this->tax + $this->shipping_price;
        }
    }

    public function mount()
    {
        $this->categories = Category::get();
        $this->gardenTypes = GardenType::get();
        $this->cities = City::get();
        $this->filter_city = request('city_id') ?? '';
        $this->filter_category = request('category_id') ?? '';
        $this->filter_garden_type = request('gardenType_id') ?? '';
        $this->filter_client = request('client_id') ?? '';
        $this->filter_vendor = request('vendor_id') ?? '';
        $this->filter_driver = request('driver_id') ?? '';
    }

    public function delete(Maintenance $order)
    {
        $order->delete();
        session()->flash('success', 'تم الحذف بنجاح');
    }

    public function accept($id)
    {
        $order = Maintenance::find($id);
        $order->status = 'accepted_by_admin';
        $order->save();
        session()->flash('success', 'تم الموافقه بنجاح');
    }

    public function makeOrderForAdmin(Maintenance $order)
    {
        $order->status = 'assigned_to_admin';
        $order->is_by_admin =1;
        $order->save();
        session()->flash('success', 'تم تحويل الطلب للادارة بنجاح');
    }

    public function refuse($id)
    {
        $this->validate(['refused_reason' => 'required']);
        $order = Maintenance::find($id);
        $order->status = 'refused';
        $order->refused_reason = $this->refused_reason;
        $order->save();
        session()->flash('success', 'تم رفض الطلب');
    }

    public function transfer_to_vendors(Maintenance $order)
    {
        $order->status = 'waiting_for_vendors';
        $order->save();
        session()->flash('success', 'تم تحويل الطلب للمزودين');
    }
    public function transfer_to_drivers(Maintenance $order)
    {
        $order->status = 'waiting_for_drivers';
        $order->driver_type =$order->is_by_admin ? 'platform_driver' : 'vendor_driver';
        $order->save();
        session()->flash('success', 'تم تحويل الطلب للمزودين');
    }

    public function ItemId(Maintenance $order)
    {
        $this->order = $order;
        $this->distance = calculateDistanceInKmforUsers(auth()->user(), $order);
    }

    public function send_offer(Maintenance $order)
    {
        $order->tax = $this->tax;
        $order->distance = $this->distance;
        $order->total = $this->total;
        $order->shipping_price = $this->shipping_price;
        $order->subtotal = $this->subtotal;
        $order->status ='wait_for_accept_offer_by_client';
        $order->save();
        session()->flash('success', 'تم ارسال طلب السعر');

    }

    public function export()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }
}
