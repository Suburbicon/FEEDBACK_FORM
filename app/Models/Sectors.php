<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\QrController;

class Sectors extends Model
{

    protected $table = 'sectors';
    protected $guarded = [];

    static public function getData()
    {
        return DB::table('sectors')->select("*")->orderBy('id', 'asc')->get();
    }

    static function Validate($request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_department' => 'required|string|max:255',
        ]);
    }

    static function Add($request)
    {
        $sectors = Sectors::create([
            'name' => $request['name'],
            'id_department' => $request['id_department'],
        ]);

        return array(
            'id' => $sectors['id'],
            'name' => $sectors['name'],
            'id_department' => $sectors['id_department'],
        );
    }

    static function AddQR($request)
    {
        $params = [
            "id_city" => $request['id_city'],
            "id_department" => $request['id_department'],
            "id" => $request['id']
        ];

        $QR = new QrController();
        $path_to_qr = $QR->QrGenerated($params);

        Sectors::where('id', $request['id'])->update([
            'path_to_qr' => $path_to_qr
        ]);
    }

    static function Edit($request)
    {
        Sectors::where('id', $request['id'])->update([
            'name' => $request['name'],
            'id_department' => $request['id_department'],
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
