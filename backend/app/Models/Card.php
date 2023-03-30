<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends AppModel
{
    use HasFactory;

    protected static function booted()
    {
        $closure = static::getOverallSetter();
        static::creating($closure);
        static::updating($closure);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    private static function getOverallSetter(): \Closure
    {
        return function (Card $card) {
            $levels = ['pass', 'shoot', 'speed', 'stamina', 'dribble'];
            $card->overall = \array_reduce($levels, fn($carrier, $level ) => $carrier += $card->{$level} ?? 1, 0 );
            $card->overall = \round( $card->overall / \count( $levels ) );
        };
    }
}
