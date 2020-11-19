<?php

namespace App\Http\Controllers;

use App\Models\Config;

class ConfigController extends Controller {

  function getAllConfig(){
    $statuses = Config::getStatuses();
    $services = Config::getServices();
    return $this->successResponseSimple(200, array(
      "statuses" => Config::ConvertToAssoc($statuses),
      "services" => Config::ConvertToAssoc($services),
    ));
  }
}
