<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name', 'age', 'sex'
    ];

    public function setFood($ids){

        GuestFood::where('guest_id', $this->id)->delete();
        foreach($ids as $id){
            GuestFood::create([
                'guest_id' => $this->id,
                'food_id' => $id
            ]);
        }
    }

    public function setDrinks($ids){
  
        GuestDrinks::where('guest_id', $this->id)->delete();
        foreach($ids as $id){
            GuestDrinks::create([
                'guest_id' => $this->id,
                'drink_id' => $id
            ]);
        }
    }

    public function food(){
        return $this->belongsToMany(Food::class, 'guest_food', 'guest_id', 'food_id');
    }

    public function drinks(){
        return $this->belongsToMany(Drinks::class, 'guest_drinks', 'guest_id', 'drink_id');
    }
}
