<?php

use Faker\Generator as Faker;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

$factory->define(User::class, function (Faker $faker, array $attributes = []) {
    return [
        'id' => $attributes['id'] ?? null,
        'name' => $attributes['name'] ?? $faker->name,
        'email' => $attributes['email'] ?? $faker->unique()->safeEmail,
        'password' => $attributes['password'] ?? Hash::make('secret'),
        'created_at' => $attributes['created_at'] ?? $faker->dateTimeBetween('-1 month'),
    ];
});
