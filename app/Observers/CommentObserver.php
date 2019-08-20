<?php

namespace App\Observers;

use Auth;

class CommentObserver
{
    public function creating($model)
    {
        if (! $model->topic_id) {
            if ($model->parent) {
                $model->topic_id = $model->parent->topic_id;
            }
        }

        if (! $model->user_id) {
            if (Auth::check()) {
                $model->user_id = Auth::id();
            }
        }
    }
}
