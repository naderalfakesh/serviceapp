<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\contact;
use Faker\Generator as Faker;

$factory->define(contact::class, function (Faker $faker) {
    return [
        'company_id' => $faker->numberBetween(1,50),
        'name' => $faker->name,
        'email' => $faker->companyEmail,
        'phone' => $faker->PhoneNumber,
    ];
});
