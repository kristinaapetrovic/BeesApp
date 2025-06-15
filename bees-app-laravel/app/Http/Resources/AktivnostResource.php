<?php

namespace App\Http\Resources;

use App\Models\Drustvo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AktivnostResource extends JsonResource
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
            'opis' => $this->opis,
            'tip' => $this->tip,
            'pocetak' => $this->pocetak,
            'kraj' => $this->kraj,
            'status' => $this->status,
            'drustvo' => new DrustvoResource($this->whenLoaded('drustvo')),
            'user' => new UserResource($this->whenLoaded('user')),
            'komentars' => KomentarResource::collection($this->whenLoaded('komentars')),
            'sugestijas' => SugestijaResource::collection($this->whenLoaded('sugestijas'))
        ];
    }
}
