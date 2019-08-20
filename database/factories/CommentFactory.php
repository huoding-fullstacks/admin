<?php

use Faker\Generator as Faker;

use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;

$factory->define(Comment::class, function (Faker $faker, array $attributes = []) {
    return [
        'id' => $attributes['id'] ?? null,
        'parent_id' => $attributes['parent_id'] ?? 0,

        'topic_id' => $attributes['topic_id'] ?? function () {
            return factory(Topic::class)->create()->id;
        },

        'user_id' => $attributes['user_id'] ?? function () {
            return factory(User::class)->create()->id;
        },

        'content' => $attributes['content'] ?? $faker->paragraph(),
        'like_count' => $attributes['like_count'] ?? $faker->numberBetween(0, 100),

        'status' => $attributes['status'] ?? $faker->randomElement([
            'reviewed',
            'unreviewed',
        ]),

        'created_at' => $attributes['created_at'] ?? $faker->dateTimeBetween('-1 month'),
    ];
});
