<?php

namespace Modules\Job\Presentation\Api\CountCompaniesJobs;

use Illuminate\Foundation\Http\FormRequest;

class CountCompaniesJobsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company_id' => 'required|integer',
        ];
    }
}
