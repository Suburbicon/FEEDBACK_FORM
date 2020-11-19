<?php

namespace App\Filters;

use App\Filters\Filter\NumberFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Filters {

  protected $request;

  public function __construct(Request $request) {
    $this->request = $request;
  }

  public function filter(Builder $builder, $properties) {
    $filters = $this->getFilters();
//dd($filters);
    foreach ($filters as $filter) {
      if (isset($properties[$filter['property']])){
        $this->resolveFilter($properties[$filter['property']])->filter($builder, $filter['property'], $filter['value']);
      }
    }

    return $builder;
  }

  private function getFilters() {
    return $this->request->filters;
  }

  private function resolveFilter($filter_type) {
    switch ($filter_type){
      case 'number':
        $class = new NumberFilter();
        break;
      default:
        $class = false;
        break;
    }

    return $class;
//    return new $this->filters[$filter];
  }

  /*protected function filterFilters() {
    return $this->request->filters;
  }*/

}