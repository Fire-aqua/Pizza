<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function logout(Request $request)
    {
      $request->session()->invalidate();
      return abort(200);
    }    
}
