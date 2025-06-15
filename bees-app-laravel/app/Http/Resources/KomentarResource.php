<?php

namespace App\Http\Resources;

use App\Models\Aktivnost;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KomentarResource extends JsonResource
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
            'sadrzaj' => $this->sadrzaj,
            'datum' => $this->datum,
            'aktivnost' => new AktivnostResource($this->whenLoaded('aktivnost')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
