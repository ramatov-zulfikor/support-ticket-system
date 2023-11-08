<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $tickets = [
            [
                'name' => 'Issue ticket #1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'author_id' => 1
            ],
            [
                'name' => 'Issue ticket #2',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'author_id' => 1
            ],
            [
                'name' => 'Suggestion ticket #1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'author_id' => 1
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::query()
                ->updateOrCreate(
                    ['name' => $ticket['name']],
                    $ticket
                );
        }
    }
}
