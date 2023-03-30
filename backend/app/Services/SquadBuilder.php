<?php
namespace App\Services;

use App\Models\Concerns\Position;
use App\Models\MatchPlayer;

class SquadBuilder
{
    /**
     * Get the confirmed players by match id
     * @param int $matchId
     * @return mixed
     */
    public function getConfirmedPlayersByMatch(int $matchId)
    {
        return MatchPlayer::confirmed()->fromMatch($matchId)->get()->keyBy('id')->sortByDesc('user.card.overall');
    }

    /**
     * @param int $matchId
     * @return int returns the number of squads related to a match
     */
    public function alreadyHasSquadsForMatchDay(int $matchId): int
    {
        return \App\Models\Squad::where('match_day_id', $matchId )->count('id');
    }

    /**
     * Main method to build teams using the players confirmations
     * @param int $matchId the Match day ID
     * @param int $howManyPlayersPerSquad the number of players by squad
     * @throws \Exception
     * @return array
     */
    public function handle( int $matchId, int $howManyPlayersPerSquad = 5 ): array
    {
        \throw_if( $this->alreadyHasSquadsForMatchDay($matchId), new \Exception('Os times já foram formados para esta Match'));

        $players = $this->getConfirmedPlayersByMatch($matchId);
        $userAttrs = [ 'id', 'name', 'email' ];
        $cardAttrs = [ 'primary_position', 'secondary_position', 'overall', 'speed', 'shoot', 'stamina', 'dribble', 'pass'];

        $totalPlayers = $players->count();
        $howManySquads = \floor($totalPlayers / $howManyPlayersPerSquad);

        \throw_if($howManySquads < 2, new \Exception("Não foi possível montar 2 times de {$howManyPlayersPerSquad} Jogadores com o número de jogadores confirmados"));

        $goalKeepers = $players->where('user.card.primary_position', Position::GOALKEEPER->value);
        $squads = [];

        for( $i=1; $i <= $howManySquads; $i++ ) {

            $goalKeeper = $goalKeepers->first();
            if($goalKeeper) {
                $squads[ $i ] = [
                    [
                        'user' => $goalKeeper->user->only($userAttrs),
                        'card' => $goalKeeper->user->card->only($cardAttrs)
                    ]
                ];
                $players->forget($goalKeeper->id);
                $goalKeepers->forget($goalKeeper->id);
            }
        }

        while ( $totalPlayers > 0 ) {
            --$totalPlayers;
            for( $j=1; $j <= $howManySquads; $j++ ) {

                $player = $players->first();
                if($player) {

                    $squads[ $j ][] = [
                        'user' => $player->user->only($userAttrs),
                        'card' => $player->user->card->only($cardAttrs)
                    ];
                    $players->forget($player->id);
                }
            }
        }

        return $squads;
    }
}
