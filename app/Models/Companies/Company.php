<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model {

  protected $table = 'companies';
  protected $guarded = [];

  static public function getData(){
    $items = DB::table('companies')->select("*")->orderBy('id', 'desc')->get();
    foreach ($items as $item){
        $item->bills = DB::table('companies_bills')->select("*")
                       ->where('company_id', '=', $item->id)
                       ->whereNull('deleted_at')
                       ->get();
    }
    return $items;
  }

  static function Validate($request) {
    $request->validate([
      'name' => 'required|string|max:255|alpha_dash',
      'short_name' => 'required|string|max:255|alpha_dash',
      'type_id' => 'required|int|min:1',
      'email' => 'required|string|email|max:55',
      'phone' => 'required',//TODO валидация стационарного телефона
      'address_legal' => 'required|string',
      'address_actual' => 'string',
      'address_mailing' => 'string',
      'activity_id' => 'required|int|min:1',
      'director_firstname' => 'required|string|max:255|alpha_dash',
      'director_lastname' => 'required|string|max:255|alpha_dash',
      'director_secondname' => 'string|max:255|alpha_dash',
      'bills.iban.*' => 'string|max:30|alpha_dash',
      'bills.currency.*' => 'string|min:2|max:2|alpha',
      'kbe' => 'required|int|in:0,1',
    ]);
  }

  static function Add($request) {
    $company = self::create([
      'id_number' => $request['id_number'],
      'name' => $request['name'],
      'short_name' => $request['short_name'],
      'type_id' => $request['type_id'],
      'email' => $request['email'],
      'phone' => $request['phone'],
      'address_legal' => $request['address_legal'],
      'address_actual' => $request['address_actual'] != '' ? $request['address_actual'] : $request['address_legal'],
      'address_mailing' => $request['address_mailing'] != '' ? $request['address_mailing'] : $request['address_legal'],
      'activity_id' => $request['activity_id'],
      'director_firstname' => mb_convert_case($request['director_firstname'], MB_CASE_TITLE),
      'director_lastname' => mb_convert_case($request['director_lastname'], MB_CASE_TITLE),
      'director_secondname' => mb_convert_case($request['director_secondname'], MB_CASE_TITLE),
      'kbe' => $request['kbe'],
    ]);

    self::addBills($company['id'], $request['bills']);

    return array(
      'company_id' => $company['id'],
      'name' => $company['name']
    );
  }

  static function Edit($request){
    Company::where('id', $request['id'])->update([
      'name' => $request['name'],
      'short_name' => $request['short_name'],
      'type_id' => $request['type_id'],
      'email' => $request['email'],
      'phone' => $request['phone'],
      'address_legal' => $request['address_legal'],
      'address_actual' => $request['address_actual'] != '' ? $request['address_actual'] : $request['address_legal'],
      'address_mailing' => $request['address_mailing'] != '' ? $request['address_mailing'] : $request['address_legal'],
      'activity_id' => $request['activity_id'],
      'director_firstname' => mb_convert_case($request['director_firstname'], MB_CASE_TITLE),
      'director_lastname' => mb_convert_case($request['director_lastname'], MB_CASE_TITLE),
      'director_secondname' => mb_convert_case($request['director_secondname'], MB_CASE_TITLE),
      'kbe' => $request['kbe']
    ]);

    self::editBills($request['id'], $request['bills'] , $request['bills_deleted']);

    return array(
      "success" => true
    );
  }

  static function addBills($company_id, $bills){
    $indsert_data = array();
    foreach ($bills as $bill){
      $indsert_data[] = array(
        'iban' => $bill['iban'],
        'bank_id' => self::getBankIdFromIBAN($bill['iban']),
        'currency' => $bill['currency'],
        'company_id' => $company_id,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      );
    }

    DB::table('companies_bills')->insert(
      $indsert_data
    );
  }

  static function editBills($company_id, $bills , $bills_deleted){
    foreach ($bills as $bill){
      if (!isset($bill['created_at'])){
          DB::table('companies_bills')->insert(
              array(
                'iban' => $bill['iban'],
                'bank_id' => self::getBankIdFromIBAN($bill['iban']),
                'currency' => $bill['currency'],
                'company_id' => $company_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
              )
          );
      } else {
          DB::table('companies_bills')
              ->where('company_id', $company_id)
              ->where('id', $bill['id'])
              ->update([
                  'iban' => $bill['iban'],
                  'bank_id' => self::getBankIdFromIBAN($bill['iban']),
                  'currency' => $bill['currency'],
                  'updated_at' => date('Y-m-d H:i:s')
              ]);
      }
    }
    if (!empty($bills_deleted)){
        foreach ($bills_deleted as $id) {
            DB::table('companies_bills')
                ->where('id', $id)
                ->update(['deleted_at' => date('Y-m-d H:i:s')]);
        }
    }
  }

  static function Search($needle, $limit){
    $fields = array(
      'id AS company_id',
      'name',
    );

    return DB::table('companies')
      ->select($fields)
      ->where('name','like','%'.$needle.'%')
      ->orWhere('short_name','like','%'.$needle.'%')
      ->take($limit)
      ->get();
  }

  static function SearchByMemberId($member_id, $limit){
    $fields = array(
      'companies.id AS company_id',
      'companies.name',
    );

    return DB::table('companies_members_mapping')
      ->select($fields)
      ->leftJoin('companies', 'companies_members_mapping.company_id', '=', 'companies.id')
      ->where('companies_members_mapping.member_id','=', $member_id)
      ->take($limit)
      ->get();
  }

  static private function getBankIdFromIBAN($iban) {
    $code_bank = substr($iban,4,3);

    return DB::table('directory_banks')
      ->select('id')
      ->where('code','=', $code_bank)
      ->value('id');
  }
}
