@extends('layouts.admin')

@section('title', 'Designation List')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- ── Header ── --}}
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <p class="text-xs font-bold tracking-widest uppercase text-indigo-600 mb-1">HR Setup</p>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">Designations</h1>
                <p class="mt-1.5 text-sm text-gray-500">Manage and organize all job roles and positions</p>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
                <a href="{{ route('admin.dashboard') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-900 hover:text-white hover:border-gray-900 transition-all duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="hidden sm:inline">Dashboard</span>
                </a>
                <a href="{{ route('designation.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 transition-all duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="hidden sm:inline">Create Designation</span>
                </a>
            </div>
        </div>

        {{-- ── Toolbar ── --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm px-5 py-4 mb-5">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <form method="GET" action="{{ route('designation.index') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 flex-1">
                    <div class="relative flex-1 max-w-md">
                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search designation title…"
                            class="w-full pl-10 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all"/>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-5 py-2.5 bg-gray-900 text-white text-sm font-medium rounded-xl hover:bg-indigo-600 transition-colors duration-150 shadow-sm">
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('designation.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-600 text-sm font-medium rounded-xl hover:border-red-300 hover:text-red-500 transition-colors duration-150">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
                <div class="text-sm text-gray-500 flex-shrink-0">
                    Total: <span class="font-semibold text-gray-900">{{ $designations->total() }}</span> designations
                </div>
            </div>
        </div>

        {{-- ── Desktop Table ── --}}
        <div class="hidden sm:block bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[500px]">
                    <thead>
                        <tr class="bg-gray-900">
                            <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest w-12">#</th>
                            <th class="px-4 py-3.5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Designation</th>
                            <th class="px-4 py-3.5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Description</th>
                            <th class="px-4 py-3.5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Skills</th>
                            <th class="px-5 py-3.5 text-right text-xs font-bold text-gray-400 uppercase tracking-widest">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($designations as $designation)
                            <tr class="hover:bg-indigo-50/40 transition-colors duration-100">
                                <td class="px-5 py-3.5 text-xs font-medium text-gray-400">{{ $loop->iteration }}</td>

                                <td class="px-4 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                                            <span class="text-xs font-bold text-white tracking-wide">{{ strtoupper(substr($designation->title, 0, 2)) }}</span>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-900">{{ $designation->title }}</span>
                                    </div>
                                </td>

                                <td class="px-4 py-3.5 text-sm text-gray-500">
                                    {{ Str::limit($designation->description ?? '—', 60) }}
                                </td>

                                <td class="px-4 py-3.5">
                                    <div class="flex flex-wrap gap-1">
                                        @forelse($designation->skills as $skill)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 text-xs font-medium">{{ $skill->name }}</span>
                                        @empty
                                            <span class="text-xs text-gray-400">—</span>
                                        @endforelse
                                    </div>
                                </td>

                                <td class="px-5 py-3.5">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('designation.show', $designation->id) }}"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-600 text-xs font-medium hover:bg-indigo-600 hover:text-white transition-all duration-150">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            View
                                        </a>
                                        <a href="{{ route('designation.edit', $designation->id) }}"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-xs font-medium hover:bg-emerald-500 hover:text-white transition-all duration-150">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('designation.delete', $designation->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete {{ $designation->title }}? This cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-500 text-xs font-medium hover:bg-red-500 hover:text-white transition-all duration-150 border-0 cursor-pointer">
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
                                <td colspan="5" class="px-4 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 rounded-2xl bg-gray-100 border border-gray-200 flex items-center justify-center mb-4">
                                            <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a3 3 0 01-3-3V6a3 3 0 013-3z"/>
                                            </svg>
                                        </div>
                                        <p class="text-base font-bold text-gray-800 mb-1">No designations found</p>
                                        <p class="text-sm text-gray-400 mb-5">{{ request('search') ? 'Try a different search term.' : 'Create your first designation to get started.' }}</p>
                                        @if(!request('search'))
                                            <a href="{{ route('designation.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                                Create Designation
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ── Mobile Cards ── --}}
        <div class="sm:hidden flex flex-col gap-3">
            @forelse($designations as $designation)
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <span class="text-sm font-bold text-white tracking-wide">{{ strtoupper(substr($designation->title, 0, 2)) }}</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ $designation->title }}</p>
                            <p class="text-xs text-gray-400 truncate mt-0.5">{{ Str::limit($designation->description ?? '—', 40) }}</p>
                        </div>
                    </div>

                    @if($designation->skills->count())
                        <div class="mb-4">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Skills</p>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($designation->skills as $skill)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 text-xs font-medium">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="flex gap-2 pt-3 border-t border-gray-100">
                        <a href="{{ route('designation.show', $designation->id) }}"
                           class="flex-1 inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-indigo-50 text-indigo-600 text-xs font-semibold hover:bg-indigo-600 hover:text-white transition-all duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            View
                        </a>
                        <a href="{{ route('designation.edit', $designation->id) }}"
                           class="flex-1 inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-emerald-50 text-emerald-600 text-xs font-semibold hover:bg-emerald-500 hover:text-white transition-all duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit
                        </a>
                        <form action="{{ route('designation.delete', $designation->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete {{ $designation->title }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 py-2 rounded-xl bg-red-50 text-red-500 text-xs font-semibold hover:bg-red-500 hover:text-white transition-all duration-150 border-0 cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm px-6 py-16 text-center">
                    <p class="text-sm font-semibold text-gray-700 mb-1">No designations found</p>
                    <p class="text-xs text-gray-400">{{ request('search') ? 'Try a different search term.' : 'Add your first designation to get started.' }}</p>
                </div>
            @endforelse
        </div>

        {{-- ── Pagination ── --}}
        @if($designations->hasPages())
            <div class="mt-6 flex justify-end">
                {{ $designations->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
