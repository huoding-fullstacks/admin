<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

use App\Nova\Resource;

class Topic extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Topic';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(__('Title'), 'title')
                ->rules('required', 'max:255')
                ->displayUsing(function ($title) {
                    return str_limit($title, 10);
                }),

            Select::make(__('Category'), 'category')->options([
                'article' => __('article'),
                'talk' => __('talk'),
            ]),

            Markdown::make(__('Content'), 'content'),

            Text::make(__('Source'), 'source')
                ->rules('required', 'max:255'),

            Text::make(__('Link'), 'link')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Number::make(__('Like Count'), 'like_count')
                ->exceptOnForms(),

            Select::make(__('Status'), 'status')->options([
                'reviewed' => __('reviewed'),
                'unreviewed' => __('unreviewed'),
            ]),

            MorphMany::make(__('tags'), 'tags'),
            MorphMany::make(__('comments'), 'comments'),
            MorphMany::make(__('Like Users'), 'likeUsers', User::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
