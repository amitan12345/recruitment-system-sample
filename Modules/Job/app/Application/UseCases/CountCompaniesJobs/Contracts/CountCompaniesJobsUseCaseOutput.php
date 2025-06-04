<?php

namespace Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts;

readonly class CountCompaniesJobsUseCaseOutput
{
    public function __construct(
        public int $jobsCount
    ) {
    }
}
