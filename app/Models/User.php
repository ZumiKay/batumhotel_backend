<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    protected $guarded = [];

    protected $hidden = ['password'];

    public function getBooking ()
    {
        return $this->hasMany('App\Models\booking');
    }
    public function getCompletedBooking ()
    {
        return $this->hasMany('App\Models\completedRoom');
    }

}
