<?php

namespace App\Http\Controllers;

// Models
use App\Models\Designation;
use App\Models\Employee;
use App\Models\JobPost;
use App\Models\Skill;

class AdminController extends Controller
{
   
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalEmployees' => Employee::count(),
            'totalJobs' => JobPost::count(),
            'activeJobs' => JobPost::where('is_active', true)->count(),
            'totalDesignations' => Designation::count(),
            'totalSkills' => Skill::count(),
        ]);
    }
}
