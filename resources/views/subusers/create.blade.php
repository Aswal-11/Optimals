@extends('layouts.admin')

@section('title', 'Create Subuser')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 20c0-3.314 2.686-6 6-6s6 2.686 6 6"/>
        </svg>
        <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('subusers.index') }}" class="hover:text-gray-700 transition-colors">Subusers</a>
        <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-900">Create</span>
    </div>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Add Subuser</h1>
            <p class="mt-1 text-sm text-gray-500">Fill in the details below to create a new sub-account.</p>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        {{-- Card --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8">
            <form action="{{ route('subusers.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    {{-- Name --}}
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Amit Verma"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="e.g. amit@example.com"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Role</label>
                        <select name="role_id"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all">
                            <option value="">— No Role —</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                        <input type="password" name="password" placeholder="Create a password"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all">
                        @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Repeat password"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all">
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-indigo-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                        Create Subuser
                    </button>
                    <a href="{{ route('subusers.index') }}"
                        class="flex-1 border border-gray-200 text-gray-600 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-colors text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection