<?php

namespace App\Http\Livewire\Admin;

use App\Models\BankAccount;
use App\Models\User;
use App\Traits\livewireResource;
use Livewire\Component;

class BankAccounts extends Component
{
    use livewireResource;

    public $bank_name, $owner_name, $number, $iban, $image, $active = true;

    public function rules()
    {
        return [
            'bank_name' => 'required',
            'owner_name' => 'required',
            'number' => 'required',
            'iban' => 'required',
            'image' => 'nullable',
            'active' => 'boolean',
        ];
    }

    public function toggle(BankAccount $bank)
    {
        $bank->active = !$bank->active;
        $bank->save();
        $this->dispatch('alert', type: 'success', message: 'تم التعديل بنجاح');
    }

    public function beforeSubmit()
    {
        if ($this->image) {
            if ($this->obj) {
                if ($this->obj->image !== $this->image) {
                    delete_file($this->obj->image);
                    $this->data['image'] = store_file($this->image, 'bank_accounts');
                }
            } else {
                $this->data['image'] = store_file($this->image, 'bank_accounts');
            }
        }
    }

    public function render()
    {
        $banks = BankAccount::latest()->paginate(10);
        return view('livewire.admin.banks.index', compact('banks'))->extends('admin.layouts.admin')->section('content');
    }
}
