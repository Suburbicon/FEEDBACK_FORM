<?php

namespace App\Http\Traits;

trait ServerResponses {

  protected function successResponse($code, $data = array()) {
    return response()->json(array(
      'success' => true,
      'result' => $data
    ), $code);
  }

  protected function successResponseSimple($code, $data) {
    return response()->json($data, $code);
  }

  protected function errorResponse($message, $code, $errors = array()) {
    return response()->json([
      'success' => false,
      'message' => $message,
      'errors' => $errors
    ], $code);
  }
}
