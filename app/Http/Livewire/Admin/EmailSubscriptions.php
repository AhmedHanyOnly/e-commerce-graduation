<?php

namespace App\Http\Livewire\Admin;

use App\Models\EmailSubscription;
use App\Traits\livewireResource;
use Livewire\Component;

class EmailSubscriptions extends Component
{
    use livewireResource;

    public $search;

    public function rules()
    {
        return [];
    }
    public function render()
    {
        $mails = EmailSubscription::when($this->search, fn($q) => $q->where('email', 'like', "%$this->search%"))->paginate(10);
        return view('livewire.admin.email-subscriptions', compact('mails'))->extends('admin.layouts.admin')->section('content');
    }
}
