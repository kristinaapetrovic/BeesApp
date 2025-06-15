<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SugestijaResource extends JsonResource
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
            'poruka' => $this->poruka,
            'datum_kreiranja' => $this->datum_kreiranja,
            'user' => new UserResource($this->whenLoaded('user')),
            'aktivnost' => new AktivnostResource($this->whenLoaded('aktivnost')),
        ];
    }
}
