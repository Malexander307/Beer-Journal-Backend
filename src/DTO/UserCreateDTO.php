<?php

namespace App\DTO;

class UserCreateDTO
{
    public function __construct(
        public string $name,
        public string $password,
    )
    {
    }
}