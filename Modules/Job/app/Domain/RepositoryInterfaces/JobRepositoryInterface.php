<?php

namespace Modules\Job\Domain\RepositoryInterfaces;

use Modules\Job\Domain\Aggregates\Job;

interface JobRepositoryInterface
{
    public function save(Job $job): void;

    public function findById(int $id): ?Job;
}
