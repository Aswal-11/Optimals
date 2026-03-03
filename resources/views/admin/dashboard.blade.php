@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="min-h-screen bg-gray-100">

    {{-- Top Navbar --}}
    <div class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">
                Admin Dashboard
            </h1>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 transition text-white px-5 py-2 rounded-lg shadow">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- Flash Message --}}
        @if (session('success'))
            <div id="flash-message"
                 class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif


        {{-- 🔥 Stats Section --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                <h3 class="text-gray-500 text-sm">Total Employees</h3>
                <p class="text-3xl font-bold text-indigo-600 mt-2">
                    {{ $totalEmployees }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                <h3 class="text-gray-500 text-sm">Total Jobs</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">
                    {{ $totalJobs }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                <h3 class="text-gray-500 text-sm">Active Jobs</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">
                    {{ $activeJobs }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                <h3 class="text-gray-500 text-sm">Designations</h3>
                <p class="text-3xl font-bold text-purple-600 mt-2">
                    {{ $totalDesignations }}
                </p>
            </div>

        </div>


        {{-- Existing Dashboard Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">

            <a href="{{ route('admin.create') }}"
               class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-6 rounded-2xl shadow-lg hover:scale-105 transform transition duration-300">
                <h2 class="text-lg font-semibold">Create New Admin</h2>
                <p class="text-sm opacity-90 mt-2">Add a new administrator</p>
            </a>

            <a href="{{ route('designation.index') }}"
               class="bg-gradient-to-r from-purple-600 to-purple-500 text-white p-6 rounded-2xl shadow-lg hover:scale-105 transform transition duration-300">
                <h2 class="text-lg font-semibold">Designation List</h2>
                <p class="text-sm opacity-90 mt-2">Manage designations</p>
            </a>

            <a href="{{ route('employee.index') }}"
               class="bg-gradient-to-r from-indigo-600 to-indigo-500 text-white p-6 rounded-2xl shadow-lg hover:scale-105 transform transition duration-300">
                <h2 class="text-lg font-semibold">Employee List</h2>
                <p class="text-sm opacity-90 mt-2">View & manage employees</p>
            </a>

            <a href="{{ route('jobPost.index') }}"
               class="bg-gradient-to-r from-pink-600 to-pink-500 text-white p-6 rounded-2xl shadow-lg hover:scale-105 transform transition duration-300">
                <h2 class="text-lg font-semibold">Job Posts</h2>
                <p class="text-sm opacity-90 mt-2">Manage job listings</p>
            </a>

            <a href="{{ route('skill.create') }}"
               class="bg-gradient-to-r from-green-600 to-green-500 text-white p-6 rounded-2xl shadow-lg hover:scale-105 transform transition duration-300">
                <h2 class="text-lg font-semibold">Create Skill</h2>
                <p class="text-sm opacity-90 mt-2">Add new skill</p>
            </a>

        </div>


        {{-- 📊 Chart Section --}}
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-lg font-semibold mb-4">System Overview</h2>
            <canvas id="dashboardChart" height="100"></canvas>
        </div>

        <p class="mt-10 text-gray-600 text-center text-sm">
            Welcome to the Admin Panel 🚀
        </p>

    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('dashboardChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Employees', 'Jobs', 'Active Jobs', 'Designations'],
            datasets: [{
                data: [
                    {{ $totalEmployees }},
                    {{ $totalJobs }},
                    {{ $activeJobs }},
                    {{ $totalDesignations }}
                ],
                backgroundColor: [
                    '#6366f1',
                    '#3b82f6',
                    '#22c55e',
                    '#a855f7'
                ],
                borderRadius: 8
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            responsive: true
        }
    });
</script>

@endsection