<?php

use Illuminate\Database\Seeder;

use App\Models\Comment;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (! app()->environment('production')) {
            $this->truncateTables();
            $this->runSeeder();
        }
    }

    protected function truncateTables()
    {
        $tables = [
            'comments',
            'likables',
            'taggables',
            'tags',
            'topics',
            'users',
        ];

        foreach ($tables as $table) {
            DB::table($table)
                ->truncate();
        }
    }

    protected function runSeeder()
    {
        $user = factory(User::class)->create([
            'name' => 'test',
            'email' => 'test@test.test',
        ]);

        factory(Topic::class, 10)->create([
            'user_id' => $user->id,
        ])->each(function ($topic) {
            $topic->tags()->save(
                factory(Tag::class)->make()
            );

            $topic->likeUsers()->save(
                factory(User::class)->make()
            );

            $comment = $topic->comments()->save(
                factory(Comment::class)->make([
                    'topic_id' => $topic->id,
                ])
            );

            factory(Comment::class, rand(0, 10))->create([
                'parent_id' => $comment->id,
                'topic_id' => $comment->topic_id,
                'user_id' => $comment->user_id,
            ]);
        });
    }
}
