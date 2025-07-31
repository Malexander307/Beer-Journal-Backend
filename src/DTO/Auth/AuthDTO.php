<?php

namespace App\DTO\Auth;

use App\Entity\User;

class AuthDTO
{
    public function __construct(
        public string $token,
        public User $user,
    )
    {
    }
}