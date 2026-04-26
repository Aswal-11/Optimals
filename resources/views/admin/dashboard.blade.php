@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
        <x-icons.home class="w-4 h-4 text-gray-400" />
        <x-icons.chevron-right class="w-3 h-3 text-gray-300" />
        <span class="text-gray-900">Dashboard</span>
    </div>
@endsection


@section('content')
<div class="min-h-screen bg-gray-50/50 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto space-y-8">
        
        {{-- Header --}}
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Overview</h1>
            <p class="mt-1 text-sm text-gray-500">Here's a snapshot of what's happening across your organization.</p>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            {{-- Stat 1 --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:shadow-md hover:border-indigo-100 transition-all duration-200 group">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-bold tracking-wide text-gray-500 uppercase">Total Employees</p>
                        <h3 class="mt-2 text-3xl font-black text-gray-900 tracking-tight">{{ $totalEmployees }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <x-icons.users class="w-5 h-5" />
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs font-medium text-emerald-600 bg-emerald-50 w-max px-2 py-1 rounded-md">
                    <x-icons.arrow-up class="w-3 h-3 mr-1" />
                    Active Workforce
                </div>
            </div>

            {{-- Stat 2 --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:shadow-md hover:border-blue-100 transition-all duration-200 group">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-bold tracking-wide text-gray-500 uppercase">Total Jobs</p>
                        <h3 class="mt-2 text-3xl font-black text-gray-900 tracking-tight">{{ $totalJobs }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <x-icons.briefcase class="w-5 h-5" />
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs font-medium text-gray-500 bg-gray-100 w-max px-2 py-1 rounded-md">
                    All created listings
                </div>
            </div>

            {{-- Stat 3 --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:shadow-md hover:border-emerald-100 transition-all duration-200 group">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-bold tracking-wide text-gray-500 uppercase">Active Jobs</p>
                        <h3 class="mt-2 text-3xl font-black text-gray-900 tracking-tight">{{ $activeJobs }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <x-icons.check-circle class="w-5 h-5" />
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs font-medium text-emerald-600 bg-emerald-50 w-max px-2 py-1 rounded-md">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>
                    Currently live
                </div>
            </div>

            {{-- Stat 4 --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:shadow-md hover:border-purple-100 transition-all duration-200 group">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-bold tracking-wide text-gray-500 uppercase">Designations</p>
                        <h3 class="mt-2 text-3xl font-black text-gray-900 tracking-tight">{{ $totalDesignations }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <x-icons.building class="w-5 h-5" />
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs font-medium text-gray-500 bg-gray-100 w-max px-2 py-1 rounded-md">
                    Role types defined
                </div>
            </div>
        </div>

        {{-- Bottom Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Quick Actions --}}
            <div class="lg:col-span-2">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <a href="{{ route('employee.index') }}" class="group flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-200 hover:border-indigo-300 hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <x-icons.users class="w-6 h-6" />
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-gray-900">Manage Employees</h4>
                            <p class="text-xs text-gray-500 mt-0.5">View, edit, or remove records</p>
                        </div>
                        <div class="text-gray-300 group-hover:text-indigo-600 transition-colors">
                            <x-icons.chevron-right class="w-5 h-5" />
                        </div>
                    </a>

                    <a href="{{ route('jobPost.index') }}" class="group flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <x-icons.briefcase class="w-6 h-6" />
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-gray-900">Job Posts</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Manage active listings</p>
                        </div>
                        <div class="text-gray-300 group-hover:text-blue-600 transition-colors">
                            <x-icons.chevron-right class="w-5 h-5" />
                        </div>
                    </a>

                    <a href="{{ route('designation.index') }}" class="group flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-200 hover:border-amber-300 hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                            <x-icons.tag class="w-6 h-6" />
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-gray-900">Designations</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Update job roles and types</p>
                        </div>
                        <div class="text-gray-300 group-hover:text-amber-500 transition-colors">
                            <x-icons.chevron-right class="w-5 h-5" />
                        </div>
                    </a>

                    <a href="{{ route('skill.create') }}" class="group flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-200 hover:border-purple-300 hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                            <x-icons.bulb class="w-6 h-6" />
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-gray-900">Add Skill</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Define new employee skills</p>
                        </div>
                        <div class="text-gray-300 group-hover:text-purple-600 transition-colors">
                            <x-icons.chevron-right class="w-5 h-5" />
                        </div>
                    </a>

                </div>
            </div>

            {{-- System Health / Overview --}}
            <div class="lg:col-span-1">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Summary</h3>
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h4 class="text-sm font-bold text-gray-900">System Current State</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Live metrics</p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Live
                        </span>
                    </div>
                    
                    <div class="p-5 space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                                <span class="text-sm font-medium text-gray-600">Total Employees</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 tabular-nums">{{ $totalEmployees }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                <span class="text-sm font-medium text-gray-600">All Jobs</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 tabular-nums">{{ $totalJobs }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                <span class="text-sm font-medium text-gray-600">Active Jobs</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 tabular-nums">{{ $activeJobs }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                <span class="text-sm font-medium text-gray-600">Designations</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 tabular-nums">{{ $totalDesignations }}</span>
                        </div>
                    </div>

                    <div class="p-5 bg-gray-50/50 border-t border-gray-100">
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Fill Rate</span>
                            <span class="text-sm font-bold text-gray-900">{{ $totalJobs > 0 ? round(($activeJobs / $totalJobs) * 100) : 0 }}%</span>
                        </div>
                        <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-indigo-500 rounded-full transition-all duration-1000" style="width:{{ $totalJobs > 0 ? ($activeJobs / $totalJobs) * 100 : 0 }}%"></div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200/60">
                            <a href="{{ route('jobPost.index') }}" class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                View job posts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection