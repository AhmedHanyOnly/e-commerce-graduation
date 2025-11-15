<?php

namespace App\Services;

use App\Models\Order;
use App\Models\BalanceHistory;

class OrderService
{
    public $order, $distance, $car;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->distance = $this->order->distance;
        $this->car = $this->order->driver?->carType;
    }

    public function calculateShippingPrice()
    {
        $driver = $this->order->driver;
        $car = $driver->carType;
        $ship_tax = $car->commission;
        return ceil($this->distance) * $car->kilo_price;
    }

    public function calculateShippingTax()
    {
        $car = $this->car;
        return round($car->commission / 100 * $this->calculateShippingPrice(), 2);
    }

    public function addBalanceToEveryVendor()
    {
        $items = $this->order->items;
        // check if their product not belongs to order vendor and pay another vendors

        $vendors_items = $this->order->items;
        if ($vendors_items->count()) {
            foreach ($vendors_items as $item) {
                $vendor = $item->product->user;

                if ($item->vendor_id == $this->order->vendor_id) {
                    $total = $this->order->vendor_total;
                    if ($total) {
                        BalanceHistory::action(
                            $this->order->vendor,
                            $total,
                            true,
                            " تم اضافه   $total لرصيدك ",
                            $this->order->id
                        );
                    }
                } else {
                    BalanceHistory::action(
                        $vendor,
                        $item->total,
                        true,
                        "  تم اضافة$item->total لرصيدك من شراء المنتج رقم $item->product_id  ",
                        $this->order->id
                    );
                }
            }
        }
    }
    public function returnProductQuantity()
{
    $items = $this->order->items;

    foreach ($items as $item) {
        $product = $item->product;

        // لا تعيد الكمية إذا كان المنتج رقمي أو لا يحتاج إلى كمية
        if (!$product->no_quantity && !$product->digital_product) {
            $product->increment('quantity', $item->qty);
        }

        // لو المنتج له variant
        if ($item->variant_id && $item->variant) {
            $item->variant->increment('quantity', $item->qty);
        }
    }
}


    public function decrementProductQuantity()
    {
        $items = $this->order->items;
        foreach ($items as $item) {
            $product = $item->product;
            if (!$product->no_quantity) {
                $product->update(['quantity' => $product->quantity - $item->qty]);
            }
            if ($item->product->digital_product) {
                $item->product->update(['active' => 0]);
            }
        }
    }

    public function addSalesToProduct()
    {
        $items = $this->order->items;
        foreach ($items as $item) {
            $product = $item->product;
            if ($product->digital_product) {
                if (!!$product->sales_count) {
                    $product->update(['sales_count' => (int) $product->sales_count + $item->qty]);
                }
            } else {
                $product->update(['sales_count' => (int) $product->sales_count + $item->qty]);
            }
        }
    }

    public function makeOrderDoneForDriver()
    {
        $order = $this->order;
        $order->status = /*'assigned_to_driver'*/
            'done';
        $order->paid_at = now();
        $order->save();
        $this->addBalanceToEveryVendor();
    }
}
