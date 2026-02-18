@extends('layouts.app')

@section('title', 'Create Employee')

@section('content')

    <div class="flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow w-96">
            <h2 class="text-2xl font-bold mb-6 text-center">Employee Login</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('employee.authenticate') }}">
                @csrf

                <input type="email" name="email" placeholder="Email"
                    class="w-full mb-4 p-2 border rounded @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                @enderror

                <input type="password" name="password" placeholder="Password"
                    class="w-full mb-4 p-2 border rounded @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                @enderror

                <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                    Login
                </button>
            </form>
        </div>
    </div>
@endsection
