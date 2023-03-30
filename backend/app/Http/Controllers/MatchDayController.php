<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchDay\CreateMatchDayRequest;
use App\Http\Resources\MatchDayCollection;
use App\Http\Resources\MatchDayResource;
use App\Models\MatchDay;
use Illuminate\Http\Request;

class MatchDayController extends Controller
{
    public function list(Request $request)
    {
        $perPage = $request->query('per_page', 5);
        return new MatchDayCollection( MatchDay::paginate( $perPage ) );
    }

    public function index(MatchDay $match)
    {
        return new MatchDayResource( $match );
    }


    public function create( CreateMatchDayRequest $request )
    {
        try {
            $matchDay = MatchDay::query()->create( $request->validated() );
            return \response()->json( $matchDay->only(['id', 'when', 'where']), 201 );
        }
        catch ( \Exception $e ) {
            return \response()->json(['message' => $e->getMessage()], 422 );
        }
    }
}
