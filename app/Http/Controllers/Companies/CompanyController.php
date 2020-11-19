<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\Companies\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller {

  function getData() {
    try {
      $response = Company::getData();
      return $this->successResponseSimple(200, $response);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }

  function Add(Request $request) {
    try {
      Company::Validate($request);
      $response = Company::Add($request);

      return $this->successResponse(200, $response);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }

  function Edit(Request $request){
    try {
      Company::Validate($request);
      $response = Company::Edit($request);

      return $this->successResponse(200, $response);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }

  function Search(Request $request) {
    try {
      $request->validate([
        'needle' => 'required|string|max:255|alpha_dash',
        'limit' => 'int',
      ]);

      $needle = $request->input('needle');
      $limit = $request->input('limit', 10);
      $response = Company::Search($needle, $limit);

      return $this->successResponseSimple(200, $response);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 419);
    }
  }

  function SearchByMemberId(Request $request) {
    try {
      $request->validate([
        'member_id' => 'required|int|min:1',
        'limit' => 'int',
      ]);

      $member_id = $request->input('member_id');
      $limit = $request->input('limit', 10);
      $response = Company::SearchByMemberId($member_id, $limit);

      return $this->successResponseSimple(200, $response);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 419);
    }
  }

}
