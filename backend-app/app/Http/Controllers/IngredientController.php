<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function getIngredients()
    {
        $ingredients = Ingredient::all()
        ->groupBy('display_name_ru')
        ->values()
        ->toArray();        
        return response()->json($ingredients);
    }
}
