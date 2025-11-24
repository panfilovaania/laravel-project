<?php

namespace App\Dto\Resource;

class CreateResourceRequestDto
{
    public function __construct(
        public string $name,
        public string $label,
        public bool $available
    ) {
        
    }

    public function toArray()
    {
        return [
            'name'=> $this->name,
            'label'=> $this->label,
            'available'=> $this->available,
        ];
    }
}