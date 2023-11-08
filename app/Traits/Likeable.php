<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

trait Likeable
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function isLikedByCurrentUser(): bool
    {
        if ($this->relationLoaded('likes')) {
            return boolval($this->likes->where('author_id', Auth::id())->count());
        } else {
            return $this->likes()->where('author_id', Auth::id())->exists();
        }
    }
}
