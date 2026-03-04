@extends('layouts.app')

@section('title', 'Employee Login')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 px-4 py-10">

<div class="w-full max-w-md bg-white shadow-2xl rounded-2xl p-6 sm:p-8">

    {{-- Heading --}}
    <div class="text-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Employee Login</h2>
        <p class="text-gray-500 text-sm mt-1">Access your dashboard</p>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <ul class="text-sm list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('employee.authenticate') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                Email Address
            </label>

            <div class="relative">
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500
                    @error('email') border-red-500 @enderror"
                >
            </div>

            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                Password
            </label>

            <div class="relative">
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500
                    @error('password') border-red-500 @enderror"
                >

                <button
                    type="button"
                    onclick="togglePassword()"
                    class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600"
                >
                  view
                </button>
            </div>

            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember + Forgot --}}
        <div class="flex items-center justify-between text-sm">

            <label class="flex items-center gap-2 text-gray-600">
                <input type="checkbox" class="rounded border-gray-300">
                Remember me
            </label>

            <a href="#" class="text-purple-600 hover:underline">
                Forgot password?
            </a>

        </div>

        {{-- Button --}}
        <button
            type="submit"
            class="w-full py-2.5 rounded-lg font-semibold text-white
            bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500
            hover:opacity-90 hover:shadow-lg transition duration-200"
        >
            Login
        </button>

    </form>
</div>


</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

@endsection
