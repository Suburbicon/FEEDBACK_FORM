<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Types extends Model {

  static function getList(){
    return DB::table('companies_types')->select('id', 'name', 'full_name')->get();
  }

}
