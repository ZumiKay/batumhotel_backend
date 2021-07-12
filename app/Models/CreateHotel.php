<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CreateHotel extends Model
{
    public $table = "HotelList";
    use HasFactory,Notifiable;
    protected $fillable = ['name' , 'type' ,'featured','preview', 'price' , 'Adult' , 'Child' , 'description' , 'extras' , 'image','image1','image2','image3'];
}
