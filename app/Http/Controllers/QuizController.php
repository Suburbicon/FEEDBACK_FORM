<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller {

	public function index(){
		return view('quiz.index');
	}

	public function result(){
	    return view('quiz.thanks-quiz');
    }

    function getData() {
        try {
            $response = Quiz::getData();
            return $this->successResponseSimple(200, $response);
        } catch (\DomainException $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

    public function store(Request $request){
        try{
            Quiz::Validate($request);
            $response = Quiz::Add($request);

            return 'success';
        } catch ( \DomainException $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }
}
