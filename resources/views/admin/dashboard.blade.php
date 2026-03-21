@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs font-medium text-emerald-600 bg-emerald-50 w-max px-2 py-1 rounded-md">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/></svg>
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
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
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
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
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
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
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
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-gray-900">Manage Employees</h4>
                            <p class="text-xs text-gray-500 mt-0.5">View, edit, or remove records</p>
                        </div>
                        <div class="text-gray-300 group-hover:text-indigo-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </a>

                    <a href="{{ route('jobPost.index') }}" class="group flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-gray-900">Job Posts</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Manage active listings</p>
                        </div>
                        <div class="text-gray-300 group-hover:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </a>

                    <a href="{{ route('designation.index') }}" class="group flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-200 hover:border-amber-300 hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a3 3 0 01-3-3V6a3 3 0 013-3z"/></svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-gray-900">Designations</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Update job roles and types</p>
                        </div>
                        <div class="text-gray-300 group-hover:text-amber-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </a>

                    <a href="{{ route('skill.create') }}" class="group flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-200 hover:border-purple-300 hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-gray-900">Add Skill</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Define new employee skills</p>
                        </div>
                        <div class="text-gray-300 group-hover:text-purple-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
                        <div class="flex items-center justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                                <span class="text-sm font-medium text-gray-600">Total Employees</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 tabular-nums">{{ $totalEmployees }}</span>
                        </div>
                        <div class="flex items-center justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                <span class="text-sm font-medium text-gray-600">All Jobs</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 tabular-nums">{{ $totalJobs }}</span>
                        </div>
                        <div class="flex items-center justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                <span class="text-sm font-medium text-gray-600">Active Jobs</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 tabular-nums">{{ $activeJobs }}</span>
                        </div>
                        <div class="flex items-center justify-between items-center">
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