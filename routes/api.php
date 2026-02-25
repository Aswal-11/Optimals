<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\JobPostController;
use App\Http\Controllers\Api\EmployeeController;

Route::apiResource('employees', EmployeeController::class);

// Job Post routes
Route::get('job-posts/create', [JobPostController::class, 'create']);
Route::apiResource('job-posts', JobPostController::class);