<?php

namespace App\Dto\Service;

class CreateServiceRequestDto
{
    public function __construct(
        public int $location_id,
        public string $name,
        public string $label,
        public string $description,
        public int $price,
        public int $resources_count,
        public int $duration_minutes,
        public bool $available
    ) {
        
    }

    public function toArray()
    {
        return [
            'location_id'=> $this->location_id,
            'name'=> $this->name,
            'label'=> $this->label,
            'description'=> $this->description,
            'price'=> $this->price,
            'resources_count'=> $this->resources_count,
            'duration_minutes'=> $this->duration_minutes,
            'available'=> $this->available,
        ];
    }
}