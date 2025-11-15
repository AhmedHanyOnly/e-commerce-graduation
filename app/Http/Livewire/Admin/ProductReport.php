<?php

namespace App\Http\Livewire\Admin;

use App\Models\Item;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductReportExport;


class ProductReport extends Component
{
    public $search = '';



   public function exportExcel()
{
    return Excel::download(new ProductReportExport($this->search), 'تقرير_المنتجات.xlsx');
}

    public function render()
    {
        $items = Item::with(['product', 'item' => function ($q) {
            $q->with('client'); 
        }])
            ->where('model_type', 'App\Models\Order')
            ->when($this->search, function ($q) {
                $q->whereHas('product', function ($q2) {
                    $q2->where('name', 'like', '%' . $this->search . '%');
                })->orWhereHasMorph(
                    'item',
                    [\App\Models\Order::class],
                    function ($q3) {
                        $q3->whereHas('client', function ($q4) {
                            $q4->where('name', 'like', '%' . $this->search . '%');
                        });
                    }
                );
            })
            ->latest()
            ->paginate(10);
  // إجماليات الصف الحالي
    $totalAmount = $items->sum('total');
    $totalQty = $items->sum('qty');

    return view('livewire.admin.product-report', compact('items', 'totalAmount', 'totalQty'))
        ->extends('admin.layouts.admin')
        ->section('content');
    }
}
