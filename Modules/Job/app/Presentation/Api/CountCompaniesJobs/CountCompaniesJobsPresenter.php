<?php

namespace Modules\Job\Presentation\Api\CountCompaniesJobs;

use Illuminate\Http\JsonResponse;
use Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts\CountCompaniesJobsUseCaseOutput;

class CountCompaniesJobsPresenter
{
    public function response(CountCompaniesJobsUseCaseOutput $output): JsonResponse
    {
        return response()->json([
            'jobs_count' => $output->jobsCount,
        ]);
    }
}
