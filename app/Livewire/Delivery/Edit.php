<?php

namespace App\Livewire\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use App\Models\DeliveryPerson;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Edit extends Component
{
    public $record;

    public $registered_user;
    public $selected_user;

    public $years = [];
    public $months = [];
    public $days = [];
    public $hours = [];
    public $minutes = [];

    public $selected_departure_year = '';
    public $selected_departure_month = '';
    public $selected_departure_day = '';
    public $selected_departure_hour = '';
    public $selected_departure_minute = '';

    public $selected_arrival_year = '';
    public $selected_arrival_month = '';
    public $selected_arrival_day = '';
    public $selected_arrival_hour = '';
    public $selected_arrival_minute = '';


    public function mount($id)
    {
        $this->record = Delivery::with('file')->find($id);
        $this->registered_user = DeliveryPerson::where('is_active', true)->get();
        $this->selected_user = $this->record?->delivery_people_id ?? '';

        $this->years = range(Carbon::now()->year, Carbon::now()->year - 2);
        $this->months = range(1, 12);
        $this->days = range(1, 31);
        $this->hours = range(1, 24);
        $this->minutes = range(1, 60);

        if (isset($this->record->departure_datetime)) {
            $departure_datetime = new Carbon($this->record->departure_datetime);
            $this->selected_departure_year = $departure_datetime->year;
            $this->selected_departure_month = $departure_datetime->month;
            $this->selected_departure_day = $departure_datetime->day;
            $this->selected_departure_hour = $departure_datetime->hour;
            $this->selected_departure_minute = $departure_datetime->minute;
        }

        if (isset($this->record->arrival_datetime)) {
            $arrival_datetime = new Carbon($this->record->arrival_datetime);
            $this->selected_arrival_year = $arrival_datetime->year;
            $this->selected_arrival_month = $arrival_datetime->month;
            $this->selected_arrival_day = $arrival_datetime->day;
            $this->selected_arrival_hour = $arrival_datetime->hour;
            $this->selected_arrival_minute = $arrival_datetime->minute;
        }
    }

    public function setDepartureDatetime()
    {
        $now = Carbon::now();
        $this->selected_departure_year = $now->year;
        $this->selected_departure_month = $now->month;
        $this->selected_departure_day = $now->day;
        $this->selected_departure_hour = $now->hour;
        $this->selected_departure_minute = $now->minute;
    }

    public function clearDepartureDatetime()
    {
        $this->selected_departure_year = '';
        $this->selected_departure_month = '';
        $this->selected_departure_day = '';
        $this->selected_departure_hour = '';
        $this->selected_departure_minute = '';
    }

    public function setArrivalDatetime()
    {
        $now = Carbon::now();
        $this->selected_arrival_year = $now->year;
        $this->selected_arrival_month = $now->month;
        $this->selected_arrival_day = $now->day;
        $this->selected_arrival_hour = $now->hour;
        $this->selected_arrival_minute = $now->minute;
    }

    public function clearArrivalDatetime()
    {
        $this->selected_arrival_year = '';
        $this->selected_arrival_month = '';
        $this->selected_arrival_day = '';
        $this->selected_arrival_hour = '';
        $this->selected_arrival_minute = '';
    }

    public function  clearSelectedUser()
    {
        $this->selected_user = '';
    }

    public function editRecord()
    {
        $departure_datetime = empty($this->selected_departure_minute) ? null : Carbon::create($this->selected_departure_year, $this->selected_departure_month, $this->selected_departure_day, $this->selected_departure_hour, $this->selected_departure_minute)->toDateTimeString();
        $arrival_datetime = empty($this->selected_arrival_minute) ? null : Carbon::create($this->selected_arrival_year, $this->selected_arrival_month, $this->selected_arrival_day, $this->selected_arrival_hour, $this->selected_arrival_minute)->toDateTimeString();

        DB::beginTransaction();
        try {
            Delivery::find($this->record->id)->update([
                'departure_datetime' => $departure_datetime,
                'arrival_datetime' => $arrival_datetime,
                'delivery_people_id' => $this->selected_user == '' ? null : $this->selected_user,
            ]);

            DB::commit();

            session()->flash('flash.banner', '依頼を編集しました。');
        } catch (\ErrorException $e) {
            DB::rollBack();
            session()->flash('flash.bannerStyle', 'warning');
            session()->flash('flash.banner', $e->getMessage());
        } finally {
            $this->redirectRoute('delivery.overview');
        }
    }

    public function render()
    {
        return view('livewire.delivery.edit');
    }
}
