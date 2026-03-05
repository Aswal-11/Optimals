@extends('layouts.app')

@section('title', 'Designation List')

@section('content')

    <div class="min-h-screen bg-gray-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">

                <div>
                    <p class="text-xs font-bold tracking-widest uppercase text-indigo-600 mb-1">
                        HR Setup
                    </p>

                    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                        Designation Directory
                    </h1>

                    <p class="mt-1.5 text-sm text-gray-500">
                        Manage and organize job designations
                    </p>
                </div>

                <div class="flex items-center gap-3 flex-shrink-0">

                    <a href="/admin/dashboard"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-900 hover:text-white transition">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>

                        Dashboard
                    </a>

                    <a href="{{ route('designation.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-medium shadow-sm hover:bg-indigo-700 transition">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>

                        Create Designation
                    </a>

                </div>
            </div>

            {{-- Search Toolbar --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm px-5 py-4 mb-5">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="text-sm text-gray-500">
                        Total:
                        <span class="font-semibold text-gray-900">
                            {{ $designations->total() }}
                        </span>
                        designations
                    </div>
                    
                    <form method="GET" action="{{ route('designation.index') }}"
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 flex-1">

                        <div class="relative flex-1">

                            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search designation title..."
                                class="w-full pl-10 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />

                        </div>

                        <div class="flex gap-2">

                            <button type="submit"
                                class="px-5 py-2.5 bg-gray-900 text-white text-sm font-medium rounded-xl hover:bg-indigo-600 transition">
                                Search
                            </button>

                            @if (request('search'))
                                <a href="{{ route('designation.index') }}"
                                    class="px-5 py-2.5 bg-white border border-gray-200 text-gray-600 text-sm font-medium rounded-xl hover:text-red-500">
                                    Clear
                                </a>
                            @endif

                        </div>

                    </form>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[600px]">

                        <thead>

                            <tr class="bg-gray-900">

                                <th class="px-5 py-3 text-left text-xs font-bold text-gray-400 uppercase">#</th>

                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase">
                                    Designation
                                </th>

                                <th class="px-5 py-3 text-right text-xs font-bold text-gray-400 uppercase">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($designations as $designation)
                                <tr class="hover:bg-indigo-50/40 transition">

                                    <td class="px-5 py-3 text-sm text-gray-400">
                                        {{ $designations->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-4 py-3">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center shadow-sm">

                                                <span class="text-xs font-bold text-white">
                                                    {{ strtoupper(substr($designation->title, 0, 2)) }}
                                                </span>

                                            </div>

                                            <span class="text-sm font-semibold text-gray-900">
                                                {{ $designation->title }}
                                            </span>

                                        </div>

                                    </td>

                                    <td class="px-5 py-3">

                                        <div class="flex justify-end gap-2">

                                            <a href="{{ route('designation.show', $designation->id) }}"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-600 text-xs font-medium hover:bg-indigo-600 hover:text-white transition">

                                                View
                                            </a>

                                            <a href="{{ route('designation.edit', $designation->id) }}"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-xs font-medium hover:bg-emerald-500 hover:text-white transition">

                                                Edit
                                            </a>

                                            <form action="{{ route('designation.delete', $designation->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" onclick="return confirm('Delete this designation?')"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-500 text-xs font-medium hover:bg-red-500 hover:text-white transition">

                                                    Delete

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3" class="px-4 py-20 text-center">

                                        <p class="text-lg font-bold text-gray-700">
                                            No designations found
                                        </p>

                                        <a href="{{ route('designation.create') }}"
                                            class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700">

                                            Create Designation

                                        </a>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- Pagination --}}
            @if ($designations->hasPages())
                <div class="mt-6 flex justify-end">
                    {{ $designations->links() }}
                </div>
            @endif

        </div>
    </div>

@endsection
