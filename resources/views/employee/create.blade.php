@extends('layouts.app')

@section('title', 'Create Employee')

@section('content')

    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Create Employee</h2>

        <form action="{{ route('employee.store') }}" method="POST">
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label class="block mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2">
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Age --}}
            <div class="mb-4">
                <label class="block mb-1">Age</label>
                <input type="number" name="age" value="{{ old('age') }}" class="w-full border rounded px-3 py-2">
                @error('age')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full border rounded px-3 py-2">
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Confirmation --}}
            <div class="mb-4">
                <label class="block mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full border rounded px-3 py-2">
                @error('password_confirmation')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Designation --}}
            <div class="mb-4">
                <label class="block mb-1">Designation</label>
                <select name="designation_id" class="w-full border rounded px-3 py-2">
                    <option value="">Select Designation</option>

                    @foreach ($designations as $id => $title)
                        <option value="{{ $id }}" {{ old('designation_id') == $id ? 'selected' : '' }}>
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
                <input type="number" step="0.01" name="salary" value="{{ old('salary') }}"
                    class="w-full border rounded px-3 py-2">
                @error('salary')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Submit
                </button>

                @if (Auth::guard('employee')->check())
                    <form action="{{ route('employee.logout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            Logout
                        </button>
                    </form>
                @elseif (Auth::guard('admin')->check())
                    <a href="{{ route('admin.dashboard') }}" class="flex-1 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 text-center">
                        Back
                    </a>
                @endif
            </div>
        </form>
    </div>

@endsection
