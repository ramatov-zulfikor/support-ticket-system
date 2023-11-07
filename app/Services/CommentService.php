<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function create(array $data, int $commentableId, string $commentableType): Comment|Model
    {
        return Comment::query()->create(array_merge($data, [
            'author_id' => Auth::id(),
            'commentable_id' => $commentableId,
            'commentable_type' => $commentableType,
        ]));
    }

    public function update(Comment $comment, array $data): Comment
    {
        $comment->update($data);

        return $comment;
    }
}
