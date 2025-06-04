<?php

namespace Modules\Job\Domain\ValueObjects;

use Modules\Shared\Domain\ValueObjects\ValueObject;

readonly class JobTitle implements ValueObject
{
    public function __construct(
        private string $title
    ) {
        if (!self::validate($title)) {
            throw new \InvalidArgumentException('Invalid job title');
        }
    }

    public static function validate(string $title): bool
    {
        if (empty($title)) {
            return false;
        }

        if (strlen($title) > 255) {
            return false;
        }

        return true;
    }

    public function value(): string
    {
        return $this->title;
    }
}
