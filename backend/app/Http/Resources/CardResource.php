<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->only([ 'primary_position', 'secondary_position', 'pass', 'shoot', 'speed', 'stamina', 'dribble', 'overall', 'status']);
    }
}
