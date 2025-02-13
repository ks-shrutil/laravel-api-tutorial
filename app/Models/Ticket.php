<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Resources\V1\TicketResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Filters\V1\QueryFilter;

class Ticket extends Model
{

    use HasFactory;

    protected $fillable = ['title', 'status', 'description', 'user_id'];

    /**
     * Undocumented function
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return new TicketResource($filters->apply($builder));
    }
}
