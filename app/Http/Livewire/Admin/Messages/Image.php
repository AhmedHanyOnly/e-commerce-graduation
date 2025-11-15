<?php

namespace App\Http\Livewire\Admin\Messages;

use App\Models\Message;
use App\Traits\livewireResource;
use Livewire\Component;

class Image extends Component
{
    use livewireResource;
    public $name, $search, $attach = 2,$content,$file,$img;
    public function rules()
    {
        return ['content' => 'required', 'img' => 'nullable','attach'=>'required'];
    }
    public function setModelName()
    {
        $this->model = 'App\Models\Message';
    }

    public function beforeSubmit()
    {
        if($this->img){
            $this->data['file']=store_file($this->img,'messages');
        }
    }
    public function mount()
    {
        $this->model = 'App\Models\Message';
    }
    public function render()
    {
        $messages = Message::where('attach', 2)->paginate(10);
        return view('livewire.admin.messages.image', compact('messages'))->extends('admin.layouts.admin')->section('content');
    }
}
