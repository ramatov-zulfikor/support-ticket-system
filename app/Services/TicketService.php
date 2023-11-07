<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;

class TicketService
{
    public function create(array $data): Ticket|Model
    {
        $ticket = Ticket::query()->create($data);

        $this->handleRelations($ticket, $data);

        return $ticket;
    }

    public function update(Ticket $ticket, array $data): Ticket
    {
        $ticket->update($data);

        $this->handleRelations($ticket, $data);

        return $ticket;
    }

    protected function handleRelations(Ticket $ticket, array $data): void
    {
        if (isset($data['tags_ids'])) {
            $ticket->tags()->sync($data['tags_ids']);
        }
    }
}
