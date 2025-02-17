<?php

namespace App\Livewire\Delivery;

use GuzzleHttp\Client;
use Livewire\Component;
use App\Models\Delivery;
use App\Models\DeliveryFile;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\DeliveryPreference;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class Create extends Component
{
    use WithFileUploads;

    #[Validate('required', message: '画像は必ず登録してください。')]
    #[Validate('image', message: '画像データをアップロードしてください')]
    #[Validate('max:10000', message: 'ファイルサイズが大きすぎます。')]
    public $photo;
    public $count;

    #[Validate('required', message: '引取場所は必須です')]
    public $departure;

    #[Validate('required', message: '送付先は必須です')]
    public $destination;

    #[Validate('required', message: '種別は必須です')]
    public $type;

    public $order_number;
    public $order_checked = false;

    #[Validate('required', message: '品名は必須です')]
    public $product_name;

    #[Validate('required', message: '依頼者名は必須です')]
    public $name;

    public $standBy;

    public function mount()
    {
        $this->count = 1;
        $this->standBy = false;
    }

    public function updatedDeparture()
    {
        if ($this->departure === $this->destination) {
            $this->destination = null;
            $this->type = null;
        }
    }

    public function updatedDestination()
    {
        if ($this->departure === $this->destination) {
            $this->destination = null;
            $this->type = null;
        }
    }

    public function updatedType()
    {
        if ($this->type == 2) {
            $this->order_number = null;
        }
    }

    public function updatedOrderNumber()
    {
        try {
            $this->validateOnly('order_number');
            $this->order_checked = true;
        } catch (ValidationException) {
            $this->order_checked = false;
        }
    }

    protected function rules()
    {
        return [
            'order_number' => $this->type == 2 ? 'nullable' : 'required|digits:6',
        ];
    }

    public function updated()
    {
        try {
            $this->validate();
            $this->standBy = true;
        } catch (ValidationException $e) {
            $this->standBy = false;
        }
    }

    public function sendTeamsNotification()
    {
        $url = DeliveryPreference::first()?->teams_endpoint;

        if (isset($url)) {
            $adaptiveCard = [
                "type" => "message",
                "attachments" => [
                    [
                        "contentType" => "application/vnd.microsoft.card.adaptive",
                        "content" => [
                            "\$schema" => "http://adaptivecards.io/schemas/adaptive-card.json",
                            "type" => "AdaptiveCard",
                            "version" => "1.2",
                            "body" => [
                                [
                                    'type' => 'TextBlock',
                                    'size' => 'Medium',
                                    'weight' => 'Bolder',
                                    'text' => "社内便が依頼されました",
                                    'wrap' => true
                                ],
                                [
                                    'type' => 'TextBlock',
                                    'text' => "【品名】$this->product_name",
                                    'wrap' => true
                                ],
                            ],
                            "actions" => [
                                [
                                    'type' => 'Action.OpenUrl',
                                    'title' => '依頼を確認する',
                                    'url' => route('delivery.overview')
                                ]
                            ]
                        ]
                    ]
                ]
            ];

            try {
                $client = new Client();
                $client->post($url, [
                    'json' => $adaptiveCard
                ]);
            } catch (\Exception $e) {
                session()->flash('flash.bannerStyle', 'warning');
                session()->flash('flash.banner', 'teams通知が送信できませんでした。urlを確認してください。');
            }
        }
    }

    public function save()
    {

        DB::beginTransaction();
        try {
            $this->validate();

            $delivery = Delivery::create([
                'product_name' => $this->product_name,
                'departure' => $this->departure,
                'destination' => $this->destination,
                'order_number' => $this->order_number,
                'client' =>  $this->name,
                'count' => $this->count,
            ]);

            $filePath = $this->photo->store('delivery', 'public');
            DeliveryFile::create([
                'file_name' => $this->photo->getClientOriginalName(),
                'file_path' => $filePath,
                'delivery_id' => $delivery->id
            ]);

            $this->sendTeamsNotification();

            if (!session()->has('flash.banner')) {
                session()->flash('flash.banner', '依頼を送信しました。');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('flash.bannerStyle', 'warning');
            session()->flash('flash.banner', $e->getMessage());
        } finally {
            $this->redirectRoute('delivery.overview');
        }
    }

    public function render()
    {
        return view('livewire.delivery.create');
    }
}
