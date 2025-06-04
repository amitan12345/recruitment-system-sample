<?php

namespace Modules\Job\Domain\RepositoryInterfaces;

use Modules\Job\Domain\Aggregates\Company;

interface CompanyRepositoryInterface
{
    public function save(Company $company): void;

    public function findById(int $id): ?Company;
}
