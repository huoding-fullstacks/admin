<?php

namespace App\Providers;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Models\Comment;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use App\Observers\CommentObserver;
use App\Observers\TopicObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCarbon();
        $this->registerRelation();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Comment::observe(CommentObserver::class);
        Topic::observe(TopicObserver::class);
    }

    protected function registerCarbon()
    {
        Carbon::setLocale(config('app.locale'));
    }

    protected function registerRelation()
    {
        Relation::morphMap([
            'comment' => Comment::class,
            'tag' => Tag::class,
            'topic' => Topic::class,
            'user' => User::class,
        ]);
    }
}
