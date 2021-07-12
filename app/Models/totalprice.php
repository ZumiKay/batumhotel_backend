<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class totalprice extends Model
{
    use HasFactory;
    public $table = 'totalprice';
    protected $fillable  = ['pricerooms','amount','roomid'];
}
