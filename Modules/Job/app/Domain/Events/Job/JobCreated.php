<?php

namespace Modules\Job\Domain\Events\Job;

use Carbon\CarbonImmutable;
use Modules\Shared\Domain\Events\Event;

readonly class JobCreated implements Event
{
    public CarbonImmutable $createdAt;

    public function __construct(
        public int $jobId
    ) {
        $this->createdAt = CarbonImmutable::now();
    }
}
