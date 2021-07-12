<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookingitems extends Model
{
    use HasFactory;
    public $table = 'bookingitems';
    protected $fillable = ['roomname' , 'price' , 'Adult' , 'Child' , 'amounts','image','user_id','roomid'];
}
