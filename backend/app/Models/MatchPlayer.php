<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;

class MatchPlayer extends AppModel
{
    use HasFactory;

    public function match_day(): BelongsTo
    {
        return $this->belongsTo(MatchDay::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeConfirmed($builder)
    {
        return $builder->where('confirmed', true);
    }

    public function scopeFromMatch($builder, int $matchId)
    {
        return $builder->where('match_day_id', $matchId);
    }

    public function scopeFromUser($builder, int $userId)
    {
        return $builder->where('user_id', $userId);
    }

    /**
     * Toggle the user confirmation
     * @return bool return the confirmation value
     */
    public function toggleConfirmed(): bool
    {
        $this->update([
            'confirmed' => !$this->confirmed
        ]);
        $this->refresh();

        return $this->confirmed;
    }
}
