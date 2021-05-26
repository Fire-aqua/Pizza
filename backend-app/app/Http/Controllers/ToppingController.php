<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class ToppingController extends Controller
{
    public function getToppings()
    {
        $toppings = Ingredient::whereIsTopping(true)
        ->get();        
        return response()->json($toppings);
    }
}
