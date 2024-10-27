<?php

namespace App\HTTPResource\Beer;

use App\Entity\Beer;
use App\HTTPResource\HTTPResource;

class BeerResource extends HTTPResource
{
    public function expectedClass(): string
    {
        return Beer::class;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->entity->getId(),
            'name' => $this->entity->getName(),
            'image_url' => $this->entity->getImageUrl(),
            'description' => $this->entity->getDescription(),
        ];
    }

}