<?php

namespace App\Http\Controllers\Departments;

use App\Models\Departments\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller {

  function getData() {
    try {
      $response = Department::getData();
      return $this->successResponseSimple(200, $response);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }

  function Add(Request $request) {
    try {
      Department::Validate($request);
      $response = Department::Add($request);

      return $this->successResponse(200, $response);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }

  function Edit(Request $request){
    try {
      Department::Validate($request);
      $response = Department::Edit($request);

      return $this->successResponse(200 , $response);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }

  /* function Search(Request $request) {
    try {
      $request->validate([
        'needle' => 'required|string|max:255|alpha_dash',
        'limit' => 'int',
      ]);

      $needle = $request->input('needle');
      $limit = $request->input('limit', 10);
      $response = Member::Search($needle, $limit);

      return $this->successResponseSimple(200, $response);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  } */

/*   function setRelationshipToCompany(Request $request) {
    try {
      $this->validate($request, [
        'member_id' => 'required|int|min:1',
        'company_id' => 'required|int|min:1',
      ]);

      Member::setRelationshipMemberToCompany($request['member_id'], $request['company_id']);

      return $this->successResponse(200);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  } */
}
