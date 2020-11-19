<?php

namespace App\Http\Controllers\Orders;

use App\Models\Companies\Company;
use App\Models\Members\Member;
use App\Models\Orders\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller {

//  private $Orders;

  public function __construct(){
//    $this->Orders = new Order();
  }

  public function getData(Request $request){
    try {
      //    $data = Order::filter($request)->get();
      $data = Order::getData();
      return $this->successResponseSimple(200, $data);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }

  public function Add(Request $request){
    try {
      $this->validate($request, [
        'member_id' => 'required|int|min:1',
        'status_id' => 'required|int|min:1',
        'services_ids.*' => 'required|int|min:1',
      ]);

      $is_entity = Member::isEntity($request['member_id']);

      if ($is_entity == 1 and (!$request->has('company_id') or !intval($request->company_id))){
        throw new \DomainException('Не указана компания для юридического лица');
      }

      $order = Order::Add($request);
      Order::addServicesInOrder($order['id'], $request['services_ids']);

      return $this->successResponse(200);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }

  public function Edit(Request $request){
    try {
      $this->validate($request, [
        'status_id' => 'required|int|min:1',
        'comment' => 'string',
        'services_ids.*' => 'required|int|min:1',
        'order_id' => 'required|int|min:1',
      ]);

      Order::where('id', $request['order_id'])->update(
        [
          'status_id' => $request['status_id'],
          'comment' => ($request['comment'] ? $request['comment'] : ''),
        ]
      );

      Order::editServicesInOrder($request['order_id'], $request['services_ids']);

      return $this->successResponse(200);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }

  function AddCompany(Request $request) {
    try {
      $this->validate($request, [
        'member_id' => 'required|int|min:1',
      ]);
      $response = Company::Add($request);
      Member::setRelationshipMemberToCompany($request['member_id'], $response['company_id']);
      return $this->successResponse(200, $response);
    } catch (\DomainException $e) {
      return $this->errorResponse($e->getMessage(), 422);
    }
  }
}
