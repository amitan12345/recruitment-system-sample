<?php

namespace Modules\Job\Tests\Unit\Domain\Services\Job;

use Modules\Job\Domain\Aggregates\Job;
use Modules\Job\Domain\RepositoryInterfaces\JobRepositoryInterface;
use Modules\Job\Domain\ValueObjects\Enum\EmploymentStatus;
use Modules\Job\Domain\ValueObjects\JobTitle;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\TestCase;
use Modules\Job\Domain\Services\Job\CountCompaniesJobsService;

class CountCompaniesJobsTest extends TestCase
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
       
        $testedObject = app(CountCompaniesJobsService::class);

        $output = $testedObject->execute(companyId: $companyId);

        $this->assertSame(3, $output);
    }
}
