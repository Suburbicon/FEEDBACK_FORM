<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quiz extends Model {

  protected $table = 'quiz';
  protected $guarded = [];

  static public function getData(){
    return DB::table('quiz')->select("*")->orderBy('id', 'asc')->get();
  }

    static public function exportData(){
        $response = DB::table('quiz')
            ->leftJoin('city', 'quiz.id_city','=','city.id')
            ->leftJoin('departments', 'quiz.id_department','=','departments.id')
            ->leftJoin('sectors', 'quiz.id_sector','=','sectors.id')
            ->select('quiz.id as id',
                'quiz.name as name',
                'quiz.liked     as liked',
                'quiz.not_liked as not_liked',
                'quiz.phone as phone',
                'quiz.comment as comment',
                'quiz.rating    as rating',
                'city.name      as id_city',
                'departments.name      as id_department',
                'sectors.name      as id_sector',
                'quiz.recomendation_rating as recomendation_rating',
                'quiz.created_at as created_at'
            )->orderBy('id', 'ASC');

        return $response;
    }


  static function Validate($request) {
    $request->validate([
      'id_city' => 'required|string|max:255',
      'id_department' => 'required|string|max:255',
      'id_sector' => 'required|string|max:255',
      'phone' => 'required|string|max:255',
      'name' => 'required|string|max:255',
      'comment' => 'required|string|max:255',
      'comment_stars' => 'required|string|max:255',
      'liked' => 'required|string|max:255',
      'not_liked' => 'required|string|max:255',
      'rating' => 'required|string|max:255',
      'recomendation_rating' => 'required|string'
    ]);
  }

  static function Add($request) {
      $quiz = Quiz::create([
      'id_city' => $request['id_city'],
      'id_department' => $request['id_department'],
      'id_sector' => $request['id_sector'],
      'phone' => $request['phone'],
      'name' => $request['name'],
      'comment' => $request['comment'],
      'comment_stars' => $request['comment_stars'],
      'liked' => $request['liked'],
      'not_liked' => $request['not_liked'],
      'rating' => $request['rating'],
      'recomendation_rating' => $request['recomendation_rating'],
    ]);

    return array(
      'id' => $quiz['id'],
      'id_city' => $quiz['id_city'],
      'id_department' => $quiz['id_department'],
      'id_sector' => $quiz['id_sector'],
      'phone' => $quiz['phone'],
      'name' => $quiz['name'],
      'comment' => $quiz['comment'],
      'comment_stars' => $quiz['comment_stars'],
      'liked' => $quiz['liked'],
      'not_liked' => $quiz['not_liked'],
      'rating' => $quiz['rating'],
      'recomendation_rating' => $quiz['recomendation_rating'],
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
