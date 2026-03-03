@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-linear-to-br from-gray-50 to-gray-100">
    {{-- Top Navbar --}}
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo and Brand --}}
                <div class="flex items-center space-x-3">
                    <div class="shrink-0">
                        <div class="h-8 w-8 bg-linear-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-xl font-bold bg-linear-to-r from-gray-800 to-gray-600 bg-clip-text">
                        Admin Dashboard
                    </h1>
                </div>

                {{-- User Menu and Logout --}}
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">Welcome back,</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        <div class="h-10 px-3 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center text-white font-semibold">
                            {{ $adminName }}
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Flash Message with Animation --}}
        @if (session('success'))
            <div id="flash-message"
                 class="mb-6 transform transition-all duration-500 ease-in-out">
                <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-md">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Welcome Section --}}
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Dashboard Overview</h2>
            <p class="text-gray-600 mt-1">Welcome to your admin dashboard. Here's what's happening with your platform today.</p>
        </div>

        {{-- Stats Grid with Icons --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Total Employees -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Employees</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2 group-hover:text-blue-600 transition-colors">
                                {{ $totalEmployees }}
                            </p>
                        </div>
                        <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-600 transition-colors">
                            <svg class="h-6 w-6 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Jobs -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Jobs</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2 group-hover:text-indigo-600 transition-colors">
                                {{ $totalJobs }}
                            </p>
                        </div>
                        <div class="h-12 w-12 bg-indigo-100 rounded-lg flex items-center justify-center group-hover:bg-indigo-600 transition-colors">
                            <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Jobs -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Active Jobs</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2 group-hover:text-green-600 transition-colors">
                                {{ $activeJobs }}
                            </p>
                        </div>
                        <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-600 transition-colors">
                            <svg class="h-6 w-6 text-green-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Designations -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Designations</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2 group-hover:text-purple-600 transition-colors">
                                {{ $totalDesignations }}
                            </p>
                        </div>
                        <div class="h-12 w-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-600 transition-colors">
                            <svg class="h-6 w-6 text-purple-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions Section --}}
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Create Admin Card -->
                <a href="{{ route('admin.create') }}"
                   class="group bg-linear-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-12 w-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white">Create New Admin</h4>
                                <p class="text-sm text-blue-100 mt-1">Add a new administrator to the system</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Designation Card -->
                <a href="{{ route('designation.index') }}"
                   class="group bg-linear-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-12 w-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a3 3 0 01-3-3V6a3 3 0 013-3z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white">Designation List</h4>
                                <p class="text-sm text-purple-100 mt-1">Manage and organize designations</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Employee List Card -->
                <a href="{{ route('employee.index') }}"
                   class="group bg-linear-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-12 w-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white">Employee List</h4>
                                <p class="text-sm text-indigo-100 mt-1">View and manage employee records</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Job Posts Card -->
                <a href="{{ route('jobPost.index') }}"
                   class="group bg-linear-to-br from-pink-500 to-pink-600 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-12 w-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white">Job Posts</h4>
                                <p class="text-sm text-pink-100 mt-1">Manage and publish job listings</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Create Skill Card -->
                <a href="{{ route('skill.create') }}"
                   class="group bg-linear-to-br from-green-500 to-green-600 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-12 w-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white">Create Skill</h4>
                                <p class="text-sm text-green-100 mt-1">Add new skills to the database</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection