<?php

namespace App\Livewire\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use Livewire\WithPagination;
use App\Models\DeliveryPerson;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\WithoutUrlPagination;
use Illuminate\Validation\ValidationException;

class Overview extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $num;
    public $num_list = [5, 10, 25, 50];

    public $years = [];
    public $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    public $days = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];

    // 検索
    public $selected_year = '';
    public $selected_month = '';
    public $order_number;
    public $product_name;
    public $delivery_person = '';

    public $toggle;
    public $registered_user;

    public $new_user;
    public $selected_user;

    protected function rules()
    {
        return [
            'new_user' => Rule::unique('delivery_people', 'name')->where('is_active', true)
        ];
    }

    protected function messages()
    {
        return [
            'new_user.*' => 'このユーザーは既に登録されています。リストから選択して再度送信してください。'
        ];
    }

    public function mount()
    {
        $this->num = 10;
        $this->toggle = false;

        $now = Carbon::now();

        for ($i = 0; $i <= 2; $i++) {
            array_push($this->years, $now->year - $i);
        }

        $this->registered_user = DeliveryPerson::where('is_active', true)->get();
    }

    public function updatedNum()
    {
        $this->resetPage();
    }

    public function setDeparture($recordId)
    {
        try {
            $this->validateOnly('new_user');
        } catch (ValidationException $e) {
            $this->new_user = null;
            session()->flash('flash.bannerStyle', 'warning');
            session()->flash('flash.banner', $e->getMessage());
            $this->redirectRoute('delivery.overview');
        } finally {
            if ($this->new_user) {
                $new_user = DeliveryPerson::create([
                    'name' => $this->new_user
                ]);

                Delivery::find($recordId)->update([
                    'departure_datetime' => Carbon::now(),
                    'delivery_people_id' => $new_user->id
                ]);

                $this->redirectRoute('delivery.overview');
            }

            if ($this->selected_user) {
                Delivery::find($recordId)->update([
                    'departure_datetime' => Carbon::now(),
                    'delivery_people_id' => $this->selected_user
                ]);

                $this->redirectRoute('delivery.overview');
            }
        }
    }

    public function setArrival($recordId)
    {
        Delivery::find($recordId)->update([
            'arrival_datetime' => Carbon::now(),
        ]);

        $this->redirectRoute('delivery.overview');
    }

    public function setReceipt($recordId)
    {
        Delivery::find($recordId)->update([
            'receipt_datetime' => Carbon::now()->format('Y/m/d H:i'),
        ]);

        session()->flash('flash.banner', '配達が完了しました。');
        $this->redirectRoute('delivery.overview');
    }

    public function deleteRecord($recordId)
    {
        Delivery::find($recordId)->update([
            'is_deleted' => true,
        ]);

        session()->flash('flash.banner', '依頼を削除しました。');
        $this->redirectRoute('delivery.overview');
    }

    public function searchRecord()
    {
        $this->render();
    }

    public function searchClear()
    {
        $this->selected_year = '';
        $this->selected_month = '';
        $this->order_number = '';
        $this->product_name = '';
        $this->delivery_person = '';
        $this->toggle = false;
    }

    public function render()
    {
        $query = Delivery::query()->where('is_deleted', false);

        if ($this->selected_year && $this->selected_month) {
            $this->toggle = true;
            $filtered = $query->whereYear('receipt_datetime', $this->selected_year)->whereMonth('receipt_datetime', $this->selected_month)->orderByDesc('id')->paginate($this->num);
        } elseif ($this->selected_year) {
            $this->toggle = true;
            $filtered = $query->whereYear('receipt_datetime', $this->selected_year)->orderByDesc('id')->paginate($this->num);
        } elseif ($this->selected_month) {
            $this->toggle = true;
            $filtered = $query->whereMonth('receipt_datetime', $this->selected_month)->orderByDesc('id')->paginate($this->num);
        } elseif ($this->order_number) {
            $this->toggle = true;
            $filtered = $query->where('order_number', $this->order_number)->orderByDesc('id')->paginate($this->num);
        } elseif ($this->product_name) {
            $this->toggle = true;
            $filtered = $query->whereLike('product_name', '%' . $this->product_name . '%')->orderByDesc('id')->paginate($this->num);
        } elseif ($this->delivery_person) {
            $this->toggle = true;
            $filtered = $query->where('delivery_people_id', $this->delivery_person)->orderByDesc('id')->paginate($this->num);
        } else {
            $filtered = $this->toggle ? $query->whereNotNull('receipt_datetime')->orderByDesc('id')->paginate($this->num) : $query->whereNull('receipt_datetime')->orderByDesc('id')->paginate($this->num);
        }

        return view('livewire.delivery.overview', [
            'records' => $filtered
        ]);
    }
}
