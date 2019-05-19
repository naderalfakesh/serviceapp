<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\company;
use Faker\Generator as Faker;

$factory->define(company::class, function (Faker $faker) {
    $type=array('WEG Branch','Customer','Requesting company');
    $randkeys=array_rand($type);
    return [
        'name' => $faker->company,
        'type' => $type[$randkeys],
        'email' => $faker->companyEmail,
        'website' => 'www.'.$faker->domainName,
        'phone' => $faker->PhoneNumber,
        'taxAdmin' => $faker->text(5),
        'taxNumber' => $faker->text(5),
        'address' => $faker->address,
    ];
});
