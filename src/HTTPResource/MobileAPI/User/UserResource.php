<?php

namespace App\HTTPResource\MobileAPI\User;

use App\Entity\User;
use App\HTTPResource\HTTPResource;

class UserResource extends HTTPResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->entity->getId(),
            'name' => $this->entity->getName(),
        ];
    }

    public function expectedClass(): string
    {
        return User::class;
    }
}