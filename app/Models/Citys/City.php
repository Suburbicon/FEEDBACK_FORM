<?php

namespace App\Models\Citys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class City extends Model {

  protected $table = 'city';
  protected $guarded = [];

  static public function getData(){
    return DB::table('city')->select("*")->orderBy('id', 'desc')->get();
  }

  static function Validate($request) {
    $request->validate([
      'name' => 'required|string|max:255|alpha_dash',
    ]);
  }

  static function Add($request) {
    $city = City::create([
      'name' => mb_convert_case($request['name'], MB_CASE_TITLE),
    ]);

    return array(
      'id' => $city['id'],
      'name' => $city['id'],
    );
  }

  static function Edit($request){
    City::where('id', $request['id'])->update([
      'name' => mb_convert_case($request['name'], MB_CASE_TITLE),
    ]);

    return array(
      "success" => true
    );
  }

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
