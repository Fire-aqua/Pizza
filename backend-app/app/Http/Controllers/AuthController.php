<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function login(Request $request)
    { 
      $credentials = $request->only('login', 'password');
      if (auth()->attempt($credentials)) {
          return auth()->user();
      }
      return abort(422);
    }
}
