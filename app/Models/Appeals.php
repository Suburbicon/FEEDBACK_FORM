<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appeals extends Model {

  protected $table = 'appeals';
  protected $guarded = [];

  static public function getData(){
    return DB::table('appeals')->select("*")->orderBy('id', 'asc')->get();
    // ->get();
  }

    static public function exportData(){
        $response = DB::table('appeals')
            ->leftJoin('city', 'appeals.id_city','=','city.id')
            ->leftJoin('departments', 'appeals.id_department','=','departments.id')
            ->leftJoin('sectors', 'appeals.id_sector','=','sectors.id')
            ->select('appeals.id as id',
                'appeals.name as name',
                'appeals.phone as phone',
                'appeals.comment as comment',
                'city.name      as id_city',
                'departments.name      as id_department',
                'sectors.name      as id_sector',
                'appeals.recomendation_rating as recomendation_rating',
                'appeals.created_at as created_at'
            )->orderBy('id', 'ASC');

        return $response;
    }

  static function Validate($request) {
    $request->validate([
      'id_city' => 'required|string|max:255',
      'id_department' => 'required|string|max:255',
      'id_sector' => 'required|string|max:255',
      'phone' => 'required|string|min:12|max:12',
      'name' => 'required|string|max:255',
      'comment' => 'required|string|max:255',
      'recomendation_rating' => 'required|string'
    ]);
  }

  static function Add($request) {
    $appeals = Appeals::create([
      'id_city' => $request['id_city'],
      'id_department' => $request['id_department'],
      'id_sector' => $request['id_sector'],
      'phone' => $request['phone'],
      'name' => $request['name'],
      'comment' => $request['comment'],
      'recomendation_rating' => $request['recomendation_rating']
    ]);

    return array(
      'id' => $appeals['id'],
      'id_city' => $appeals['id_city'],
      'id_department' => $appeals['id_department'],
      'id_sector' => $appeals['id_sector'],
      'phone' => $appeals['phone'],
      'name' => $appeals['name'],
      'comment' => $appeals['comment'],
      'recomendation_rating' => $appeals['recomendation_rating']
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
