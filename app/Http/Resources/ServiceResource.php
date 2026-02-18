<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=> $this->name,
            'label'=> $this->label,
            'description'=> $this->description,
            'price'=> $this->price,
            'duration_minutes'=> $this->duration_minutes,
            'available'=> $this->available,
        ];
    }
}
