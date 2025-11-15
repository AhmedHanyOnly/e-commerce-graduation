<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductReportExport implements FromCollection, WithHeadings
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return Item::with(['product', 'item.client'])
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
            ->get()
            ->map(function ($item) {
                return [
                    'client' => $item->item?->client?->name ?? '',
                    'product' => $item->product?->name ?? '',
                    'date' => $item->created_at->format('Y-m-d'),
                    'sell_price' => $item->product?->sell_price ?? 0,
                    'qty' => $item->qty,
                    'delivery_method' => $item->item?->delivery_method ?? '',
                    'payment_method' => $item->item?->payment_method ?? '',
                ];
            });
    }

    public function headings(): array
    {
        return ['العميل', 'المنتج', 'تاريخ البيع', 'سعر البيع', 'الكمية', 'التوصيل', 'طريقة الدفع'];
    }
}
