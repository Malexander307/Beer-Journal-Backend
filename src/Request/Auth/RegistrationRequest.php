<?php

namespace App\Request\Auth;

use App\Entity\User;
use App\Request\BaseRequest;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotBlank;

#[UniqueEntity('name', entityClass: User::class)]
class RegistrationRequest extends BaseRequest
{
    #[NotBlank]
    protected string $name;

    #[NotBlank]
    protected string $password;
}