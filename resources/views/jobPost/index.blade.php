@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">

                <div>
                    <p class="text-xs font-bold tracking-widest uppercase text-indigo-600 mb-1">
                        Recruitment
                    </p>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                        Job Posts
                    </h1>
                    <p class="mt-1.5 text-sm text-gray-500">
                        Manage and publish job openings
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-900 hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('jobPost.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-medium shadow-sm hover:bg-indigo-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Create Job Post
                    </a>

                </div>
            </div>

            {{-- Toolbar --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm px-5 py-4 mb-5">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                    <form method="GET" action="{{ route('jobPost.index') }}"
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 flex-1">

                        <div class="relative flex-1 max-w-md">

                            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search designation or location..."
                                class="w-full pl-10 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-xlfocus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />

                        </div>

                        <div class="flex gap-2">

                            <button type="submit"
                                class="px-5 py-2.5 bg-gray-900 text-white text-sm font-medium rounded-xl hover:bg-indigo-600 transition">
                                Search
                            </button>

                            @if (request('search'))
                                <a href="{{ route('jobPost.index') }}"
                                    class="px-5 py-2.5 bg-white border border-gray-200 text-gray-600 text-sm font-medium rounded-xl hover:text-red-500">
                                    Clear
                                </a>
                            @endif

                        </div>

                    </form>

                    <div class="text-sm text-gray-500">
                        Total:
                        <span class="font-semibold text-gray-900">
                            {{ $jobPosts->total() }}
                        </span>
                        jobs
                    </div>

                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[800px]">

                        <thead>

                            <tr class="bg-gray-900">

                                <th class="px-5 py-3 text-left text-xs font-bold text-gray-400 uppercase">#</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase">Designation</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase">Description</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase">Location</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase">Salary</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-400 uppercase">Status</th>
                                <th class="px-5 py-3 text-right text-xs font-bold text-gray-400 uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($jobPosts as $job)
                                <tr class="hover:bg-indigo-50/40 transition">

                                    <td class="px-5 py-3 text-sm text-gray-400">
                                        {{ $jobPosts->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-4 py-3 text-sm font-semibold text-gray-900">
                                        {{ $job->designation->title ?? 'N/A' }}
                                    </td>

                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ Str::limit($job->description, 50) }}
                                    </td>

                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ $job->location }}
                                    </td>

                                    <td class="px-4 py-3 font-bold text-emerald-600">
                                        ₹{{ number_format($job->salary) }}
                                    </td>

                                    <td class="px-4 py-3 text-center">

                                        <form action="{{ route('jobPost.toggleStatus', $job->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <label class="relative inline-flex items-center cursor-pointer">

                                                <input type="checkbox" class="sr-only peer"
                                                    {{ $job->is_active ? 'checked' : '' }} onchange="this.form.submit()">

                                                <div
                                                    class="w-11 h-6 bg-gray-300 rounded-full peer-checked:bg-green-500 transition">
                                                </div>

                                                <div
                                                    class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full peer-checked:translate-x-5 transition">
                                                </div>

                                            </label>

                                        </form>

                                    </td>

                                    <td class="px-5 py-3">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('jobPost.edit', $job->id) }}"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-xs font-medium hover:bg-emerald-500 hover:text-white transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('jobPost.delete', $job->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this job post?')">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-500 text-xs font-medium hover:bg-red-500 hover:text-white transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-20 text-center">
                                        <p class="text-lg font-bold text-gray-700">
                                            No job posts found
                                        </p>
                                        <a href="{{ route('jobPost.create') }}"
                                            class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700">
                                            Create Job Post
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Pagination --}}
            @if ($jobPosts->hasPages())
                <div class="mt-6 flex justify-end">
                    {{ $jobPosts->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
