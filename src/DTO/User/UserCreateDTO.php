<?php

namespace App\DTO\User;

class UserCreateDTO
{
    public function __construct(
        public string $name,
        public string $password,
    )
    {
    }
}