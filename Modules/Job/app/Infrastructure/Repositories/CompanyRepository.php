<?php

namespace Modules\Job\Infrastructure\Repositories;

use Modules\Job\Domain\Aggregates\Company;
use Modules\Job\Domain\RepositoryInterfaces\CompanyRepositoryInterface;
use Modules\Job\Infrastructure\Models\Company as CompanyModel;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function save(Company $company): void
    {
        $properties = [
            'name' => $company->name,
        ];

        if (!is_null($company->id)) {
            CompanyModel::where('id', $company->id)
                ->update($properties);
            return;
        }
        
        CompanyModel::create($properties);
    }

    public function findById(int $id): ?Company
    {
        $company = CompanyModel::find($id);

        if (is_null($company)) {
            return null;
        }

        return Company::reconstruct(
            id: $company->id,
            name: $company->name
        );
    }
}
