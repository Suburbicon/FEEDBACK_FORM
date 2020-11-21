<?php


namespace App\Http\Controllers\Appeals;

use App\Models\Appeals;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppealController extends Controller
{
    function getData() {
        try {
            $response = Appeals::getData();
            return $this->successResponseSimple(200, $response);
        } catch (\DomainException $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }
}
