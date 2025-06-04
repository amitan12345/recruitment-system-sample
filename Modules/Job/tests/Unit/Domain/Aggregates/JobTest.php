<?php

namespace Modules\Job\Tests\Unit\Domain\Aggregates;

use Carbon\CarbonImmutable;
use Modules\Job\Domain\Aggregates\Job;
use Modules\Job\Domain\ValueObjects\Enum\EmploymentStatus;
use Modules\Job\Domain\ValueObjects\JobTitle;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    private function createJob(bool $isPublished): Job
    {
        return Job::reconstruct(
            id: 1,
            companyId: 1,
            title: new JobTitle('Software Engineer'),
            employmentStatus: EmploymentStatus::FULL_TIME,
            isPublished: $isPublished,
            createdAt: CarbonImmutable::now(),
            publishedAt: null
        );
    }

    public function test_job_can_be_published(): void
    {
        $job = $this->createJob(false);
        $job->publish();
        
        $this->assertTrue($job->isPublished, 'Expected job to be published');
        $this->assertInstanceOf(CarbonImmutable::class, $job->publishedAt, 'Expected publishedAt to be set after publishing');
    }

    public function test_job_can_be_unpublished(): void
    {
        $job = $this->createJob(true);
        $job->unpublish();
        
        $this->assertFalse($job->isPublished, 'Expected job to be unpublished');
        $this->assertNull($job->publishedAt, 'Expected publishedAt to be null after unpublishing');
    }
}
