<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FakeSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TagSeeder::class,
            TicketSeeder::class,
            CommentSeeder::class
        ]);
    }
}
