<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Api\v1\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller {

  function Add(Request $request) {
    try {
      $this->validate($request, [
        'email' => 'required|email|max:55',
        'name' => 'required|string|max:255|alpha_dash',
        'message' => 'string',
      ]);

      Orders::Add($request['email'], $request['name'], $request['message']);

      return $this->successResponse(200);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }
}
