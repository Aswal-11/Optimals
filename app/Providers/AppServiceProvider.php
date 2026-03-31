<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Employee;
use App\Models\JobPost;
use App\Models\Role;
use App\Models\SubUser;
use App\Models\Designation;
use App\Models\Skill;
use App\Policies\EmployeePolicy;
use App\Policies\JobPostPolicy;
use App\Policies\RolePolicy;
use App\Policies\SubUserPolicy;
use App\Policies\DesignationPolicy;
use App\Policies\SkillPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Employee::class, EmployeePolicy::class);
        Gate::policy(JobPost::class, JobPostPolicy::class);
        Gate::policy(Designation::class, DesignationPolicy::class);
        Gate::policy(Skill::class, SkillPolicy::class);
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(SubUser::class, SubUserPolicy::class);
    }

    // Uncomment for https forcing in production
    // public function boot(UrlGenerator $url)
    // {
    //     if (env('APP_ENV') == 'production') {
    //         $url->forceScheme('https');
    //     }
    // }
}
