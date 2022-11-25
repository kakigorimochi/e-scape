<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    protected $fillable = [
        'location_id',
        'tickets'
    ];
}
