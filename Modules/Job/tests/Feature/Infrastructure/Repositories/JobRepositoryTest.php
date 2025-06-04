<?php

namespace Modules\Job\Tests\Feature\Infrastructure\Repositories;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Event;
use Modules\Job\Domain\Aggregates\Job;
use Modules\Job\Domain\Events\Job\JobCreated;
use Modules\Job\Domain\ValueObjects\Enum\EmploymentStatus;
use Modules\Job\Domain\ValueObjects\JobTitle;
use Modules\Job\Infrastructure\Repositories\JobRepository;
use Modules\Job\Infrastructure\Models\Job as JobModel;

class JobRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        Event::fake();
    }

    public function test_job_can_be_created()
    {
        $jobAggregate = Job::create(
            companyId: 1,
            title: new JobTitle('new job'),
            employmentStatus: EmploymentStatus::FULL_TIME
        );
        $repository = new JobRepository();

        $repository->save($jobAggregate);

        $this->assertDatabaseHas(JobModel::class, ['company_id' => $jobAggregate->companyId]);

        Event::assertDispatched(JobCreated::class);
    }

    public function test_job_can_be_updated()
    {
        $job = JobModel::create([
            'company_id' => 1,
            'title' => 'old job',
            'employment_status' => EmploymentStatus::FULL_TIME,
            'is_published' => false,
            'published_at' => CarbonImmutable::now(),
        ]);
        $newName = 'newname';
        $jobAggregate = Job::reconstruct(
            id: $job->id, 
            companyId: $job->company_id,
            title: new JobTitle($newName),
            employmentStatus: EmploymentStatus::PART_TIME,
            isPublished: true,
            createdAt: CarbonImmutable::now(),
            publishedAt: CarbonImmutable::now()
        );
        $repository = new JobRepository();

        $repository->save($jobAggregate);

        $this->assertDatabaseHas(JobModel::class, ['title' => $newName]);

        Event::assertDispatched(JobCreated::class);
    }

    public function test_job_can_be_found_by_id()
    {
        $job = JobModel::create([
            'company_id' => 1,
            'title' => 'old job',
            'employment_status' => EmploymentStatus::FULL_TIME,
            'is_published' => false,
            'published_at' => CarbonImmutable::now(),
        ]);
        $repository = new JobRepository();

        $jobAggregate = $repository->findById($job->id);

        $this->assertNotNull($jobAggregate);
    }

    public function test_it_return_null_if_job_is_not_found()
    {
        $repository = new JobRepository();

        $jobAggregate = $repository->findById(1);

        $this->assertNull($jobAggregate);
    }

    public function test_it_return_empty_collection_if_job_is_not_found_by_company_id()
    {
        $repository = new JobRepository();

        $jobCollection = $repository->findByCompanyId(1);

        $this->assertCount(0, $jobCollection);
    }

    public function test_it_return_job_collection_by_company_id()
    {
        $companyId = 1;
        JobModel::create([
            'company_id' => $companyId,
            'title' => 'job1',
            'employment_status' => EmploymentStatus::FULL_TIME,
            'is_published' => false,
            'published_at' => CarbonImmutable::now(),
        ]);
        JobModel::create([
            'company_id' => $companyId,
            'title' => 'job2',
            'employment_status' => EmploymentStatus::FULL_TIME,
            'is_published' => false,
            'published_at' => CarbonImmutable::now(),
        ]);
        $repository = new JobRepository();

        $jobCollection = $repository->findByCompanyId($companyId);

        $this->assertCount(2, $jobCollection);
    }
}
