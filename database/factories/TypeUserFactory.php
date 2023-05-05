<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'id' => Uuid::uuid4()->toString(),
        'name' => $faker->name,
        'flag' => Str::ucfirst($faker->randomLetter)
    ];
});
