<?php

namespace App\Http\Controllers\Companies;

use App\Models\Companies\Activities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivitiesController extends Controller {

  function getList(Request $request){
    try {
      $data = Activities::getList();
      return $this->successResponseSimple(200, $data);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }
}
