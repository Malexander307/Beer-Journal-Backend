<?php

declare(strict_types=1);

namespace App\HTTPResource\AdminPage\Auth;

use App\DTO\Auth\AuthDTO;
use App\HTTPResource\HTTPResource;

class AdminAuthResource extends HTTPResource
{
    public function toArray(): array
    {
        return [
            'token' => $this->entity->token,
            'user' => [
                'id' => $this->entity->user->getId(),
                'name' => $this->entity->user->getName(),
                'email' => $this->entity->user->getEmail(),
            ],
        ];
    }

    public function expectedClass(): string
    {
        return AuthDTO::class;
    }
}