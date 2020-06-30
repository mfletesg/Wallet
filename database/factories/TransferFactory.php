<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transfer;
use Faker\Generator as Faker; //Genera informacion fake para pruebas

$factory->define(Transfer::class, function (Faker $faker) {
    return [
        'description' => $faker->text($maxNbChars = 200), //Genera texto en caracteres con 200 caracteres maximo
        'amount' => $faker->numberBetween($min = 10, $max = 90), //Genera numero de un minimo a un maximo,
        'wallet_id' => $faker->randomDigitNotNull, //Crea un numero random para la llave foranea
    ];
});
