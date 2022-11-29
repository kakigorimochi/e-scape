<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    const STATUS_CANCELLED = 0;
    const STATUS_PAID      = 1;
    const STATUS_PENDING   = 2;

    const ORIGIN_NORTHBOUND = 0;
    const ORIGIN_SOUTHBOUND = 1;

    protected $fillable = [
        'user_id',
        'origin_id',
        'destination_id',
        'amount',
        'origin_type',
        'status'
    ];
}
