<?php

namespace App\DTO;

class LoginDTO
{
    public function __construct(
        public string $name,
        public string $password,
    )
    {
    }
}