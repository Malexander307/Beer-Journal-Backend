<?php

declare(strict_types=1);

namespace App\Request\Beer;

use App\Request\BaseRequest;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UpdateBeerRequest extends BaseRequest
{
    #[NotBlank, length(min: 1, max: 255)]
    protected string $name;
    #[NotBlank, length(min: 1, max: 1000)]
    protected string $description;
    #[NotBlank, length(min: 10, max: 255)]
    protected string $image_url;
}