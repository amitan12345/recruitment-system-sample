<?php

namespace Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts;

interface CountCompaniesJobsUseCaseInterface
{
    public function execute(CountCompaniesJobsUseCaseInput $input): CountCompaniesJobsUseCaseOutput;
}
