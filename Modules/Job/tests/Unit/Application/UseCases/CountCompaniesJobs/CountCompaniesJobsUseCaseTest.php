<?php

namespace Modules\Job\Tests\Unit\Application\UseCases\CountCompaniesJobs;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\TestCase;
use Modules\Job\Application\UseCases\CountCompaniesJobs\Contracts\CountCompaniesJobsUseCaseInput;
use Modules\Job\Application\UseCases\CountCompaniesJobs\CountCompaniesJobsUseCase;
use Modules\Job\Domain\Aggregates\Job;
use Modules\Job\Domain\RepositoryInterfaces\JobRepositoryInterface;
use Modules\Job\Domain\ValueObjects\Enum\EmploymentStatus;
use Modules\Job\Domain\ValueObjects\JobTitle;

class CountCompaniesJobsUseCaseTest extends TestCase
{
    public function createJobAggregate(int $companyId, int $jobId): Job
    {
        return Job::reconstruct(
            id: $jobId,
            companyId: $companyId,
            title: new JobTitle('Test Job'),
            employmentStatus: EmploymentStatus::FULL_TIME,
            isPublished: true,
            createdAt: CarbonImmutable::now(),
            publishedAt: CarbonImmutable::now()
        );
    }

    public function test_it_count_companies_jobs(): void
    {
        $companyId = 1;
        $job1 = $this->createJobAggregate($companyId, 1);
        $job2 = $this->createJobAggregate($companyId, 2);
        $job3 = $this->createJobAggregate($companyId, 3);

        $this->mock(JobRepositoryInterface::class)
            ->shouldReceive('findByCompanyId')
            ->with($companyId)
            ->andReturn(collect([$job1, $job2, $job3]));
       
        $testedObject = app(CountCompaniesJobsUseCase::class);

        $output = $testedObject->execute(
            input: new CountCompaniesJobsUseCaseInput(
                companyId: $companyId
            )
        );

        $this->assertSame(3, $output->jobsCount);
    }
}
