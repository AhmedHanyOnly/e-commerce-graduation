<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Exports\OrderExport;
use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $refused_reason, $search;
    //filters
    public $filter_status, $filter_category, $filter_city, $filter_place, $filter_client, $filter_driver;
    //data
    public $categories, $cities;
    protected $queryString = ['filter_status'];

    public function render()
    {
        $orders = Order::with('client', 'category')
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
    $query->whereHas('items.product', function ($q) {
        $q->where('category_id', $this->filter_category);
    });
}
                if ($this->filter_place) {
                    $query->where('place', $this->filter_place);
                }
                if ($this->filter_client) {
                    $query->where('client_id', $this->filter_client);
                }

                if ($this->filter_driver) {
                    $query->where('driver_id', $this->filter_driver);
                }
            })->when(request('product_id'), function ($q) {
                $q->whereHas('items', function ($query) {
                    $query->where('product_id', request('product_id'));
                });
            })->latest()->paginate(10);
        return view('livewire.admin.orders.index', compact('orders'))
            ->extends('admin.layouts.admin')
            ->section('content');
    }

    public function mount()
    {
        $this->categories = Category::active()->get();
        $this->cities = City::get();
        $this->filter_city = request('city_id') ?? '';
        $this->filter_category = request('category_id') ?? '';
        $this->filter_client = request('client_id') ?? '';
        $this->filter_driver = request('driver_id') ?? '';
    }

    public function delete(Order $order)
    {
        $order->delete();
        session()->flash('success', 'تم الحذف بنجاح');
    }

    public function accept($id)
    {
        try {
            DB::beginTransaction();
            $order = Order::find($id);
            (new OrderService($order))->addSalesToProduct();
            $order->status = 'accepted';
            $order->save();
            session()->flash('success', 'تم الموافقه بنجاح');
            DB::commit();
        } catch (\Exception  $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

   public function refuse($id)
{
    $this->validate(['refused_reason' => 'required']);
    $order = Order::find($id);

    (new OrderService($order))->returnProductQuantity();

    $order->status = 'refused';
    $order->refused_reason = $this->refused_reason;
    $order->save();

    session()->flash('success', 'تم رفض الطلب');
}

    public function export()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }
}
