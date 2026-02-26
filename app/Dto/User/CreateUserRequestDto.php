<?php

namespace App\Dto\User;

class CreateUserRequestDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $phone,
        public string $birthday,
    ) {
        
    }

    public function toArray()
    {
        return [
            'name'=> $this->name,
            'email'=> $this->email,
            'password'=> $this->password,
            'phone'=> $this->phone,
            'birthday'=> $this->birthday,
        ];
    }
}