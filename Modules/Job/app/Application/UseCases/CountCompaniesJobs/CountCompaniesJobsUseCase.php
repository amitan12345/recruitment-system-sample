<?php

namespace Modules\Job\Application\UseCases\CountCompaniesJobs;

use Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts\CountCompaniesJobsUseCaseInput;
use Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts\CountCompaniesJobsUseCaseInterface;
use Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts\CountCompaniesJobsUseCaseOutput;
use Modules\Job\Domain\Services\Job\CountCompaniesJobsService;

class CountCompaniesJobsUseCase implements CountCompaniesJobsUseCaseInterface
{
    public function __construct(
        private readonly CountCompaniesJobsService $domainService
    ) {
    }
    public function execute(CountCompaniesJobsUseCaseInput $input): CountCompaniesJobsUseCaseOutput
    {
        $jobsCount = $this->domainService->execute($input->companyId);

        return new CountCompaniesJobsUseCaseOutput($jobsCount);
    }
}
