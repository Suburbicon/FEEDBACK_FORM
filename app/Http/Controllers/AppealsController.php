<?php

namespace App\Http\Controllers;

use App\Models\Appeals;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppealsController extends Controller {

    public function index(){
        return view('quiz.info');
    }


    public function result(){
        return view('quiz.thanks-review');
    }

    function getData() {
        try {
            $response = Appeals::getData();
            return $this->successResponseSimple(200, $response);
        } catch (\DomainException $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

    public function store(Request $request) {

        try {
            Appeals::Validate($request);
            $response = Appeals::Add($request);
//&&
//            return $this->successResponse(200, $response);
            return 'success';
        } catch (\DomainException $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

}
