<?php
namespace App\Http\Controllers;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Models\GuestFood;

class FoodController extends Controller {
    public function index(){
        return Food::all();
    }

    public function edit(Request $request, $id){
        return Food::find($id);
    }

    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $request = $request->all();
        $food->name = $request['name'];
        $food->save();

        return true;
    }
    
    public function store(Request $request)
    {
        $food = new Food();
        $request = $request->all();
        $food->name = $request['name'];
        $food->save();

        return true;
    }

    public function destroy(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $food->delete();
        GuestFood::where('food_id', $id)->delete();

        return true;
    }
}