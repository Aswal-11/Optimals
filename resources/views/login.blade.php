@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center ">
    
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 space-y-6 ">
        
        {{-- Title --}}
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
            <p class="text-gray-500 text-sm">Login to your account</p>
        </div>

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 text-sm p-3 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="/login" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Enter your email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required
                >
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Enter your password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required
                >
            </div>

            {{-- Button --}}
            <button 
                type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-2 rounded-lg font-semibold hover:opacity-90 transition duration-200"
            >
                Login
            </button>
        </form>

    </div>
</div>
@endsection