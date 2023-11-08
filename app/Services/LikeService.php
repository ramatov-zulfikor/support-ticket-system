<?php

namespace App\Services;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeService
{
    public function like(int $likeableId, string $likeableType): void
    {
        Like::query()
            ->updateOrCreate([
                'author_id' => Auth::id(),
                'likeable_id' => $likeableId,
                'likeable_type' => $likeableType
            ]);
    }
}
