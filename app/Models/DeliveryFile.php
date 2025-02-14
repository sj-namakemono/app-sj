<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryFile extends Model
{
    protected $fillable = ['file_name', 'file_path', 'delivery_id'];
}
