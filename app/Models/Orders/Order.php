<?php

namespace App\Models\Orders;

use App\Filters\Filters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model {

  protected $table = 'orders';
  protected $fillable = ['company_id', 'member_id', 'status_id', 'comment'];

  static public function getData(){
    return DB::select( DB::raw("SELECT o.id AS order_id, s.id AS status_id, c.name AS company, c.id AS company_id, CONCAT(m.firstname, ' ', m.lastname, ' ', m.secondname) AS member_name, services_ids, m.entity, o.comment, m.id AS member_id
                                FROM orders AS o
                                LEFT JOIN members AS m ON m.id = o.member_id
                                LEFT JOIN companies AS c ON c.id = o.company_id
                                LEFT JOIN orders_statuses AS s ON s.id = o.status_id
                                LEFT JOIN (
                                    SELECT order_id, GROUP_CONCAT(service_id) AS services_ids FROM orders_services_mapping GROUP BY order_id
                                ) AS osmap ON osmap.order_id = o.id
                                ORDER BY o.id DESC"));
  }

  static function Add($request) {
    $order = Order::create([
      'company_id' => $request['company_id'],
      'member_id' => $request['member_id'],
      'status_id' => $request['status_id'],
      'comment' => ($request['comment'] ? $request['comment'] : ''),
    ]);

    return $order;
  }

  static function addServicesInOrder($order_id, $services){
    $indsert_data = array();
    foreach ($services as $service_id){
      $indsert_data[] = array(
        'order_id' => $order_id,
        'service_id' => $service_id
      );
    }

    DB::table('orders_services_mapping')->insert(
      $indsert_data
    );
  }

  static function editServicesInOrder($order_id, $services) {
    self::removeServicesInOrder($order_id);
    self::addServicesInOrder($order_id, $services);
  }

  static function removeServicesInOrder($order_id) {
    DB::table('orders_services_mapping')->where('order_id', '=', $order_id)->delete();
  }

  static function setStatusChangeLog($order_id, $new_status, $old_status = false) {
    if (!$old_status){
      $old_status = self::getOrderCurrentStatus($order_id);
    }

    DB::table('orders_statuses_change_log')->insert([
      'user_id' => Auth::user()->id,
      'order_id' => $order_id,
      'old_status' => $new_status,
      'new_status' => $old_status,
    ]);
  }

  static function getOrderCurrentStatus($order_id){
    return DB::table('orders')->select('status_id')->where('id', '=', $order_id)->value('status_id');
  }

  public function scopeFilter(Builder $builder, Request $request) {
    $properties = [
      'id' => 'number',
      'service_id' => 'number',
      'status' => 'string',
      'created_at' => 'date',
      'kbe' => 'boolean'
    ];

    return (new Filters(request()))->filter($builder, $properties);
  }


  public function company() {
    return $this->belongsTo('App\Models\Companies\Company', 'company_id', 'id');
  }

  public function status() {
    return $this->belongsTo('App\Models\Companies\Company', 'company_id', 'id');
  }

}
