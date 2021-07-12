<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class completedRoom extends Model
{
    use HasFactory;
    public $table = 'completedbooked';
    protected $guarded = [];
}
