<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type',
        'fname',
        'lname',
        'birthdate',
        'email',
        'phone',
        'username',
        'password'
    ];

    protected $casts = [
        'uuid' => 'char'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $model) {
            $model->uuid = Uuid::uuid1()->toString();
        });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}
