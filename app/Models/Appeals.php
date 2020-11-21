<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appeals extends Model {

  protected $table = 'appeals';
  protected $guarded = [];

  static public function getData(){
    return DB::table('appeals')->select("*")->orderBy('id', 'asc')->get();
  }

  static function Validate($request) {
    $request->validate([
      'id_city' => 'required|string|max:255',
      'id_department' => 'required|string|max:255',
      'id_sector' => 'required|string|max:255',
      'info' => 'required|string|max:255',
    ]);
  }

  static function Add($request) {
    $appeals = Appeals::create([
      'id_city' => $request['id_city'],
      'id_department' => $request['id_department'],
      'id_sector' => $request['id_sector'],
      'info' => $request['info'],
    ]);

    return array(
      'id' => $appeals['id'],
      'id_city' => $appeals['id_city'],
      'id_department' => $appeals['id_department'],
      'id_sector' => $appeals['id_sector'],
      'info' => $appeals['info'],
    );
  }

//  static function Edit($request){
//      Appeals::where('id', $request['id'])->update([
//      'name' => mb_convert_case($request['name'], MB_CASE_TITLE),
//    ]);
//
//    return array(
//      "success" => true
//    );
//  }

/*   static function setRelationshipMemberToCompany($member_id, $company_id){
    if ($company_id && $member_id && !self::isCompanyMemberMappingExist($member_id, $company_id)){
      DB::table('companies_members_mapping')->insert(
        ['member_id' => $member_id, 'company_id' => $company_id]
      );
    }
  } */

/*   static function Search($needle, $limit){
    $fields = array(
      'members.id AS member_id',
      'members.firstname',
      'members.lastname',
      'members.secondname',
      'members.entity',
      DB::raw('CONCAT_WS(" ", members.firstname, members.lastname, members.secondname) AS name')
    );

    return DB::table('members')
      ->select($fields)
      ->where('firstname','like',$needle.'%')
      ->orWhere('lastname','like',$needle.'%')
      ->orWhere('secondname','like',$needle.'%')
      ->take($limit)
      ->get();
  } */
}
