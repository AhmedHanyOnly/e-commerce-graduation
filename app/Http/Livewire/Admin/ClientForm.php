<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\GardenType;
use App\Models\Neighborhood;
use App\Models\User;
use App\Traits\livewireResource;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ClientForm extends Component
{
    use livewireResource;
    public $name, $phone, $city_id, $neighborhood_id, $garden_types, $type = 'client', $notes, $search, $cities,
        $possibleCients, $interestedCients,
        $notInterestedCients, $trueCients,
        $users,
        $client, $message, $image, $address, $pst, $contact, $class, $email, $status, $active=1, $password;
    public $country_id, $state_id, $level_id, $region, $library_id, $filter_neighborhood;
    public $latitude,
        $longitude;
    public $select_citites, $select_garden_types;

    public function setModelName()
    {
        $this->model = 'App\Models\User';
    }
    public function whileEditing()
    {
        // $this->garden_types = $this->obj->gardens()->pluck('garden_type_id')->toArray();
    }
    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => ['required', 'unique:users,phone,' . $this->client?->id],
            'email' => ['nullable', 'unique:users,email,' . $this->client?->id],
            'city_id' => 'required',
            'neighborhood_id' => 'required',
            'city_id' => 'required',
            'image' => 'nullable',
            'type' => 'nullable',
            'password' => !$this->client ? 'required' : 'nullable',
            'active' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ];
    }
    public function mount($client = null)
    {
        $this->cities = City::query()->get() ?? [];
        $this->users = User::all();
        $this->select_citites = City::latest()->pluck('name', 'id')->toArray();
        // $this->select_garden_types = GardenType::latest()->pluck('name', 'id')->toArray();
        if ($client) {
            $this->client = User::find($client);
            $this->edit($this->client->id);
        }
    }
    public function beforeSubmit()
    {
        if ($this->password) {
            $this->data['password'] = Hash::make($this->password);
        } else {
            $this->data['password'] = $this->client->password;
        }
        if ($this->image) {
            if ($this->obj?->image != $this->image) {
                if ($this->obj) {
                    delete_file($this->obj->image);
                }
                $this->data['image'] = store_file($this->image, 'clients');
            }
        } else {
            unset($this->data['image']);
        }
    }
    public function afterSubmit()
    {
        // if ($this->garden_types) {
        //     $this->obj->gardens()->sync($this->garden_types);
        // }
    }
    // public function endSubmit()
    // {
    //     return redirect()->route('admin.clients.index')->with('sucess', __('Saved.'));
    // }

    public function endSubmit()
{
    session()->flash('success', __('Saved.'));
    return redirect()->route('admin.clients.index');
}
public function submitAndRedirect()
{
    $this->submit();
    return redirect()->route('admin.clients');
}

    public function render()
    {
        $select_neighborhoods = Neighborhood::latest()->where('city_id', $this->city_id)->pluck('name', 'id')->toArray();
        return view('livewire.admin.client-form', compact('select_neighborhoods'))->extends('admin.layouts.admin')->section('content');
    }

 
}
