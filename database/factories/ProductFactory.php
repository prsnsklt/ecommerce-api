<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Product;
use Faker\Generator as Faker;

//bikin dummy data
$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'=>$faker->word,
        'detail'=>$faker->paragraph,
        'price'=>$faker->numberBetween($min = 100, $max = 1000),
        'stock'=>$faker->randomDigit,
        'discount'=>$faker->numberBetween($min= 10, $max=50)
    ];
});
