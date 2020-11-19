<?php

namespace App\Http\Controllers\Companies;

use App\Models\Companies\Types;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypesController extends Controller {

  function getList(Request $request){
    return response()->json(Types::getList(), 200);
  }
}
