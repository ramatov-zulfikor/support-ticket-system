<?php

namespace App\Models;

use App\Enums\TicketTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'name',
        'description',
        'type',
    ];

    protected $casts = [
        'type' => TicketTypeEnum::class
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
