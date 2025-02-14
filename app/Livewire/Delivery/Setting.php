<?php

namespace App\Livewire\Delivery;

use Livewire\Component;
use App\Models\DeliveryPerson;
use App\Models\DeliveryPreference;

class Setting extends Component
{
    public $endpoint;

    public $registered_user;
    public $new_user;

    public function mount()
    {
        $this->endpoint = DeliveryPreference::first()?->teams_endpoint;
        $this->registered_user = DeliveryPerson::where('is_active', true)->get();
    }

    public function editUrl()
    {
        DeliveryPreference::updateOrCreate(['id' => 1], [
            'teams_endpoint' => $this->endpoint,
        ]);

        session()->flash('flash.banner', '通知urlを設定しました。');
        $this->redirectRoute('delivery.setting');
    }

    public function editUser()
    {
        DeliveryPerson::create([
            'name' => $this->new_user,
        ]);

        session()->flash('flash.banner', '配送担当者を作成しました。');
        $this->redirectRoute('delivery.setting');
    }

    public function deleteUser($id)
    {
        DeliveryPerson::find($id)->update(['is_active' => false]);
        session()->flash('flash.banner', '配送担当者を削除しました。');
        $this->redirectRoute('delivery.setting');
    }

    public function render()
    {
        return view('livewire.delivery.setting');
    }
}
