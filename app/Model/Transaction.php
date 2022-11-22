<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const TYPE_ADD_BALANCE = 0;
    const TYPE_OPERATOR_PAYMENT = 1;

    protected $fillable = [
        'wallet_id',
        'amount',
        'type'
    ];
}
