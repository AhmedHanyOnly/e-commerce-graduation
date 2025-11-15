<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\Neighborhood;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Vendors extends Component
{
    use WithPagination;
    public $user_id, $name, $email, $password, $type = 'vendor', $logo, $city_id, $image, $phone, $neighborhood_id, $bank_account, $commercial_record_image, $commercial_record_number;
    public $search, $filter_active, $filter_city, $from_time, $to_time;
    protected $queryString = ['filter_active'];



    public function toggle($id)
    {
        $user = User::findOrFail($id);
        $user->active = !$user->active;
        $user->save();
    }
    public function setModelName()
    {
        $this->model = 'App\Models\User';
    }


    public function render()
    {
        // $roles = Role::all();
        $users = User::where('type', 'vendor')->where(function ($q) {
            if ($this->search) {
                $q->where('name', 'LIKE', "%" . $this->search . "%")
                    ->orWhere('phone', $this->search)
                    ->orWhere('email', $this->search);
            }
            if ($this->filter_active) {
                if ($this->filter_active == 'active') {
                    $q->where('active', 1);
                }
                if ($this->filter_active == 'inactive') {
                    $q->where('active', 0);
                }
            }
            if ($this->filter_city) {
                $q->where('city_id', $this->filter_city);
            }
        })->paginate(10);
        $cities = City::latest()->pluck('name', 'id')->toArray();
        $neighborhoods = Neighborhood::latest()->where('city_id', $this->city_id)->pluck('name', 'id')->toArray();
        return view('livewire.admin.Vendors.index', compact('users', 'cities', 'neighborhoods'))->extends('admin.layouts.admin')->section('content');
    }
}
