<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestDrinks extends Model
{
    protected $fillable = ['guest_id', 'drink_id'];
}
