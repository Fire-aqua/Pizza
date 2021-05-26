<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    public function getGoods()
    {
        $goods = Good::all()
        ->groupBy('display_name_ru')
        ->values()
        ->toArray();        
        return response()->json($goods);
    }
}
