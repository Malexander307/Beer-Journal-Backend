<?php

namespace App\HTTPResource;

abstract class HTTPResource
{
    public function __construct(
        protected object $entity,
    )
    {
        if ($this->entity::class !== $this->expectedClass()) {
            throw new \LogicException('Resource ' . static::class . ' expects ' . $this->expectedClass());
        }
    }

    abstract public function toArray(): array;

    abstract public function expectedClass(): string;
}