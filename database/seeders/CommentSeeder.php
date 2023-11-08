<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        Comment::query()
            ->create([
                'author_id' => 1,
                'text' => 'This is a comment',
                'commentable_id' => 1,
                'commentable_type' => Ticket::class
            ]);
    }
}
