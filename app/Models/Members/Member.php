<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model {

  protected $table = 'members';
  protected $guarded = [];

  static public function getData(){
    return DB::table('members')->select("*")->orderBy('id', 'desc')->get();
  }

  static function Validate($request) {
    $request->validate([
      'entity' => 'required|int|in:0,1',
      'firstname' => 'required|string|max:255|alpha_dash',
      'lastname' => 'required|string|max:255|alpha_dash',
      'secondname' => 'required_if:secondname,!=,nullable|string|max:255|alpha_dash',
      'email' => 'required|string|email|max:55',
      'phone_mobile' => 'required|phone:KZ,RU',
      'phone_landline' => 'required_if:phone_landline,!=,nullable|phone:KZ,RU',
      'phone_landline_adt' => 'int|max:99999',
      'adt_info' => 'string',
    ]);
  }

  static function Add($request) {
    $member = Member::create([
      'firstname' => mb_convert_case($request['firstname'], MB_CASE_TITLE),
      'lastname' => mb_convert_case($request['lastname'], MB_CASE_TITLE),
      'secondname' => mb_convert_case($request['secondname'], MB_CASE_TITLE),
      'email' => $request['email'],
      'phone_mobile' => $request['phone_mobile'],
      'phone_landline' => $request['phone_landline'],
      'phone_landline_adt' => $request['phone_landline_adt'],
      'adt_info' => $request['adt_info'],
      'entity' => $request['entity'],
    ]);

    return array(
      'id' => $member['id'],
      'member_id' => $member['id'],
      'entity' => $member['entity'],
      'name' => $member['lastname']." ".$member['firstname']." ".$member['secondname']
    );
  }

  static function Edit($request){
    Member::where('id', $request['id'])->update([
      'firstname' => mb_convert_case($request['firstname'], MB_CASE_TITLE),
      'lastname' => mb_convert_case($request['lastname'], MB_CASE_TITLE),
      'secondname' => mb_convert_case($request['secondname'], MB_CASE_TITLE),
      'email' => $request['email'],
      'phone_mobile' => $request['phone_mobile'],
      'phone_landline' => $request['phone_landline'],
      'phone_landline_adt' => $request['phone_landline_adt'],
      'adt_info' => $request['adt_info'],
      'entity' => $request['entity'],
    ]);

    return array(
      "success" => true
    );
  }

  static function setRelationshipMemberToCompany($member_id, $company_id){
    if ($company_id && $member_id && !self::isCompanyMemberMappingExist($member_id, $company_id)){
      DB::table('companies_members_mapping')->insert(
        ['member_id' => $member_id, 'company_id' => $company_id]
      );
    }
  }

  static function Search($needle, $limit){
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
  }

  static function isEntity($member_id){
    return DB::table('members')
      ->select('entity')
      ->where('id','=', $member_id)
      ->value('entity');
  }

  static function isCompanyMemberMappingExist($member_id, $company_id){
    return DB::table('companies_members_mapping')
      ->select('id')
      ->where('member_id','=', $member_id)
      ->where('company_id','=', $company_id)
      ->value('id');
  }

}
