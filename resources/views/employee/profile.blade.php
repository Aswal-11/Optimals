@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header with gradient background -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Employee Profile</h1>
                    <p class="mt-2 text-sm text-gray-600">Detailed information about the employee</p>
                </div>
                <!-- You can add action buttons here if needed -->
            </div>
        </div>

        <!-- Main Profile Card -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <!-- Profile Header with Avatar -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-10">
                <div class="flex items-center space-x-6">
                    <!-- Avatar with initials -->
                    <div class="h-24 w-24 rounded-2xl bg-white/20 backdrop-blur-lg flex items-center justify-center border-4 border-white/30 shadow-xl">
                        <span class="text-3xl font-bold text-white">
                            {{ strtoupper(substr($employee->name, 0, 2)) }}
                        </span>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-white">{{ $employee->name }}</h2>
                        <p class="text-blue-100 mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ $employee->designation->title ?? 'No Designation Assigned' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if (session('error'))
                <div class="mx-8 mt-6">
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm" role="alert">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mx-8 mt-6 flash-message">
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm" role="alert">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Profile Content -->
            <div class="p-8">
                <!-- Key Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Personal Information Card -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Personal Information
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Age</p>
                                <p class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $employee->age }} years
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Email Address</p>
                                <p class="text-lg font-semibold text-gray-900 flex items-center break-all">
                                    <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $employee->email }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Information Card -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Employment Details
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Designation</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $employee->designation->title ?? 'Not Assigned' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Salary</p>
                                <p class="text-2xl font-bold text-green-600 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    ₹{{ number_format($employee->salary, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        Technical Skills
                    </h3>
                    
                    <div class="flex flex-wrap gap-2">
                        @forelse ($employee->designation?->skills ?? [] as $skill)
                            <span class="group relative">
                                <span class="bg-white text-blue-700 px-4 py-2 rounded-lg text-sm font-medium shadow-sm border border-blue-200 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all duration-300 cursor-default flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $skill->name }}
                                </span>
                                <!-- Tooltip on hover (optional) -->
                                <span class="absolute hidden group-hover:block bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white text-xs rounded shadow-lg whitespace-nowrap">
                                    {{ $skill->name }} Skill
                                </span>
                            </span>
                        @empty
                            <div class="text-center py-8 w-full">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                <p class="text-gray-500 text-lg">No skills assigned yet</p>
                                <p class="text-gray-400 text-sm mt-1">Skills will appear here once assigned to the designation</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection