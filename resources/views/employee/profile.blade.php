@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8">

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Employee Profile
                </h2>

                <div>
                    @if (Auth::guard('employee')->check())
                        <form action="{{ route('employee.logout') }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Logout
                            </button>
                        </form>
                    @elseif (Auth::guard('admin')->check())
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex-1 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 text-center">
                            Back
                        </a>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">

                <div>
                    <p class="text-gray-500">Name</p>
                    <p class="text-lg font-semibold">{{ $employee->name }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Age</p>
                    <p class="text-lg font-semibold">{{ $employee->age }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Email</p>
                    <p class="text-lg font-semibold">{{ $employee->email }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Salary</p>
                    <p class="text-lg font-semibold">₹{{ $employee->salary }}</p>
                </div>

                <div class="col-span-2">
                    <p class="text-gray-500">Designation</p>
                    <p class="text-lg font-semibold">
                        {{ $employee->designation->title ?? 'N/A' }}
                    </p>
                </div>

                {{-- Skills --}}
                <div class="col-span-2">
                    <p class="text-gray-500 mb-2">Skills</p>

                    <div class="flex flex-wrap gap-2">
                        @forelse ($employee->designation->skills ?? [] as $skill)
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                {{ $skill->name }}
                            </span>
                        @empty
                            <p class="text-gray-400">No Skills Assigned</p>
                        @endforelse
                    </div>
                </div>

            </div>

            {{-- Edit Button
        <div class="mt-6">
            <a href="{{ route('employees.edit', $employee->id) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Edit Profile
            </a>
        </div> --}}

        </div>
    </div>
@endsection
