<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Resources\Api\CommentResource;
use App\Models\Comment;
use App\Models\Ticket;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketCommentController extends Controller
{
    public function index(Request $request, Ticket $ticket): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page', self::PER_PAGE);

        $comments = $ticket->comments()
            ->with('author')
            ->paginate($perPage);

        return CommentResource::collection($comments);
    }

    public function store(CommentRequest $request, Ticket $ticket, CommentService $service): JsonResponse
    {
        $comment = $service->create($request->all(), $ticket->id, Ticket::class);

        return CommentResource::make($comment)
            ->response()
            ->setStatusCode(201);
    }

    public function update(CommentRequest $request, Ticket $ticket, Comment $comment, CommentService $service): CommentResource
    {
        $comment = $service->update($comment, $request->all());

        return CommentResource::make($comment);
    }

    public function destroy(CommentRequest $request, Ticket $ticket, Comment $comment): JsonResponse
    {
        $comment->delete();

        return response()->json(null, 204);
    }
}
