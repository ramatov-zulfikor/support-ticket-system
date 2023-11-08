<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => Str::title($this->type->name),
            'is_closed' => boolval($this->is_closed),
            'author' => UserResource::make($this->author),
            'likes_count' => $this->likes()->count(),
            'liked' => Auth::check() ? $this->isLikedByCurrentUser() : false,
            'created_at' => strtotime($this->created_at),
            'updated_at' => strtotime($this->updated_at),
        ];
    }
}
