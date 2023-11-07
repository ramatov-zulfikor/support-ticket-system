<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = ['General', 'Android', 'iOS', 'Web'];

        foreach ($tags as $tag) {
            Tag::query()
                ->updateOrCreate(['name' => $tag]);
        }
    }
}
