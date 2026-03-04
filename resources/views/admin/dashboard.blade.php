@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

        {{-- ── Flash Message ── --}}
        @if(session('success'))
            <div id="flash-message" class="mb-8 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl px-5 py-4 shadow-sm">
                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <p class="text-sm font-medium">{{ session('success') }}</p>
                <button onclick="document.getElementById('flash-message').remove()" class="ml-auto text-emerald-400 hover:text-emerald-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        {{-- ── Page Header ── --}}
        <div class="mb-10">
            <p class="text-xs font-bold tracking-widest uppercase text-indigo-600 mb-1">Admin Panel</p>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">Dashboard</h1>
            <p class="mt-1.5 text-sm text-gray-500">Here's what's happening across your organization.</p>
        </div>

        {{-- ── Stats Grid ── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-10">

            {{-- Total Employees --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition-shadow duration-200 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center group-hover:bg-indigo-600 transition-colors duration-200">
                        <svg class="w-5 h-5 text-indigo-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">Active</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tabular-nums">{{ $totalEmployees }}</p>
                <p class="text-xs font-medium text-gray-400 mt-1 uppercase tracking-wider">Employees</p>
            </div>

            {{-- Total Jobs --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition-shadow duration-200 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-500 transition-colors duration-200">
                        <svg class="w-5 h-5 text-amber-500 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-lg">Total</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tabular-nums">{{ $totalJobs }}</p>
                <p class="text-xs font-medium text-gray-400 mt-1 uppercase tracking-wider">Job Posts</p>
            </div>

            {{-- Active Jobs --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition-shadow duration-200 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-500 transition-colors duration-200">
                        <svg class="w-5 h-5 text-emerald-500 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">Live</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tabular-nums">{{ $activeJobs }}</p>
                <p class="text-xs font-medium text-gray-400 mt-1 uppercase tracking-wider">Active Jobs</p>
            </div>

            {{-- Designations --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition-shadow duration-200 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center group-hover:bg-gray-800 transition-colors duration-200">
                        <svg class="w-5 h-5 text-gray-700 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-2 py-1 rounded-lg">Types</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tabular-nums">{{ $totalDesignations }}</p>
                <p class="text-xs font-medium text-gray-400 mt-1 uppercase tracking-wider">Designations</p>
            </div>
        </div>

        {{-- ── Quick Actions ── --}}
        <div>
            <div class="flex items-center gap-3 mb-6">
                <h2 class="text-xl font-bold text-gray-900">Quick Actions</h2>
                <div class="flex-1 h-px bg-gray-200"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">

                {{-- Create Admin --}}
                <a href="{{ route('admin.create') }}"
                   class="group flex items-center gap-4 bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:border-indigo-300 hover:shadow-md transition-all duration-200">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center flex-shrink-0 group-hover:bg-indigo-600 transition-colors duration-200">
                        <svg class="w-6 h-6 text-indigo-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">Create Admin</p>
                        <p class="text-xs text-gray-400 mt-0.5">Add new administrator</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-indigo-400 transition-colors ml-auto flex-shrink-0 -translate-x-1 group-hover:translate-x-0 duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                {{-- Designations --}}
                <a href="{{ route('designation.index') }}"
                   class="group flex items-center gap-4 bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:border-amber-300 hover:shadow-md transition-all duration-200">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center flex-shrink-0 group-hover:bg-amber-500 transition-colors duration-200">
                        <svg class="w-6 h-6 text-amber-500 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a3 3 0 01-3-3V6a3 3 0 013-3z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-gray-900 group-hover:text-amber-600 transition-colors">Designations</p>
                        <p class="text-xs text-gray-400 mt-0.5">Manage designations</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-amber-400 transition-colors ml-auto flex-shrink-0 -translate-x-1 group-hover:translate-x-0 duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                {{-- Employees --}}
                <a href="{{ route('employee.index') }}"
                   class="group flex items-center gap-4 bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:border-emerald-300 hover:shadow-md transition-all duration-200">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-500 transition-colors duration-200">
                        <svg class="w-6 h-6 text-emerald-500 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">Employees</p>
                        <p class="text-xs text-gray-400 mt-0.5">View & manage records</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-emerald-400 transition-colors ml-auto flex-shrink-0 -translate-x-1 group-hover:translate-x-0 duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                {{-- Job Posts --}}
                <a href="{{ route('jobPost.index') }}"
                   class="group flex items-center gap-4 bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:border-sky-300 hover:shadow-md transition-all duration-200">
                    <div class="w-12 h-12 rounded-2xl bg-sky-50 flex items-center justify-center flex-shrink-0 group-hover:bg-sky-500 transition-colors duration-200">
                        <svg class="w-6 h-6 text-sky-500 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-gray-900 group-hover:text-sky-600 transition-colors">Job Posts</p>
                        <p class="text-xs text-gray-400 mt-0.5">Manage listings</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-sky-400 transition-colors ml-auto flex-shrink-0 -translate-x-1 group-hover:translate-x-0 duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                {{-- Create Skill --}}
                <a href="{{ route('skill.create') }}"
                   class="group flex items-center gap-4 bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:border-violet-300 hover:shadow-md transition-all duration-200">
                    <div class="w-12 h-12 rounded-2xl bg-violet-50 flex items-center justify-center flex-shrink-0 group-hover:bg-violet-500 transition-colors duration-200">
                        <svg class="w-6 h-6 text-violet-500 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-gray-900 group-hover:text-violet-600 transition-colors">Create Skill</p>
                        <p class="text-xs text-gray-400 mt-0.5">Add to skill database</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-violet-400 transition-colors ml-auto flex-shrink-0 -translate-x-1 group-hover:translate-x-0 duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                {{-- Placeholder / CTA card --}}
                <div class="flex items-center gap-4 bg-gray-900 rounded-2xl border border-gray-800 shadow-sm p-5">
                    <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-white">All Systems</p>
                        <p class="text-xs text-gray-400 mt-0.5">Running smoothly</p>
                    </div>
                    <span class="ml-auto flex-shrink-0 w-2.5 h-2.5 rounded-full bg-emerald-400 ring-4 ring-emerald-400/20"></span>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection 