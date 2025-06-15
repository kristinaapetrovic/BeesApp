<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DrustvoResource extends JsonResource
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
            'kosnica' => new KosnicaResource($this->whenLoaded('kosnica')),
            'matica_starost' => $this->matica_starost,
            'jacina' => $this->jacina,
            'datum_formiranja' => $this->datum_formiranja,
            'aktivnosts' => AktivnostResource::collection($this->whenLoaded('aktivnosts'))
        ];
    }
}
