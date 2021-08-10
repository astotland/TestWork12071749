<?php
namespace App\Http\Controllers;
use App\Models\Drinks;
use Illuminate\Http\Request;
use App\Models\GuestDrinks;


class DrinksController extends Controller {
    public function index(){
        return Drinks::all();
    }

    public function edit(Request $request, $id){
        return Drinks::find($id);
    }

    public function update(Request $request, $id)
    {
        $guest = Drinks::findOrFail($id);
        $request = $request->all();
        $guest->name = $request['name'];
        $guest->save();

        return true;
    }
    
    public function store(Request $request)
    {
        $guest = new Drinks();
        $request = $request->all();
        $guest->name = $request['name'];
        $guest->save();

        return true;
    }

    public function destroy(Request $request, $id)
    {
        $guest = Drinks::findOrFail($id);
        $guest->delete();
        GuestDrinks::where('drink_id', $id)->delete();
        return true;
    }
}