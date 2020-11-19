<?php

namespace App\Filters\Filter;

use Illuminate\Database\Eloquent\Builder;

interface Filter {

  public function filter(Builder $builder, $property, $value);

}