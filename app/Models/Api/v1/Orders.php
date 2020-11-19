<?php

namespace App\Models\Api\v1;

use App\Models\Members\Member;
use App\Models\Orders\Order;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model {

  static function Add($email, $name, $message = '') {
    $member = Member::where('email', $email)->first();

    if (!$member) {
      $member_info = array(
        'firstname' => $name,
        'lastname' => '',
        'secondname' => '',
        'email' => $email,
        'phone_mobile' => '',
        'phone_landline' => '',
        'phone_landline_adt' => '',
        'adt_info' => '',
        'member_entity' => 0,
      );

      $member = Member::Add($member_info);
    }

    $order_info = array(
      'company_id' => null,
      'member_id' => $member['id'],
      'status_id' => 1,
      'comment' => $message,
    );

    Order::Add($order_info);




  }
}
