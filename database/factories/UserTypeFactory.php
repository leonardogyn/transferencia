<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use Illuminate\Support\Str;
use Modules\UserType\Entities\UserType;
use Faker\Generator as Faker;
use Ramsey\Uuid\Uuid;

$factory->define(UserType::class, function (Faker $faker) {
    return [
        'id' => Uuid::uuid4()->toString(),
        'name' => $faker->name,
        'flag' => Str::upper($faker->randomLetter),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});


