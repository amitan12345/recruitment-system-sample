<?php

namespace Modules\Job\Domain\Aggregates;

use Carbon\CarbonImmutable;
use Modules\Job\Domain\ValueObjects\Enum\EmploymentStatus;
use Modules\Job\Domain\ValueObjects\JobTitle;
use Modules\Shared\Domain\Aggregates\Aggregate;

class Job implements Aggregate
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
        private int $companyId,
        private JobTitle $title,
        private EmploymentStatus $employmentStatus,
        private bool $isPublished,
        private CarbonImmutable $createdAt,
        private ?CarbonImmutable $publishedAt
    ) {
    }

    public static function create(
        int $companyId,
        JobTitle $title,
        EmploymentStatus $employmentStatus
    ): self {
        return new self(
            id: null,
            companyId: $companyId,
            title: $title,
            employmentStatus: $employmentStatus,
            isPublished: false,
            createdAt: CarbonImmutable::now(),
            publishedAt: null
        );
    }

    public static function reconstruct(
        int $id,
        int $companyId,
        JobTitle $title,
        EmploymentStatus $employmentStatus,
        bool $isPublished,
        CarbonImmutable $createdAt,
        ?CarbonImmutable $publishedAt
    ): self {
        return new self(
            id: $id,
            companyId: $companyId,
            title: $title,
            employmentStatus: $employmentStatus,
            isPublished: $isPublished,
            createdAt: $createdAt,
            publishedAt: $publishedAt
        );
    }

    public function publish(): void
    {
        $this->isPublished = true;
        $this->publishedAt = CarbonImmutable::now();
    }

    public function unpublish(): void
    {
        $this->isPublished = false;
        $this->publishedAt = null;
    }
}
