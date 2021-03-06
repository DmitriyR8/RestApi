<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('1234567890'),
        'phone' => '0939994555'
    ];
});

$factory->define(Company::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text,
        'phone' => '0939994555'
    ];
});
