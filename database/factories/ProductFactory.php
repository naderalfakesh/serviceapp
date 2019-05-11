<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\product;
use Faker\Generator as Faker;

$factory->define(product::class, function (Faker $faker) {
    $type=array('Motor','VFD','Gearbox');
    $randkeys=array_rand($type);

    $spec =array(
        'power' => $faker->text(10),
        'speed' => $faker->text(10),
        'frame' => $faker->text(10), 
    );

    $spec = json_encode($spec);
    return [
        'type' => $type[$randkeys],
        'materialNumber' => $faker->isbn10 ,
        'serialNumber' => $faker->isbn10 ,
        'attributes' => $spec
    ];
});
