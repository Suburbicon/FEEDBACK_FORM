<?php

namespace App\Models\Departments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{

    protected $table = 'departments';
    protected $guarded = [];

    static public function getData()
    {
        return DB::table('departments')->select("*")->orderBy('id', 'asc')->get();
    }

    static function Validate($request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_city' => 'required|string|max:255',
        ]);
    }

    static function Add($request)
    {
        $department = Department::create([
            'name' => $request['name'],
            'id_city' => $request['id_city'],
        ]);

        return array(
            'id' => $department['id'],
            'name' => $department['id'],
            'id_city' => $department['id_city'],
        );
    }

    static function Edit($request)
    {
        Department::where('id', $request['id'])->update([
            'name' => $request['name']
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
