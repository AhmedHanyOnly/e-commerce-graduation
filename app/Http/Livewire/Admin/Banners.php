<?php

namespace App\Http\Livewire\Admin;

use App\Models\Banner;
use App\Traits\livewireResource;
use Livewire\Component;
use App\Models\Setting;


class Banners extends Component
{
    use livewireResource;
    public $image_one, $image_two, $status=1;
    public $defaultBanner ;
    public function mount ()
    {
       $this->defaultBanner= setting('default_banner', false);
    }

    // public function validation
    public function rules()
    {
        return [
            'image_one' => 'required',
            'image_two' => 'required',
            'status' => 'nullable',
        ];
    }
    public function beforeSubmit()
    {
        if ($this->image_one) {
            if ($this->obj) {
                if ($this->obj->image_one !== $this->image_one) {
                    delete_file($this->obj->image_one);
                    $this->data['image_one'] = store_file($this->image_one, 'banners');
                }
            } else {
                $this->data['image_one'] = store_file($this->image_one, 'banners');
            }
        }
        if ($this->image_two) {
            if ($this->obj) {
                if ($this->obj->image_two !== $this->image_two) {
                    delete_file($this->obj->image_two);
                    $this->data['image_two'] = store_file($this->image_two, 'banners');
                }
            } else {
                $this->data['image_two'] = store_file($this->image_two, 'banners');
            }
        }
    }
    public function toggle($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->status = !$banner->status;
        $banner->save();
    }
    public function toggleDefaultBanner()
    {
        \setting()->set('default_banner', !$this->defaultBanner); 
        \setting()->save();

    }
    public function render()
    {
        $banners = Banner::latest()->paginate(10);
        return view('livewire.admin.banners', compact('banners'))
        ->extends('admin.layouts.admin')
        ->section('content');
    }
}
