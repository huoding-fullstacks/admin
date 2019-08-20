<?php

use Faker\Generator as Faker;

use App\Models\Topic;
use App\Models\User;

$factory->define(Topic::class, function (Faker $faker, array $attributes = []) {
    return [
        'id' => $attributes['id'] ?? null,

        'user_id' => $attributes['user_id'] ?? function () {
            return factory(User::class)->create()->id;
        },

        'title' => $attributes['title'] ?? $faker->sentence(),

        'category' => $attributes['category'] ?? $faker->randomElement([
            'article',
            'talk',
        ]),

        'content' => $attributes['content'] ?? $faker->paragraph(),
        'source' => $attributes['source'] ?? $faker->word(),
        'link' => $attributes['link'] ?? $faker->url(),
        'like_count' => $attributes['like_count'] ?? $faker->numberBetween(0, 100),

        'status' => $attributes['status'] ?? $faker->randomElement([
            'reviewed',
            'unreviewed',
        ]),

        'created_at' => $attributes['created_at'] ?? $faker->dateTimeBetween('-1 month'),
    ];
});
