<?php

namespace App\Http\Controllers;

use App\Http\Requests\SquadBuilderRequest;
use App\Http\Resources\SquadCollection;
use App\Models\Squad;
use App\Services\SquadBuilder;

class SquadController extends Controller
{
    public function list($match_id)
    {
        return new SquadCollection( Squad::fromMatchDay($match_id)->get() );
    }

    public function mount(SquadBuilderRequest $request)
    {
        try {
            $matchId = $request->post('match_id');
            $playersPerSquad = $request->post('players_per_squad', 5);

            $squads = (new SquadBuilder())->handle( $matchId, $playersPerSquad );

            foreach ( $squads as $squad ) {
                Squad::create([
                    'match_day_id' => $matchId,
                    'players' => $squad
                ]);
            }

            return new SquadCollection( Squad::fromMatchDay($matchId)->get() );
        }
        catch ( \Exception $e ) {
            return \response()->json(['message' => $e->getMessage()], 421 );
        }
    }
}
