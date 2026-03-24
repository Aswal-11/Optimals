@extends('layouts.admin')

@section('title', 'Edit Role')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4">
            <circle cx="12" cy="8" r="4" stroke-linecap="round" stroke-linejoin="round" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 20c0-3.314 2.686-6 6-6s6 2.686 6 6" />
        </svg>
        <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('roles.index') }}" class="hover:text-indigo-600 transition-colors">Roles</a>
        <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900">Edit</span>
    </div>
@endsection

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            {{-- Header --}}
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Edit Role: {{ $role->name }}
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Update role details and adjust permissions.
                    </p>
                </div>
                <a href="{{ route('roles.index') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600 flex items-center gap-1.5">
                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to List
                </a>
            </div>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Card --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8">

                <form action="{{ route('roles.update', $role->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Role Name --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Role Name
                            </label>
                            <input type="text" name="name" value="{{ old('name', $role->name) }}" placeholder="e.g. Admin"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white shadow-sm transition-all">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tables Multi Select --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Table Access
                            </label>

                            <select name="table_names[]" multiple
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white shadow-sm h-[42px] overflow-hidden hover:overflow-y-auto transition-all">

                                @foreach ($tableNames as $table)
                                    <option value="{{ $table }}"
                                        {{ collect(old('table_names', $selectedTables))->contains($table) ? 'selected' : '' }}>
                                        {{ ucfirst($table) }}
                                    </option>
                                @endforeach

                            </select>

                            <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-widest font-bold">
                                Hold Ctrl/Cmd for multiple selection
                            </p>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Description
                        </label>
                        <textarea name="description" rows="3" placeholder="Describe what this role is for..."
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white shadow-sm transition-all">{{ old('description', $role->description) }}</textarea>
                    </div>

                    {{-- Permissions --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center justify-between">
                            <span>Permissions</span>
                            <span class="text-[10px] font-bold text-indigo-500 bg-indigo-50 px-2 py-0.5 rounded-md uppercase">Select relevant actions</span>
                        </label>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 max-h-72 overflow-y-auto pr-2 custom-scrollbar">
                            @foreach ($permissions as $permission)
                                <label
                                    class="group flex items-center gap-2 border rounded-xl px-3 py-2.5 bg-gray-50 hover:bg-white hover:border-indigo-400 hover:shadow-sm cursor-pointer transition-all duration-150">

                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                        {{ collect(old('permissions', $role->permissions->pluck('id')))->contains($permission->id) ? 'checked' : '' }}
                                        class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 transition-all">

                                    <span class="text-sm text-gray-600 group-hover:text-indigo-700 font-medium select-none">
                                        {{ $permission->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center gap-3 pt-4">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white py-3 rounded-xl text-sm font-bold hover:from-indigo-700 hover:to-indigo-800 transition shadow-indigo-200 shadow-lg">
                            Update Role
                        </button>
                        
                        <a href="{{ route('roles.index') }}"
                           class="px-8 py-3 border border-gray-200 text-gray-500 rounded-xl text-sm font-bold hover:bg-gray-50 transition text-center uppercase tracking-wider">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>
@endsection
