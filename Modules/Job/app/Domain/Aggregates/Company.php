<?php

namespace Modules\Job\Domain\Aggregates;

use Modules\Shared\Domain\Aggregates\Aggregate;

class Company implements Aggregate
{
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
