<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class WebsiteColor extends Component
{
    public $main_color_dark, $main_color;
    public $hexColor = '#ffffff';
    public $darkenPercent = 10;
    public $rgbColor;

    public function hexToRgb($hex)
    {
        $shorthandRegex = '/^#?([a-f\d])([a-f\d])([a-f\d])$/i';
        $hex = preg_replace_callback($shorthandRegex, function ($matches) {
            return $matches[1] . $matches[1] . $matches[2] . $matches[2] . $matches[3] . $matches[3];
        }, $hex);

        $result = [];
        if (preg_match('/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i', $hex, $result)) {
            return [
                'r' => intval($result[1], 16),
                'g' => intval($result[2], 16),
                'b' => intval($result[3], 16),
            ];
        } else {
            return null;
        }
    }

    public function darkenColor($color, $percent)
    {
        $rgb = $this->hexToRgb($color);
        $rgb['r'] = floor($rgb['r'] * (1 - $percent / 100));
        $rgb['g'] = floor($rgb['g'] * (1 - $percent / 100));
        $rgb['b'] = floor($rgb['b'] * (1 - $percent / 100));
        return 'rgb(' . $rgb['r'] . ',' . $rgb['g'] . ',' . $rgb['b'] . ')';
    }

    public function render()
    {
        return view('livewire.admin.website-color')
            ->extends('admin.layouts.admin')
            ->section('content');
    }

    public function mount()
    {
        $this->main_color = setting('main_color') ?? '#44117c';
        $this->main_color_dark = setting('main_color_dark');
    }

    public function submit()
    {
        $data = $this->validate([
            'main_color' => 'required',
        ]);
        $data['main_color_dark'] = $this->darkenColor($this->main_color, 20);

        setting($data)->save();
        $this->dispatch('alert', type: 'success', message: 'تم الحفظ بنجاح');
    }

    public function resetColor()
    {
        $this->main_color ='#44117c';
    }


}
