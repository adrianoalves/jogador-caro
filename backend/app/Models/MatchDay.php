<?php

namespace App\Models;

use App\Events\MatchDayCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class MatchDay extends AppModel
{
    use HasFactory;

    protected $casts = [
        'when' => 'datetime'
    ];
    protected static function booted()
    {
        $fn = self::uniqueEventDate();
        static::creating( $fn );
        static::updating( $fn );
    }

    protected $dispatchesEvents = [
        'created' => MatchDayCreated::class
    ];

    public function scopeHasAnotherAtSameDateRange($builder)
    {
        return $builder->whereBetween( $this->qualifyColumn('when'), [ $this->when->clone()->subHours(2), $this->when->clone()->addHours(2) ] );
    }

    private static function uniqueEventDate(): \Closure
    {
        return function( MatchDay $matchDay ) {
            $conflictuousMatchDay = $matchDay->hasAnotherAtSameDateRange()->first();
            \throw_if( $conflictuousMatchDay, new \Exception('Não é permitido criar 2 Eventos na mesma faixa de horário' ) );
        };
    }

    /**
     * @return HasManyThrough
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            MatchPlayer::class,
            'match_day_id',
            'id',
            'id',
            'user_id'
        );
    }
}
