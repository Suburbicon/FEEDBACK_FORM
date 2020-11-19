<?php

namespace App\Filters\Filter;

use Illuminate\Database\Eloquent\Builder;

class NumberFilter implements Filter {

  public function filter(Builder $builder, $property, $value) {
    $return = $builder;
//dd($builder);
    if ($value !== null) {
      $return = $builder->where($property, $value);
    }

    return $return;
  }
}