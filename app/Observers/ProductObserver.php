<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    private function resetCache()
    {
        Cache::forget('latest-products');
        Cache::forget('offer-products');
        Cache::forget('other-products');
    }

    public function created()
    {
        $this->resetCache();
    }
    public function updated()
    {
        $this->resetCache();
    }

    public function deleted()
    {
        $this->resetCache();
    }
}
