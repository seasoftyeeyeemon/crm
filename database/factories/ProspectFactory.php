<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Prospect;
use Faker\Generator as Faker;

$factory->define(Prospect::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone1'=>$faker->phoneNumber,
        'phone2'=>$faker->phoneNumber,
        'address'=>$faker->address,
        'city'=>$faker->city,
        'note'=>$faker->paragraph,
        'prospect_message'=>$faker->paragraph

    ];
});
