<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewFormController extends Controller {

    public function index(){
        return view('form.index');
    }

    public function result(){
        return view('form.result');
    }

}
