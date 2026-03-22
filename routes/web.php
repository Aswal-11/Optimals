<?php

// Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\SkillController;

// Middleware
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::middleware('checkauth')->group(function () {
    // Admin Routes
    Route::get('/admindashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');

    // Employee Management Routes (admin only)
    Route::get('/employee/index', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employees/{employee}/profile', [EmployeeController::class, 'profile'])->name('employees.profile');
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::patch('/employee/{employee}/update', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/{employee}/delete', [EmployeeController::class, 'delete'])->name('employee.delete');

    // Designation Routes
    Route::get('/designation/index', [DesignationController::class, 'index'])->name('designation.index');
    Route::get('/designation/create', [DesignationController::class, 'create'])->name('designation.create');
    Route::post('/designation/store', [DesignationController::class, 'store'])->name('designation.store');
    Route::get('/designation/{id}/edit', [DesignationController::class, 'edit'])->name('designation.edit');
    Route::get('/designation/{designation}/show', [DesignationController::class, 'show'])->name('designation.show');
    Route::patch('/designation/{id}/update', [DesignationController::class, 'update'])->name('designation.update');
    Route::delete('/designation/{designation}/delete', [DesignationController::class, 'delete'])->name('designation.delete');

    // Skill Routes
    Route::get('/skill/create', [SkillController::class, 'create'])->name('skill.create');
    Route::post('/skill/store', [SkillController::class, 'store'])->name('skill.store');

    // Job-Post Routes
    Route::get('/jobPost/index', [JobPostController::class, 'index'])->name('jobPost.index');
    Route::get('/jobPost/create', [JobPostController::class, 'create'])->name('jobPost.create');
    Route::post('/jobPost/store', [JobPostController::class, 'store'])->name('jobPost.store');
    Route::get('/jobPost/{jobPost}/edit', [JobPostController::class, 'edit'])->name('jobPost.edit');
    Route::patch('/jobPost/{jobPost}/update', [JobPostController::class, 'update'])->name('jobPost.update');
    Route::delete('/jobPost/{jobPost}/delete', [JobPostController::class, 'delete'])->name('jobPost.delete');
    Route::patch('/job-post/{job}/toggle-status', [JobPostController::class, 'toggleStatus'])->name('jobPost.toggleStatus');

    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
});
