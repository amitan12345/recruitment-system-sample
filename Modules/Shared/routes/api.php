<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', fn() => 'this is shared module api');