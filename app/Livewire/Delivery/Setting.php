<?php

namespace App\Livewire\Delivery;

use Livewire\Component;
use App\Models\DeliveryPerson;
use Illuminate\Validation\Rule;
use App\Models\DeliveryPreference;
use Illuminate\Support\Facades\DB;

class Setting extends Component
{
    public $endpoint;

    public $registered_user;
    public $new_user;

    protected function rules()
    {
        return [
            'new_user' => Rule::unique('delivery_people', 'name')->where('is_active', true)
        ];
    }

    protected function messages()
    {
        return [
            'new_user.*' => 'このユーザーは既に登録されています。'
        ];
    }

    public function mount()
    {
        $this->endpoint = DeliveryPreference::first()?->teams_endpoint;
        $this->registered_user = DeliveryPerson::where('is_active', true)->get();
    }

    public function editUrl()
    {
        DB::beginTransaction();
        try {
            DeliveryPreference::updateOrCreate(['id' => 1], [
                'teams_endpoint' => $this->endpoint,
            ]);

            DB::commit();

            session()->flash('flash.banner', '通知urlを設定しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash.bannerStyle', 'warning');
            session()->flash('flash.banner', $e->getMessage());
        } finally {
            $this->redirectRoute('delivery.setting');
        }
    }

    public function editUser()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            DeliveryPerson::create([
                'name' => $this->new_user,
            ]);

            DB::commit();

            session()->flash('flash.banner', '配送担当者を作成しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash.bannerStyle', 'warning');
            session()->flash('flash.banner', $e->getMessage());
        } finally {
            $this->redirectRoute('delivery.setting');
        }
    }

    public function deleteUser($id)
    {
        DB::beginTransaction();
        try {
            DeliveryPerson::find($id)->update(['is_active' => false]);
            DB::commit();
            session()->flash('flash.banner', '配送担当者を削除しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash.bannerStyle', 'warning');
            session()->flash('flash.banner', $e->getMessage());
        } finally {
            $this->redirectRoute('delivery.setting');
        }
    }

    public function render()
    {
        return view('livewire.delivery.setting');
    }
}
