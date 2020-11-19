<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Config extends Model {

  static function getStatuses(){
    return DB::table('orders_statuses')->select('orders_statuses.id', 'orders_statuses.status AS name')->get();
  }

  static function getServices(){
    $services = DB::table('orders_services')->select('orders_services.id', 'orders_services.name', 'orders_services.description', 'orders_services.parent_id')->get();
    return Functions::MakeTree($services, 0);
  }

  static function ConvertToAssoc($data, $field = "id"){
    $result = array();
    foreach ($data as $item){
      $key = $item->$field;
      $result[$key] = $item;
    }
    return $result;
  }

}

