<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KosnicaResource extends JsonResource
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
            'oznaka' => $this->oznaka,
            'tip' => $this->tip,
            'status' => $this->status,
            'pcelinjak' => new PcelinjakResource($this->whenLoaded('pcelinjak')),
            'drustvos' => DrustvoResource::collection($this->whenLoaded('drustvos'))
        ];
    }
}
