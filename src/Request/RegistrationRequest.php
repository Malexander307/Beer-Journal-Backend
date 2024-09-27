<?php

namespace App\Request;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

#[UniqueEntity('email', entityClass: User::class)]
class RegistrationRequest extends BaseRequest
{
    #[NotBlank]
    protected string $name;

    #[NotBlank, Email]
    protected string $email;

    #[NotBlank]
    protected string $password;
}