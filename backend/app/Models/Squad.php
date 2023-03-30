<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squad extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'players' => 'json'
    ];

    public function scopeFromMatchDay($builder, $matchId)
    {
        return $builder->where('match_day_id', $matchId);
    }
}
