<?php

namespace Modules\Job\Tests\Feature\Infrastructure\Repositories;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase;
use Modules\Job\Domain\Aggregates\Company;
use Modules\Job\Infrastructure\Repositories\CompanyRepository;
use Modules\Job\Infrastructure\Models\Company as CompanyModel;

class CompanyRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function test_company_can_be_created()
    {
        $companyAggregate = Company::create('New Company');
        $repository = new CompanyRepository();

        $repository->save($companyAggregate);

        $this->assertDatabaseHas(CompanyModel::class, ['name' => $companyAggregate->name]);
    }

    public function test_company_can_be_updated()
    {
        $company = CompanyModel::create(['name' => 'oldname']);
        $newName = 'newname';
        $companyAggregate = Company::reconstruct(id: $company->id, name: $newName);
        $repository = new CompanyRepository();

        $repository->save($companyAggregate);

        $this->assertDatabaseHas(CompanyModel::class, ['name' => $newName]);
    }

    public function test_company_can_be_found_by_id()
    {
        $company = CompanyModel::create(['name' => 'oldname']);
        $repository = new CompanyRepository();

        $companyAggregate = $repository->findById($company->id);

        $this->assertNotNull($companyAggregate);
    }

    public function test_it_return_null_if_company_is_not_found()
    {
        $repository = new CompanyRepository();

        $companyAggregate = $repository->findById(1);

        $this->assertNull($companyAggregate);
    }
}
