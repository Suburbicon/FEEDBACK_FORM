<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IsAuthenticatedController extends Controller {

  public function isAuthenticated(){
    return response()->json(array("isAuthenticated" => Auth::check()));//TODO просто boolean
  }
}
