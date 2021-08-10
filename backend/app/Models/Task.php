<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'phone'
    ];

    public function getFirstNameAttribute()
    {
        return $this->attributes['first_name'];
    }
    public function getLastNameAttribute()
    {
        return $this->attributes['last_name'];
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = $value;
    }

}
