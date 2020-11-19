<?php

namespace App\Http\Middleware;

use App\Http\Traits\ServerResponses;
use App\Models\Api\RestFulApi;
use Closure;
//use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRestFulApi {
  use ServerResponses;

  public function handle($request, Closure $next) {
    try {
      $token = RestFulApi::getBasicTokens($request);

      if (!$token) {
        abort(422, 'Нет токена');
      }

      $user = RestFulApi::getUserByToken($token);
      if (!$user->count()) {
        abort(401, 'Требуется авторизация');
      }

      return $next($request);
    } catch (\HttpResponseException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }
}
