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

    abstract public function expectedClass(): string;

    abstract public function toArray(): array;

    public static function collection(array $data): array
    {
        $result = [];

        foreach ($data as $item) {
            $result[] = (new static($item))->toArray();
        }

        return $result;
    }
}