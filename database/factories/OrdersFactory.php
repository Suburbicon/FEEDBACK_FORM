<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Orders\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
      'company_id' => random_int(1, 50),
      'member_id' => random_int(1, 50),
      'status_id' => random_int(1, 50),
      'comment' => $faker->text,
    ];
});
