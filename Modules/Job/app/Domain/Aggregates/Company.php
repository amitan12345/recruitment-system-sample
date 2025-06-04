<?php

namespace Modules\Job\Domain\Aggregates;

use Modules\Shared\Domain\Aggregates\Aggregate;

class Company implements Aggregate
{
    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \InvalidArgumentException("Property {$name} does not exist on " . self::class);
    }

    private function __construct(
        private ?int $id,
        private string $name
    ) {
    }

    public static function create(
        string $name
    ): self {
        return new self(
            id: null,
            name: $name
        );
    }

    public static function reconstruct(
        int $id,
        string $name
    ): self {
        return new self(
            id: $id,
            name: $name
        );
    }
}
