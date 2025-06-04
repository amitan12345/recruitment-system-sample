<?php

namespace Modules\Job\Presentation\Api\CountCompaniesJobs;

use Illuminate\Http\JsonResponse;
use Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts\CountCompaniesJobsUseCaseInput;
use Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts\CountCompaniesJobsUseCaseInterface;

class CountCompaniesJobsController
{
    public function __construct(
        private readonly CountCompaniesJobsPresenter $presenter,
        private readonly CountCompaniesJobsUseCaseInterface $useCase
    ) {
    }

    public function count(CountCompaniesJobsRequest $request): JsonResponse
    {
        $input = new CountCompaniesJobsUseCaseInput(
            companyId: $request->input('company_id')
        );

        $output = $this->useCase->execute($input);

        return $this->presenter->response($output);
    }
}
