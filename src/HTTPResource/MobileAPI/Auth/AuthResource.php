<?php

namespace App\HTTPResource\MobileAPI\Auth;

use App\DTO\Auth\AuthDTO;
use App\HTTPResource\HTTPResource;
use App\HTTPResource\MobileAPI\User\UserResource;

class AuthResource extends HTTPResource
{

    public function toArray(): array
    {
        return [
            'token' => $this->entity->token,
            'user' => (new UserResource($this->entity->user))->toArray(),
        ];
    }

    public function expectedClass(): string
    {
        return AuthDTO::class;
    }
}