<?php

namespace Modules\Job\Application\UseCases\CountCompaniesJobs;

use Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts\CountCompaniesJobsUseCaseInput;
use Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts\CountCompaniesJobsUseCaseInterface;
use Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts\CountCompaniesJobsUseCaseOutput;
use Modules\Job\Domain\RepositoryInterfaces\JobRepositoryInterface;

class CountCompaniesJobsUseCase implements CountCompaniesJobsUseCaseInterface
{
    public function __construct(
        private readonly JobRepositoryInterface $jobRepository
    ) {
    }
    public function execute(CountCompaniesJobsUseCaseInput $input): CountCompaniesJobsUseCaseOutput
    {
        $jobsCount = $this->jobRepository->findByCompanyId($input->companyId)->count();

        return new CountCompaniesJobsUseCaseOutput($jobsCount);
    }
}
