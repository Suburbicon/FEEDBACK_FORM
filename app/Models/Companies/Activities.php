<?php

namespace App\Models\Companies;

use App\Models\Functions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Activities extends Model {

  static function getList(){
    $activities = DB::table('companies_activity')
      ->select('id', 'name', 'description', 'parent_id')
      ->where('to_display', '=', '1')
      ->get();
    return Functions::MakeTree($activities, 0);
  }

}
