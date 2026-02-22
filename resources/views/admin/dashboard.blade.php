@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-3 gap-6">
            <a href="{{ route('admin.create') }}"
                class="bg-blue-600 text-white px-6 py-4 rounded text-center font-semibold hover:bg-blue-700">
                Create New Admin
            </a>

            <a href="{{ route('designation.index') }}"
                class="bg-purple-600 text-white px-6 py-4 rounded text-center font-semibold hover:bg-purple-700">
                Designation List
            </a>

            <a href="{{ route('employee.index') }}"
                class="bg-purple-600 text-white px-6 py-4 rounded text-center font-semibold hover:bg-purple-700">
                Employee List
            </a>

            <a href="{{ route('skill.create') }}"
                class="bg-green-600 text-white px-6 py-4 rounded text-center font-semibold hover:bg-green-700">
                Create Skill
            </a>
        </div>

        <p class="mt-8 text-gray-600">Welcome to the Admin Panel</p>
    </div>
@endsection
