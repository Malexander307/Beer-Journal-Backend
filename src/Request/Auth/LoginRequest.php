<?php

namespace App\Request\Auth;

use App\Request\BaseRequest;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginRequest extends BaseRequest
{
    #[NotBlank]
    protected string $name;

    #[NotBlank]
    protected string $password;
}