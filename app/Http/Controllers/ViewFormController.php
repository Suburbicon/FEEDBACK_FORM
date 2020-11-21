<?php

namespace App\Http\Controllers;

use App\Models\Appeals;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewFormController extends Controller {

    public function index(){
        return view('form.index');
    }

    public function result(){
        return view('form.result');
    }

    function getData() {
        try {
            $response = Appeals::getData();
            return $this->successResponseSimple(200, $response);
        } catch (\DomainException $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

    public function Add(Request $request) {
        try {
            Appeals::Validate($request);
            $response = Appeals::Add($request);

            return view('form.result', $response);
//            return $this->successResponseSimple(200, $response);
        } catch (\DomainException $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

}
