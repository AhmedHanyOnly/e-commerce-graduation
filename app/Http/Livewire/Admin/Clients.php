<?php

namespace App\Http\Livewire\Admin;

use App\Exports\ClientsExport;
use App\Models\City;
use App\Models\Client;
use App\Models\Country;
use App\Models\GardenType;
use App\Models\Level;
use App\Models\Neighborhood;
use App\Models\Notification;
use App\Models\NotificationLibrary;
use App\Models\Region;
use App\Models\State;
use App\Models\User;
use App\Models\WhatsappMessage;
use App\Services\FCMService;
use App\Services\Whatsapp;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;


class Clients extends Component
{
    use WithFileUploads, WithPagination;

    public $name, $phone, $city_id, $neighborhood_id, $garden_types, $type = 'client', $notes, $search, $cities,
    $possibleCients, $interestedCients,
    $notInterestedCients, $trueCients, $filter_active,
    $filter_city, $users, $filter_user, $filter_garden_type,
    $client, $message, $image, $address, $pst, $contact, $class, $email, $status, $active, $password;
    public $country_id, $state_id, $level_id, $region, $library_id, $filter_neighborhood;
    public $latitude,
    $longitude;

    public $select_citites, $select_garden_types;
    public Collection $allClients;
    public function setModelName()
    {
        $this->model = 'App\Models\User';
    }
    // public function updatedScreen()
    // {
    //     $this->dispatch('loadMap', ['longitude' => $this->longitude, 'latitude' => $this->latitude]);
    // }
    public function export()
    {
        return Excel::download(new ClientsExport($this->allClients), 'clients' . time() . '.xlsx');
    }



    public function toggle($id)
    {
        $user = User::findOrFail($id);
        $user->active = !$user->active;
        $user->save();
    }

    public function mount()
    {
        $this->cities = City::query()->get() ?? [];
        $this->allClients = User::where('type', 'client')->get();
        $this->users = User::all();
        //        $this->possibleCients = Client::where('status', 'possible')->count();
        //        $this->interestedCients = Client::where('status', 'interested')->count();
        //        $this->notInterestedCients = Client::where('status', 'not_interested')->count();
        //        $this->trueCients = Client::where('status', 'true')->count();
        if (request('city_id')) {
            $this->filter_city = request('city_id');
        }
        if (request('neighborhood_id')) {
            $this->filter_neighborhood = request('neighborhood_id');
        }
        $this->select_citites = City::latest()->pluck('name', 'id')->toArray();

    }





    public function send_notification()
    {
        $user = $this->client;
        $this->validate(['library_id' => 'required|exists:notification_libraries,id']);
        $library = NotificationLibrary::findOrFail($this->library_id);
        Notification::create(['user_id' => $user->id, 'library_id' => $this->library_id, 'title' => $library->content]);
        session()->flash('success', 'تم الارسال بنجاح');
    }

    public function render()
    {
        // dd($this->filter_city);
        $clients = User::with(['city'])->where('type', 'client')->where(function ($q) {
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
            if ($this->filter_neighborhood) {
                $q->where('neighborhood_id', $this->filter_neighborhood);
            }
        })->latest('id')->paginate();
        // $levels = Level::latest()->get();
        // $countries = Country::latest()->get();
        // $states = State::where('country_id', $this->country_id)->latest()->get();
        // $regions = Region::where('state_id', $this->state_id)->latest()->get();
        $select_neighborhoods = Neighborhood::latest()->where('city_id', $this->city_id)->pluck('name', 'id')->toArray();
        return view('livewire.admin.clients.index', compact('clients', 'select_neighborhoods'))->extends('admin.layouts.admin')->section('content');
    }

    public function clientId($id)
    {
        $this->client = User::find($id);
    }

    public function sendToWhatsapp()
    {
        $this->validate([
            'message' => 'required',
            'image' => 'nullable|image',
        ]);

        try {
            DB::beginTransaction();

            if ($this->image) {
                $image = store_file($this->image, 'messages');

                $message = WhatsappMessage::create([
                    'message' => $this->message,
                    'image' => $image,
                    'user_id' => $this->client->id,
                ]);

                Whatsapp::sendWithImage($this->client->phone, $this->message, display_file($message->image));
            } else {
                WhatsappMessage::create([
                    'message' => $this->message,
                    'user_id' => $this->client->id,
                ]);

                Whatsapp::send($this->client->phone, $this->message);
            }

            DB::commit();

            $this->client->update(['contact' => true]);
            $this->reset();
            session()->flash('success', 'تم الارسال بنجاح');
            // $this->dispatch('alert', ['type' => 'success', 'message' => 'تم الارسال بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex->getMessage());
            session()->flash('success', 'حدث خطأ أثناء الارسال');
            $this->dispatch('alert', ['type' => 'error', 'message' => 'حدث خطأ أثناء الارسال']);
        }

    }
    public function delete(User $client)
    {
        if ($client->logo) {
            delete_file($client->logo);
        }
        $client->delete();
        session()->flash('success', 'تم الحذف بنجاح');
    }

}
