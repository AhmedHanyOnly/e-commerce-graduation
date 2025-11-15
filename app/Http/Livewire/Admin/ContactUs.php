<?php

namespace App\Http\Livewire\Admin;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\livewireResource;

class ContactUs extends Component
{
    use WithPagination, livewireResource;
    public  $search;
    public function rules()
    {
        return [

        ];
    }

    public function setModelName()
    {
        $this->model = 'App\Models\ContactUs';
    }
    public function render()
    {
        $contactuses = \App\Models\ContactUs::latest()->where(function ($q) {
            if ($this->search) {
                $q->where('name', 'LIKE', "%$this->search%")
                ->orwhere('phone', 'LIKE', "%$this->search%")
                    ->orwhere('email', 'LIKE', "%$this->search%")
                    ->orwhere('message', 'LIKE', "%$this->search%");
            }

        })->paginate(10);
        // $this->emit('classicEditor');
        return view('livewire.admin.contact_us', compact('contactuses'))->extends('admin.layouts.admin')->section('content');
    }



}
