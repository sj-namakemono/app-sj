<?php

namespace App\Livewire\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use Livewire\WithPagination;
use App\Models\DeliveryPerson;
use Illuminate\Support\Carbon;
use Livewire\WithoutUrlPagination;

class Completed extends Component
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

    public $registered_user;


    public function mount()
    {
        $this->num = 10;

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
    }

    public function render()
    {
        $query = Delivery::query()->where('is_deleted', false);

        if ($this->selected_year && $this->selected_month) {
            $filtered = $query->whereYear('receipt_datetime', $this->selected_year)->whereMonth('receipt_datetime', $this->selected_month)->orderByDesc('id')->paginate($this->num);
        } elseif ($this->selected_year) {
            $filtered = $query->whereYear('receipt_datetime', $this->selected_year)->orderByDesc('id')->paginate($this->num);
        } elseif ($this->selected_month) {
            $filtered = $query->whereMonth('receipt_datetime', $this->selected_month)->orderByDesc('id')->paginate($this->num);
        } elseif ($this->order_number) {
            $filtered = $query->where('order_number', $this->order_number)->orderByDesc('id')->paginate($this->num);
        } elseif ($this->product_name) {
            $filtered = $query->whereLike('product_name', '%' . $this->product_name . '%')->orderByDesc('id')->paginate($this->num);
        } elseif ($this->delivery_person) {
            $filtered = $query->where('delivery_people_id', $this->delivery_person)->orderByDesc('id')->paginate($this->num);
        } else {
            $filtered = $query->whereNotNull('receipt_datetime')->orderByDesc('id')->paginate($this->num);
        }

        return view('livewire.delivery.completed', [
            'records' => $filtered
        ]);
    }
}
