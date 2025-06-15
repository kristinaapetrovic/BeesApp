<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PcelinjakResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id' => $this->id,
            'naziv' => $this->naziv,
            'lokacija' => $this->lokacija,
            'user' => new UserResource($this->whenLoaded('user')),
            'kosnicas'=>KosnicaResource::collection($this->whenLoaded('kosnicas'))
        ];
    }
}
