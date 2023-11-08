<?php

namespace Tests\Feature;

use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    public function test_can_get_tags_list(): void
    {
        $response = $this->get('/api/tags');

        $response->assertStatus(200);
    }

    public function test_can_find_tag(): void
    {
        $tag = Tag::query()->first();

        $response = $this->get('/api/tags/find?q=' . $tag->name);

        $response->assertStatus(200);
    }
}
