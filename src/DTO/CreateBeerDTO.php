<?php

declare(strict_types=1);

namespace App\DTO;

class CreateBeerDTO
{
     public function __construct(
         public string $name,
         public string $description,
         public string $imageUrl,
     )
     {

     }
}