<?php

use Illuminate\Support\Facades\Route;
use Modules\Job\Presentation\Api\CountCompaniesJobs\CountCompaniesJobsController;

Route::get('/count', [CountCompaniesJobsController::class, 'count'])->name('count');