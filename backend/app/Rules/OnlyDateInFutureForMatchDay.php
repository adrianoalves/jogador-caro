<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;

class OnlyDateInFutureForMatchDay implements ValidationRule
{
    /**
     * Validate the match date to avoid create matches without a minimum of 2h to organize the event.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $when = Carbon::parse($value);
        $limitDate = Carbon::now()->addHours(2);
        if( $limitDate->gte( $when ) ) {
            $fail('O Evento precisa ter pelo menos 2 horas de antecedência' );
        }
    }
}
