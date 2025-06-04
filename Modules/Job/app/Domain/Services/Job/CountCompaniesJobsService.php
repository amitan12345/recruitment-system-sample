<?php

namespace Modules\Job\Domain\Services\Job;

use Modules\Job\Domain\RepositoryInterfaces\JobRepositoryInterface;

class CountCompaniesJobsService
{
    public function __construct(
        private readonly JobRepositoryInterface $jobRepository
    ) {
    }

    public function execute(int $companyId): int
    {
        return $this->jobRepository->findByCompanyId($companyId)->count();
    }
}
