<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use NodeTrait;

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id')
            ->orderBy('left_id', 'desc');
    }

    public function likeUsers()
    {
        return $this->morphToMany(User::class, 'likable')
            ->withTimestamps();
    }

    public function getLftName()
    {
        return 'left_id';
    }

    public function getRgtName()
    {
        return 'right_id';
    }

    public function setParentId($value)
    {
        $this->attributes['parent_id'] = $value ?: 0;

        return $this;
    }
}
