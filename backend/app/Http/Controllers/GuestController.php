<?php
namespace App\Http\Controllers;
use App\Models\Guest;
use App\Models\Drink;
use App\Models\Food;
use App\Models\GuestDrinks;
use App\Models\GuestFood;
use Illuminate\Http\Request;

class GuestController extends Controller {
    public function index(){
        return Guest::with('food', 'drinks')->get();
    }

    public function edit(Request $request, $id){
        $guest = Guest::with('food', 'drinks')->find($id);
        
        return $guest;
    }

    public function update(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);
        $request = $request->all();
        $guest->name = $request['name'];
        $guest->age =  $request['age'] ?? null;
        $guest->setFood($request['food'] ?? []);  
        $guest->setDrinks($request['drinks'] ?? []);  
        $guest->save();

        return true;
    }
    
    public function store(Request $request)
    {
        $guest = new Guest();
        $request = $request->all();
        $guest->name = $request['name'];
        $guest->age =  $request['age'] ?? null;
        $guest->save();
        $guest->setFood($request['food'] ?? []);  
        $guest->setDrinks($request['drinks'] ?? []);  

        return true;
    }

    public function destroy(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();
        GuestDrinks::where('guest_id', $id)->delete();
        GuestFood::where('guest_id', $id)->delete();

        return true;
    }
}