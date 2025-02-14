<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'count',
        'departure',
        'destination',
        'departure_datetime',
        'arrival_datetime',
        'receipt_datetime',
        'order_number',
        'client',
        'delivery_people_id',
        'is_deleted'
    ];

    protected function casts(): array
    {
        return [
            'departure_datetime' => 'datetime',
            'arrival_datetime' => 'datetime',
            'receipt_datetime' => 'datetime'
        ];
    }

    public function file(): HasOne
    {
        return $this->hasOne(DeliveryFile::class);
    }

    public function deliveryPeople(): BelongsTo
    {
        return $this->belongsTo(DeliveryPerson::class);
    }
}
