<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DisasterResource extends JsonResource
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
            'location' => $this->location,
            'description' => $this->description,
            'severity' => $this->severity,
            'time' => $this->time,
            'date' => $this->date,
            'created_by' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
