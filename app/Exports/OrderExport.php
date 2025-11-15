<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Order::with('client', 'city')->get()->map(function (Order $order) {
            return [
                'number' => $order->number,
                'client' => $order->client?->name,
                'city' => $order->city?->name,
                'payment_method' => __($order->payment_method),
                'status' => __($order->status),
                'shipping_price' => $order->shipping_price,
                'shipping_tax' => $order->shipping_tax,
                'subtotal' => $order->subtotal,
                'tax' => $order->tax,
                'total' => $order->total,
                'created_at' => format_date_time($order->created_at),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'رقم الطلب',
            'اسم العميل',
            'المدينة',
            'طريقة الدفع',
            'الحالة',
            'سعر التوصيل',
            'ضريبة التوصيل',
            'الإجمالي',
            'الضريبة',
            'الإجمالي شامل الضريبة',
            'تاريخ الطلب',
        ];
    }
}
