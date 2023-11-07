<?php

namespace App\Http\Controllers\Api;

use App\Enums\TicketTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TicketRequest;
use App\Http\Resources\Api\TicketListResource;
use App\Http\Resources\Api\TicketResource;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Ticket::query();
        $perPage = $request->input('per_page', self::PER_PAGE);

        if ($request->has('type')) {
            $type = Str::lower($request->input('type')) === Str::lower(TicketTypeEnum::ISSUE->name)
                ? TicketTypeEnum::ISSUE
                : TicketTypeEnum::SUGGESTION;

            $query->where('type', $type);
        }

        $tickets = $query->paginate($perPage);

        return TicketListResource::collection($tickets);
    }

    public function store(TicketRequest $request, TicketService $service): JsonResponse
    {
        $ticket = $service->create($request->validated());

        return response()->json([
            'data' => TicketResource::make($ticket)
        ], 201);
    }

    public function show(Ticket $ticket): TicketResource
    {
        return TicketResource::make($ticket);
    }

    public function update(TicketRequest $request, Ticket $ticket, TicketService $service): JsonResponse
    {
        $ticket = $service->update($ticket, $request->validated());

        return response()->json([
            'data' => TicketResource::make($ticket)
        ]);
    }

    public function destroy(TicketRequest $request, Ticket $ticket): JsonResponse
    {
        $ticket->delete();

        return response()->json(null, 204);
    }
}
