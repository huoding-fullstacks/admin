<?php

namespace App\Observers;

use Auth;

class TopicObserver
{
    public function creating($model)
    {
        if (! $model->user_id) {
            if (Auth::check()) {
                $model->user_id = Auth::id();
            }
        }
    }
}
