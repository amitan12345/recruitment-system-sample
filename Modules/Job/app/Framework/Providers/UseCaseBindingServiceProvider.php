<?php

namespace Modules\Job\Framework\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts\CountCompaniesJobsUseCaseInterface;
use Modules\Job\Application\UseCases\CountCompaniesJobs\CountCompaniesJobsUseCase;

class UseCaseBindingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            abstract: CountCompaniesJobsUseCaseInterface::class,
            concrete: CountCompaniesJobsUseCase::class
        );
    }
}
