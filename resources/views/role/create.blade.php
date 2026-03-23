@extends('layouts.admin')

@section('title', 'Create Role')

@section('breadcrumb')
<div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
    <span>Roles</span>
    <span>/</span>
    <span class="text-gray-900">Create</span>
</div>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                Create Role
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Define role details and assign permissions.
            </p>
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

            <form action="{{ route('role.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Role Name --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Role Name
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        placeholder="e.g. Admin"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Description
                    </label>
                    <textarea name="description" rows="3"
                        placeholder="Role description"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white">{{ old('description') }}</textarea>
                </div>

                {{-- Tables Multi Select --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Table Access
                    </label>

                    <select name="table_names[]" multiple
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white">

                        @foreach($tableNames as $table)
                            <option value="{{ $table }}"
                                {{ collect(old('table_names'))->contains($table) ? 'selected' : '' }}>
                                {{ ucfirst($table) }}
                            </option>
                        @endforeach

                    </select>

                    <p class="text-xs text-gray-500 mt-1">
                        Hold Ctrl (Windows) / Cmd (Mac) to select multiple
                    </p>
                </div>

                {{-- Permissions --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Permissions
                    </label>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 max-h-64 overflow-y-auto pr-2">
                        @foreach($permissions as $permission)
                            <label class="flex items-center gap-2 border rounded-xl px-3 py-2 bg-gray-50 hover:bg-gray-100 cursor-pointer">

                                <input type="checkbox"
                                    name="permissions[]"
                                    value="{{ $permission->id }}"
                                    {{ collect(old('permissions'))->contains($permission->id) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">

                                <span class="text-sm text-gray-700">
                                    {{ $permission->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-indigo-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-indigo-700 transition">
                        Create Role
                    </button>

                    {{-- <a href="{{ route('roles.index') }}"
                        class="flex-1 border border-gray-200 text-gray-600 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-50 transition text-center">
                        Cancel
                    </a> --}}
                </div>

            </form>
        </div>
    </div>
</div>
@endsection