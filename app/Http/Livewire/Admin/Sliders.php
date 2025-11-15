<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slider;
use App\Traits\livewireResource;
use Livewire\Component;

class Sliders extends Component
{
    use livewireResource;

    public $cover, $title_ar, $title_en, $subtitle_ar, $subtitle_en, $link;

    public function rules()
    {
        return [
            'cover' => 'required',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'subtitle_ar' => 'nullable|string|max:255',
            'subtitle_en' => 'nullable|string|max:255',
            'link' => 'nullable|url',
        ];
    }

    public function beforeSubmit()
    {
        if ($this->cover) {
            if ($this->obj) {
                if ($this->obj->cover !== $this->cover) {
                    delete_file($this->obj->cover);
                    $this->data['cover'] = store_file($this->cover, 'slider_cover');
                }
            } else {
                $this->data['cover'] = store_file($this->cover, 'slider_cover');
            }
        }
    }
    public function toggle($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->status = !$slider->status;
        $slider->save();
    }
    public function render()
    {
        $sliders = Slider::paginate();
        return view('livewire.admin.sliders', compact('sliders'))->extends('admin.layouts.admin')->section('content');
    }
}
