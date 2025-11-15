<?php

namespace App\Http\Livewire\Admin\Messages;

use App\Models\Client;
use App\Models\Message;
use App\Models\Program;
use App\Models\WhatsappMessage;
use App\Services\Whatsapp;
use Livewire\Component;

class SendMessage extends Component
{
    public $programs, $program_id, $msg_type, $message_id, $count, $prev;
    public function rules()
    {
        return [
            'program_id' => 'required',
            'message_id' => 'required',
            'count' => 'required|numeric',
        ];
    }
    public function submit()
    {
        $data = $this->validate();
        $clients = Client::where('program_id', $this->program_id)->take($this->count)->get();
        $msg = Message::findOrFail($this->message_id);
        if ($msg->attach == 1) {
            WhatsappMessage::create([
                'message' => $msg->content,
                'program_id' => $this->program_id,
                'user_id' => auth()->user()->id,
            ]);
            foreach ($clients as $c) {
                $message=WhatsappMessage::create([
                    'message' => $msg->content,
                    'client_id' => $c->id,
                    'user_id' => auth()->user()->id,
                ]);
                if ($c->phone) {
                    Whatsapp::send($c->phone, $msg->content);
                    $c->update(['contact' => true]);
                }
            }
        } else {
            WhatsappMessage::create([
                'message' => $msg->content,
                'program_id' => $this->program_id,
                'user_id' => auth()->user()->id,
                'image' => $msg->file,
            ]);
            foreach ($clients as $c) {
                $message = WhatsappMessage::create([
                    'message' => $msg->content,
                    'image' => $msg->file,
                    'client_id' => $c->id,
                    'user_id' => auth()->user()->id,
                ]);
                if ($c->phone) {
                    Whatsapp::sendWithImage($c->phone, $msg->content, display_file($msg->file));
                    $c->update(['contact' => true]);
                }
            }
        }

        $this->reset('message_id','count','msg_type');
        session()->flash('success', 'تم الارسال بنجاح');
    }
    public function mount()
    {
        $this->programs = Program::all();
    }
    public function render()
    {
        $msgs = Message::where(function ($q) {
            if ($this->msg_type) {
                $q->where('attach', $this->msg_type);
            }
        })->get();

        return view('livewire.admin.messages.send-message', compact('msgs'))->extends('admin.layouts.admin')->section('content');
    }
}
