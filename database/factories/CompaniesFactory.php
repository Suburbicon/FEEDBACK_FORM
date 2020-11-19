<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Companies\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
      'id_number' => str_random(20),
      'name' => $faker->unique()->company,
      'short_name' => $faker->name,
      'type_id' => random_int(1, 50),
      'email' => $faker->companyEmail,
      'phone' => "+77".$faker->randomNumber(9),
      'address_legal' => $faker->address,
      'address_actual' => $faker->address,
      'address_mailing' => $faker->address,
      'activity_id' => random_int(1, 50),
      'director_firstname' => $faker->firstName,
      'director_lastname' => $faker->lastName,
      'director_secondname' => $faker->lastName,
      'kbe' => $faker->boolean,
    ];
});
