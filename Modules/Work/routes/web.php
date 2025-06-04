<?php

use Illuminate\Support\Facades\Route;
use Modules\Work\Http\Controllers\WorkController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('works', WorkController::class)->names('work');
});
