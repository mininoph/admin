<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotOffer extends Model
{
    use HasFactory;
    public $table='hot_offer';
    public $timstamps=false;
}