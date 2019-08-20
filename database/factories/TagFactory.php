<?php

use Faker\Generator as Faker;

use App\Models\Tag;

$factory->define(Tag::class, function (Faker $faker, array $attributes = []) {
    return [
        'id' => $attributes['id'] ?? null,
        'name' => $attributes['name'] ?? $faker->word(),
        'topic_count' => $attributes['topic_count'] ?? $faker->numberBetween(0, 100),

        'status' => $attributes['status'] ?? $faker->randomElement([
            'reviewed',
            'unreviewed',
        ]),

        'created_at' => $attributes['created_at'] ?? $faker->dateTimeBetween('-1 month'),
    ];
});
