<?php

namespace Modules\Job\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use Modules\Job\Domain\Aggregates\Job;
use Modules\Job\Domain\Events\Job\JobCreated;
use Modules\Job\Domain\RepositoryInterfaces\JobRepositoryInterface;
use Modules\Job\Domain\ValueObjects\JobTitle;
use Modules\Job\Infrastructure\Models\Job as JobModel;

class JobRepository implements JobRepositoryInterface
{
    public function save(Job $job): void
    {
        $properties = [
            'company_id' => $job->companyId,
            'title' => $job->title->value(),
            'employment_status' => $job->employmentStatus,
            'is_published' => $job->isPublished,
            'published_at' => $job->publishedAt,
        ];

        if (!is_null($job->id)) {
            $job = JobModel::find($job->id);
            $job->update($properties);

            event(new JobCreated(jobId: $job->id));
            return;
        }
        
        $job = JobModel::create($properties)->fresh();
        event(new JobCreated(jobId: $job->id));
    }

    public function findById(int $id): ?Job
    {
        $job = JobModel::find($id);

        if (is_null($job)) {
            return null;
        }

        return $this->createJobAggregate($job);
    }

    public function findByCompanyId(int $companyId): Collection
    {
        $jobs = JobModel::where('company_id', $companyId)
            ->get();

        return $jobs->map(fn(JobModel $job) => $this->createJobAggregate($job));
    }

    private function createJobAggregate(JobModel $job): Job
    {
        return Job::reconstruct(
            id: $job->id,
            companyId: $job->company_id,
            title: new JobTitle($job->title),
            employmentStatus: $job->employment_status,
            isPublished: $job->is_published,
            createdAt: $job->created_at,
            publishedAt: $job->published_at
        );
    }
}
