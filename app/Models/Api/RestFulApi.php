<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RestFulApi extends Model {

  static function getUserByToken($token) {
    return DB::table('api_users')->select('id')->where('token', '=', $token)->get();
  }

  static function getBasicTokens($request) {
    $token = $request->header('Authorization');
    if ($token){
      $token = explode(' ', $token);
      $token = $token[1];
    }

    return $token;
  }
}
