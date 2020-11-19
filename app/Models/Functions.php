<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Functions extends Model {

  static function MakeTree(&$elements, $parent_id){
    $result = array();
    foreach ($elements as $key => $element){
      if (($parent_id == $element->parent_id) or (!$parent_id and !$element->parent_id)){
        $element->childs = self::MakeTree($elements, $element->id);
        $result[] = $element;
      }
    }

    return $result;
  }
}
