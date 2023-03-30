<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchPlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->user;
        $card = $user->card;
        return [
            'id' => $this->id,
            'confirmed' => $this->confirmed,
            'user' => new UserResource($user)
        ];
    }
}
