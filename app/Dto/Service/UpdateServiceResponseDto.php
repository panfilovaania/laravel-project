<?php

namespace App\Dto\Service;

class UpdateServiceResponseDto
{
    public function __construct(
        public string $name,
        public string $label,
        public string $description,
        public int $price,
        public int $duration_minutes,
        public bool $available
    ) {

    }

    public function toArray()
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