@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')

<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Edit Employee</h2>

    <form action="{{ route('employee.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input type="text" name="name"
                value="{{ old('name', $employee->name) }}"
                class="w-full border rounded px-3 py-2">
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Age --}}
        <div class="mb-4">
            <label class="block mb-1">Age</label>
            <input type="number" name="age"
                value="{{ old('age', $employee->age) }}"
                class="w-full border rounded px-3 py-2">
            @error('age')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email"
                value="{{ old('email', $employee->email) }}"
                class="w-full border rounded px-3 py-2">
            @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password (Optional in Edit) --}}
        <div class="mb-4">
            <label class="block mb-1">New Password (Optional)</label>
            <input type="password" name="password"
                class="w-full border rounded px-3 py-2">
            @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="mb-4">
            <label class="block mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation"
                class="w-full border rounded px-3 py-2">
        </div>

        {{-- Designation --}}
        <div class="mb-4">
            <label class="block mb-1">Designation</label>
            <select name="designation_id" class="w-full border rounded px-3 py-2">
                <option value="">Select Designation</option>

                @foreach ($designations as $id => $title)
                    <option value="{{ $id }}"
                        {{ old('designation_id', $employee->designation_id) == $id ? 'selected' : '' }}>
                        {{ $title }}
                    </option>
                @endforeach
            </select>

            @error('designation_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Salary --}}
        <div class="mb-4">
            <label class="block mb-1">Salary</label>
            <input type="number" step="0.01" name="salary"
                value="{{ old('salary', $employee->salary) }}"
                class="w-full border rounded px-3 py-2">
            @error('salary')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit"
                class="flex-1 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update
            </button>

            <a href="{{ route('employee.index') }}"
                class="flex-1 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 text-center">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection