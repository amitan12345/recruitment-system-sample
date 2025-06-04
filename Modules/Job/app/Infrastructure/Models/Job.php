<?php

namespace Modules\Job\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Job\Database\Factories\JobFactory;

class Job extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): JobFactory
    // {
    //     // return JobFactory::new();
    // }
}
