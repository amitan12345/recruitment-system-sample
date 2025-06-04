<?php

namespace Modules\Job\Domain\RepositoryInterfaces;

use Illuminate\Support\Collection;
use Modules\Job\Domain\Aggregates\Job;

interface JobRepositoryInterface
{
    public function save(Job $job): void;

    public function findById(int $id): ?Job;

    public function findByCompanyId(int $companyId): Collection;
}
