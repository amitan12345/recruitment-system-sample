<?php

namespace Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts;

use Modules\Shared\Application\UseCases\UseCaseInput;

readonly class CountCompaniesJobsUseCaseInput implements UseCaseInput
{
    public function __construct(
        public int $companyId
    ) {
    }
}
