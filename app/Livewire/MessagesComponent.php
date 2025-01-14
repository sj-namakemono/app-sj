<?php

namespace App\Livewire;

use App\Events\ChatEvent;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Message;

class MessagesComponent extends Component
{
    public $messages;
    public $body;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->messages = Message::all();
    }

    public function post()
    {
        Message::create(['body' => $this->body]);
        $this->loadData();
        ChatEvent::dispatch($this->body);
    }

    #[On('echo:test-channel,ChatEvent')]
    public function refreshMessages()
    {
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.messages-component');
    }
}
