<?php

namespace App\Http\Controllers;

use App\Http\Resources\MatchPlayerCollection;
use App\Models\MatchPlayer;
use Illuminate\Http\Request;

class MatchPlayerController extends Controller
{
    public function index(Request $request, int $match_id)
    {
        sleep(2);
        $perPage = $request->query('per_page', 50);
        return new MatchPlayerCollection( MatchPlayer::fromMatch($match_id)->paginate( $perPage ) );
    }

    public function updateConfirmation( Request $request )
    {
        try {
            $matchPlayerId = $request->id;
            $confirmed = MatchPlayer::find($matchPlayerId)->toggleConfirmed();
            return \response()->json( [ 'confirmed' => $confirmed ] );
        }
        catch ( \Exception $e ) {
            return \response()->json(['message' => $e->getMessage()], 422 );
        }
    }
}
