<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TagResource;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TagController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Tag::query();
        $perPage = $request->input('per_page', self::PER_PAGE);

        if ($request->has('q')) {
            $query->where('name', 'LIKE', '%' . $request->input('q') . '%');
        }

        $tags = $query->paginate($perPage);

        return TagResource::collection($tags);
    }

    public function find(Request $request): TagResource|JsonResponse
    {
        if (! $request->filled('q')) {
            return response()->json([
                'data' => null
            ]);
        }

        $tag = Tag::query()
            ->where('name', 'LIKE', '%' . $request->input('q') . '%')
            ->first();

        return TagResource::make($tag);
    }
}
