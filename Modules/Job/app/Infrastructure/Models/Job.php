<?php

namespace Modules\Job\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Job\Domain\ValueObjects\Enum\EmploymentStatus;

// use Modules\Job\Database\Factories\JobFactory;

class Job extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'company_id',
        'title',
        'employment_status',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'employment_status' => EmploymentStatus::class,
        'is_published' => 'boolean',
        'published_at' => 'immutable_datetime',
        'created_at' => 'immutable_datetime',
    ];

    // protected static function newFactory(): JobFactory
    // {
    //     // return JobFactory::new();
    // }
}
