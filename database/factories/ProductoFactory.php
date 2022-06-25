<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Producto;
use Faker\Generator as Faker;

$factory->define(Producto::class, function (Faker $faker) {
    return [
        "nombre" => $faker ->sentence(),
        "precio" => $faker->randomFloat(2,3,5),
        "cantidad" => $faker->randomNumber(),
        "id_categoria" => 1
    ];
});
