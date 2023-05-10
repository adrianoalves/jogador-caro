<?php

namespace App\Listeners;

use App\Events\MatchDayCreated;
use App\Models\MatchPlayer;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MatchDayCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle( MatchDayCreated $event ): void
    {
        $matchDay = $event->matchDay;
        $users = User::active()->get();

        if( $users ) {
            foreach( $users as $user ) {
                MatchPlayer::create([
                    'match_day_id' => $matchDay->id,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
