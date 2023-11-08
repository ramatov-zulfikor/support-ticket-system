<?php

namespace App\Models;

use App\Enums\TicketTypeEnum;
use App\Traits\Commentable;
use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
    use HasFactory, Commentable, Likeable;

    protected $fillable = [
        'author_id',
        'name',
        'description',
        'type',
        'is_closed',
    ];

    protected $casts = [
        'type' => TicketTypeEnum::class
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function close(): void
    {
        $this->is_closed = true;
        $this->saveQuietly();
    }
}
