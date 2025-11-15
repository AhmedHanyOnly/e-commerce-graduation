<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\Neighborhood;
use App\Models\User;
use App\Traits\livewireResource;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class VendorForm extends Component
{
    use livewireResource;
    public $user_id, $name, $email, $password, $type = 'vendor', $logo, $city_id, $image, $phone, $neighborhood_id, $bank_account, $commercial_record_image, $commercial_record_number;
    public $search, $filter_active, $filter_city, $from_time, $to_time;
    public $vendor;
    public $latitude,
        $longitude;

    protected function rules()
    {
        return [
            'name' => ['string', 'required'],
            'password' => ['required_without:obj'],
            'email' => ['nullable', 'email', 'unique:users,email,' . $this->vendor?->id],
            'type' => ['nullable'],
            'city_id' => 'required',
            'neighborhood_id' => 'required',
            'bank_account' => 'nullable',
            'commercial_record_image' => 'nullable',
            'commercial_record_number' => 'nullable',
            'image' => 'nullable',
            'logo' => 'nullable',
            'phone' => 'required|unique:users,phone,' . $this->vendor?->id,
            'from_time' => 'nullable',
            'to_time' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ];
    }
    public function setModelName()
    {
        $this->model = 'App\Models\User';
    }

    public function beforeSubmit()
    {
        if ($this->password) {
            $this->data['password'] = Hash::make($this->password);
        } else {
            $this->data['password'] = $this->vendor->password;
        }
        if ($this->image) {
            if ($this->obj?->image != $this->image) {
                if ($this->obj) {
                    delete_file($this->obj->image);
                }
                $this->data['image'] = store_file($this->image, 'vendors');
            }
        } else {
            unset($this->data['image']);
        }
        if ($this->logo) {
            if ($this->obj?->logo != $this->logo) {
                if ($this->obj) {
                    delete_file($this->obj->logo);
                }
                $this->data['logo'] = store_file($this->logo, 'vendors');
            }
        } else {
            unset($this->data['logo']);
        }
        if ($this->commercial_record_image) {
            if ($this->obj?->commercial_record_image != $this->commercial_record_image) {
                if ($this->obj) {
                    delete_file($this->obj->commercial_record_image);
                }
                $this->data['commercial_record_image'] = store_file($this->commercial_record_image, 'vendors');
            }
        } else {
            unset($this->data['commercial_record_image']);
        }
    }
    public function mount($vendor = null)
    {
        if ($vendor) {
            $this->vendor = User::find($vendor);
            $this->edit($vendor);
        }
    }
    public function render()
    {
        $cities = City::latest()->pluck('name', 'id')->toArray();
        $neighborhoods = Neighborhood::latest()->where('city_id', $this->city_id)->pluck('name', 'id')->toArray();
        return view('livewire.admin.vendor-form', compact('cities', 'neighborhoods'))->extends('admin.layouts.admin')->section('content');
    }
    public function endSubmit()
    {
        return redirect()->route('admin.vendors.index')->with('sucess', __('Saved.'));
    }
}
