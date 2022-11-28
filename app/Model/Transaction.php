<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const TYPE_ADD_BALANCE      = 0;
    const TYPE_OPERATOR_PAYMENT = 1;

    const STATUS_PENDING  = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'wallet_id',
        'amount',
        'type',
        'status'
    ];
}
