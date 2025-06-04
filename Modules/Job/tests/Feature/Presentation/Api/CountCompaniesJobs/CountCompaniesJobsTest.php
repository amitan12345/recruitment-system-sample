<?php

namespace Modules\Job\Tests\Feature\Presentation\Api\CountCompaniesJobs;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase;
use Modules\Job\Domain\ValueObjects\Enum\EmploymentStatus;
use Modules\Job\Infrastructure\Models\Job;

class CountCompaniesJobsTest extends TestCase
{
    use DatabaseTransactions;

    public function createJob(int $companyId): void
    {
        Job::create([
            'company_id' => $companyId,
            'title' => 'old job',
            'employment_status' => EmploymentStatus::FULL_TIME,
            'is_published' => true,
            'published_at' => CarbonImmutable::now(),
        ]);
    }

    public function test_it_count_companies_jobs()
    {
        $this->createJob(1);
        $this->createJob(1);
        $this->createJob(2);

        $response = $this->json('get', '/api/job/count', [
            'company_id' => 1,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'jobs_count' => 2,
            ]);
    }

    public function test_it_returns_zero_if_job_not_exists()
    {
        $this->createJob(2);

        $response = $this->json('get', '/api/job/count', [
            'company_id' => 1,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'jobs_count' => 0,
            ]);
    }
}
