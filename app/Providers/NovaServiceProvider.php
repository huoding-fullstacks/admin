<?php

namespace App\Providers;

use App\Nova\Resources\Daily;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\NewUsersPerDay;
use App\Nova\Metrics\NewTopics;
use App\Nova\Metrics\NewTopicsPerDay;
use App\Nova\Metrics\NewComments;
use App\Nova\Metrics\NewCommentsPerDay;
use App\Nova\Resources\Comment;
use App\Nova\Resources\Tag;
use App\Nova\Resources\Topic;
use App\Nova\Resources\User;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            (new NewUsers)->width('1/2'),
            (new NewUsersPerDay)->width('1/2'),
            (new NewTopics)->width('1/2'),
            (new NewTopicsPerDay)->width('1/2'),
            (new NewComments)->width('1/2'),
            (new NewCommentsPerDay)->width('1/2'),
        ];
    }

    /**
     * Register the application's Nova resources.
     *
     * @return void
     */
    protected function resources()
    {
        Nova::resources([
            Topic::class,
            Comment::class,
            Tag::class,
            User::class,
            Daily::class,
        ]);
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
