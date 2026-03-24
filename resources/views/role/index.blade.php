@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- ── Header ── --}}
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <p class="text-xs font-bold tracking-widest uppercase text-indigo-600 mb-1">User Management</p>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
                    Roles & Permissions
                </h1>
                <p class="mt-1.5 text-sm text-gray-500">Manage user roles and their access levels across tables</p>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
               <a href="{{ route('admin.dashboard') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-900 hover:text-white hover:border-gray-900 transition-all duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="hidden sm:inline">Dashboard</span>
                </a>
                <a href="{{ route('role.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 transition-all duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="hidden sm:inline">Add Role</span>
                </a>
            </div>
        </div>

        {{-- ── Success Toast ── --}}
        @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
        </div>
        @endif

        {{-- ── Desktop Table ── --}}
        <div class="hidden sm:block bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[700px]">
                    <thead>
                        <tr class="bg-gray-900">
                            <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest w-12">#</th>
                            <th class="px-4 py-3.5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Role Name</th>
                            <th class="px-4 py-3.5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Permissions</th>
                            <th class="px-4 py-3.5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Table Access</th>
                            <th class="px-5 py-3.5 text-right text-xs font-bold text-gray-400 uppercase tracking-widest">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($roles as $role)
                            <tr class="hover:bg-indigo-50/40 transition-colors duration-100">
                                <td class="px-5 py-3.5 text-xs font-medium text-gray-400">{{ $loop->iteration }}</td>

                                <td class="px-4 py-3.5">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-gray-900">{{ $role->name }}</span>
                                        @if($role->description)
                                            <span class="text-xs text-gray-500 mt-0.5 line-clamp-1 truncate" title="{{ $role->description }}">{{ $role->description }}</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-4 py-3.5">
                                    <div class="flex flex-wrap gap-1">
                                        @php $perms = $role->permissions->take(3); @endphp
                                        @foreach($perms as $permission)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-indigo-50 text-indigo-700 text-[10px] font-bold uppercase tracking-wider">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                        @if($role->permissions->count() > 3)
                                            <span class="text-[10px] font-bold text-gray-400 px-1">+{{ $role->permissions->count() - 3 }} more</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-4 py-3.5">
                                    @php
                                        $tables = [];
                                        if ($role->permissions->isNotEmpty()) {
                                            $tables = explode(',', $role->permissions->first()->pivot->table_name);
                                        }
                                    @endphp
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($tables as $table)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-bold uppercase tracking-wider">
                                                {{ $table }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="px-5 py-3.5 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('role.edit', $role->id) }}"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-xs font-medium hover:bg-emerald-500 hover:text-white transition-all duration-150">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Delete role {{ $role->name }}? This will affect users assigned to this role.')"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-500 text-xs font-medium hover:bg-red-500 hover:text-white transition-all duration-150 cursor-pointer border-0">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-20 text-center text-gray-400">
                                    No roles found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ── Mobile Cards ── --}}
        <div class="sm:hidden flex flex-col gap-3">
            @forelse($roles as $role)
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center justify-between mb-2">
                         <span class="text-sm font-bold text-gray-900">{{ $role->name }}</span>
                         <span class="text-xs text-gray-400">#{{ $loop->iteration }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mb-4">{{ $role->description ?: 'No description' }}</p>
                    
                    <div class="flex flex-col gap-3">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Tables</p>
                            @php
                                $tables = [];
                                if ($role->permissions->isNotEmpty()) {
                                    $tables = explode(',', $role->permissions->first()->pivot->table_name);
                                }
                            @endphp
                            <div class="flex flex-wrap gap-1">
                                @foreach($tables as $table)
                                    <span class="inline-flex px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-bold uppercase truncate max-w-[100px]">
                                        {{ $table }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 mt-4 pt-3 border-t border-gray-100">
                        <a href="{{ route('role.edit', $role->id) }}"
                           class="flex-1 inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-emerald-50 text-emerald-600 text-xs font-semibold hover:bg-emerald-500 hover:text-white transition-all duration-150">
                            Edit
                        </a>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Delete role?')"
                                    class="w-full inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-red-50 text-red-500 text-xs font-semibold hover:bg-red-500 hover:text-white transition-all duration-150 border-0">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm px-6 py-10 text-center text-gray-400 text-sm">
                    No roles found.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection