<?php

namespace Modules\Job\Framework\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Job\Domain\RepositoryInterfaces\CompanyRepositoryInterface;
use Modules\Job\Domain\RepositoryInterfaces\JobRepositoryInterface;
use Modules\Job\Infrastructure\Repositories\CompanyRepository;
use Modules\Job\Infrastructure\Repositories\JobRepository;

class RepositoryBindingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            abstract: JobRepositoryInterface::class,
            concrete: JobRepository::class
        );

        $this->app->bind(
            abstract: CompanyRepositoryInterface::class,
            concrete: CompanyRepository::class
        );
    }
}
