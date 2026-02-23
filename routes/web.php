<?php

// Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DesignationController;

// Routes & Auth
use Illuminate\Support\Facades\Route;

// Middleware
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\BlockEmployeeFromCreateMiddleware;

// Redirect root to login so login page appears first
Route::get('/', function () {
    return view('welcome');
});

// Named route for auth middleware redirect (unauthenticated users go here)
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Login and registration routes (no auth required so login page and "Register here" work)
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');

// Employee Login route
Route::get('/employee/login', [EmployeeController::class, 'login'])->name('employee.login');
Route::post('/employee/authenticate', [EmployeeController::class, 'authenticate'])->name('employee.authenticate');

// Employee routes (require employee login)
Route::middleware('auth:employee')->group(function () {
    Route::get('/employee/profile', [EmployeeController::class, 'myProfile'])->name('employee.profile');
    Route::post('/employee/logout', [EmployeeController::class, 'logout'])->name('employee.logout');
});

// Block employee from create/store only (runs before admin check so redirect, not 403)
Route::middleware(BlockEmployeeFromCreateMiddleware::class)->group(function () {
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
});

// All other routes require admin login
Route::middleware(AdminMiddleware::class)->group(function () {
    // Admin Routes
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');

    // Employee Management Routes (admin only)
    Route::get('/employee/index', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employees/{employee}/profile', [EmployeeController::class, 'profile'])->name('employees.profile');
    Route::get('/employee/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::patch('/employee/{employee}/update', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/{employee}/delete', [EmployeeController::class, 'delete'])->name('employee.delete');

    // Designation Routes
    Route::get('/designation/{designation}/show', [DesignationController::class, 'show'])->name('designation.show');
    Route::get('/designation/index', [DesignationController::class, 'index'])->name('designation.index');
    Route::get('/designation/create', [DesignationController::class, 'create'])->name('designation.create');
    Route::post('/designation/store', [DesignationController::class, 'store'])->name('designation.store');
    Route::get('/designation/{id}/edit', [DesignationController::class, 'edit'])->name('designation.edit');
    Route::patch('/designation/{id}/update', [DesignationController::class, 'update'])->name('designation.update');

    // Skill Routes
    Route::get('/skill/create', [SkillController::class, 'create'])->name('skill.create');
    Route::post('/skill/store', [SkillController::class, 'store'])->name('skill.store');
});
