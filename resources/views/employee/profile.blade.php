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
                            <x-icons.briefcase class="w-4 h-4 mr-2" />
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
                            <x-icons.error class="h-5 w-5 text-red-500 mr-3" />
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mx-8 mt-6 flash-message">
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm" role="alert">
                        <div class="flex items-center">
                            <x-icons.check-circle class="h-5 w-5 text-green-500 mr-3" />
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
                            <x-icons.user class="w-5 h-5 mr-2 text-gray-400" />
                            Personal Information
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Age</p>
                                <p class="text-lg font-semibold text-gray-900 flex items-center">
                                    <x-icons.calendar class="w-4 h-4 mr-2 text-gray-400" />
                                    {{ $employee->age }} years
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Email Address</p>
                                <p class="text-lg font-semibold text-gray-900 flex items-center break-all">
                                    <x-icons.info class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0" />
                                    {{ $employee->email }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Information Card -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 flex items-center">
                            <x-icons.briefcase class="w-5 h-5 mr-2 text-gray-400" />
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
                                    <x-icons.tag class="w-5 h-5 mr-2 text-green-500" />
                                    ₹{{ number_format($employee->salary, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4 flex items-center">
                        <x-icons.bulb class="w-5 h-5 mr-2 text-blue-500" />
                        Technical Skills
                    </h3>
                    
                    <div class="flex flex-wrap gap-2">
                        @forelse ($employee->designation?->skills ?? [] as $skill)
                            <span class="group relative">
                                <span class="bg-white text-blue-700 px-4 py-2 rounded-lg text-sm font-medium shadow-sm border border-blue-200 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all duration-300 cursor-default flex items-center">
                                    <x-icons.check-circle class="w-4 h-4 mr-1.5" />
                                    {{ $skill->name }}
                                </span>
                                <!-- Tooltip on hover (optional) -->
                                <span class="absolute hidden group-hover:block bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white text-xs rounded shadow-lg whitespace-nowrap">
                                    {{ $skill->name }} Skill
                                </span>
                            </span>
                        @empty
                            <div class="text-center py-8 w-full">
                                <x-icons.bulb class="w-16 h-16 mx-auto text-gray-300 mb-3" />
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