@extends('layouts.admin')

@section('title', 'Subusers')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
        <x-icons.user class="w-4 h-4 text-gray-400" />
        <span class="text-gray-900">Subusers</span>
    </div>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <p class="text-xs font-bold tracking-widest uppercase text-indigo-600 mb-1">Access Control</p>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
                    Subusers
                </h1>
                <p class="mt-1.5 text-sm text-gray-500">Manage sub-accounts and their access roles</p>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
                <a href="{{ route('admin.dashboard') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-900 hover:text-white hover:border-gray-900 transition-all duration-150">
                    <x-icons.arrow-left class="w-4 h-4" />
                    <span class="hidden sm:inline">Dashboard</span>
                </a>
                @can('create', \App\Models\SubUser::class)
                <a href="{{ route('subusers.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 transition-all duration-150">
                    <x-icons.plus class="w-4 h-4" />
                    <span class="hidden sm:inline">Add Subuser</span>
                </a>
                @endcan
            </div>
        </div>

        {{-- Desktop Table --}}
        <div class="hidden sm:block bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px]">
                    <thead>
                        <tr class="bg-gray-900">
                            <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest w-12">#</th>
                            <th class="px-4 py-3.5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Subuser</th>
                            <th class="px-4 py-3.5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Email</th>
                            <th class="px-4 py-3.5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Role</th>
                            <th class="px-5 py-3.5 text-right text-xs font-bold text-gray-400 uppercase tracking-widest">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($subusers as $subuser)
                            <tr class="hover:bg-indigo-50/40 transition-colors duration-100">
                                <td class="px-5 py-3.5 text-xs font-medium text-gray-400">{{ $loop->iteration }}</td>

                                <td class="px-4 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                                            <span class="text-xs font-bold text-white tracking-wide">
                                                {{ strtoupper(substr($subuser->name, 0, 2)) }}
                                            </span>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-900">{{ $subuser->name }}</span>
                                    </div>
                                </td>

                                <td class="px-4 py-3.5 text-sm text-gray-500">{{ $subuser->email }}</td>

                                <td class="px-4 py-3.5">
                                    @if($subuser->role)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-semibold">
                                            {{ $subuser->role->name }}
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">— No Role</span>
                                    @endif
                                </td>

                                <td class="px-5 py-3.5">
                                    <div class="flex items-center justify-end gap-2">
                                        @can('view', $subuser)
                                        <a href="{{ route('subusers.show', $subuser->id) }}"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-600 text-xs font-medium hover:bg-indigo-600 hover:text-white transition-all duration-150">
                                            <x-icons.eye class="w-3.5 h-3.5" />
                                            View
                                        </a>
                                        @endcan
                                        @can('update', $subuser)
                                        <a href="{{ route('subusers.edit', $subuser->id) }}"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-xs font-medium hover:bg-emerald-500 hover:text-white transition-all duration-150">
                                            <x-icons.edit class="w-3.5 h-3.5" />
                                            Edit
                                        </a>
                                        @endcan
                                        @can('delete', $subuser)
                                        <form action="{{ route('subusers.destroy', $subuser->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Delete {{ $subuser->name }}? This cannot be undone.')"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-500 text-xs font-medium hover:bg-red-500 hover:text-white transition-all duration-150 cursor-pointer border-0">
                                                <x-icons.trash class="w-3.5 h-3.5" />
                                                Delete
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 rounded-2xl bg-gray-100 border border-gray-200 flex items-center justify-center mb-4">
                                            <x-icons.user class="w-7 h-7 text-gray-400" />
                                        </div>
                                        <p class="text-base font-bold text-gray-800 mb-1">No subusers found</p>
                                        <p class="text-sm text-gray-400 mb-5">Get started by creating the first sub-account.</p>
                                        <a href="{{ route('subusers.create') }}"
                                           class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition-colors">
                                            <x-icons.plus class="w-4 h-4" />
                                            Add Subuser
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile Cards --}}
        <div class="sm:hidden flex flex-col gap-3">
            @forelse($subusers as $subuser)
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <span class="text-sm font-bold text-white tracking-wide">{{ strtoupper(substr($subuser->name, 0, 2)) }}</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ $subuser->name }}</p>
                            <p class="text-xs text-gray-400 truncate mt-0.5">{{ $subuser->email }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Role</p>
                        @if($subuser->role)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-semibold">
                                {{ $subuser->role->name }}
                            </span>
                        @else
                            <span class="text-xs text-gray-400">No Role Assigned</span>
                        @endif
                    </div>

                    <div class="flex gap-2 pt-3 border-t border-gray-100">
                        @can('view', $subuser)
                        <a href="{{ route('subusers.show', $subuser->id) }}"
                           class="flex-1 inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-indigo-50 text-indigo-600 text-xs font-semibold hover:bg-indigo-600 hover:text-white transition-all duration-150">
                            <x-icons.eye class="w-3.5 h-3.5" />
                            View
                        </a>
                        @endcan
                        @can('update', $subuser)
                        <a href="{{ route('subusers.edit', $subuser->id) }}"
                           class="flex-1 inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-emerald-50 text-emerald-600 text-xs font-semibold hover:bg-emerald-500 hover:text-white transition-all duration-150">
                            <x-icons.edit class="w-3.5 h-3.5" />
                            Edit
                        </a>
                        @endcan
                        @can('delete', $subuser)
                        <form action="{{ route('subusers.destroy', $subuser->id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Delete {{ $subuser->name }}?')"
                                    class="w-full inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-red-50 text-red-500 text-xs font-semibold hover:bg-red-500 hover:text-white transition-all duration-150 cursor-pointer border-0">
                                <x-icons.trash class="w-3.5 h-3.5" />
                                Delete
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm px-6 py-16 text-center">
                    <p class="text-sm font-semibold text-gray-700 mb-1">No subusers found</p>
                    <p class="text-xs text-gray-400">Add your first sub-account to get started.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection