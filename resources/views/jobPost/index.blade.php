@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8 px-4">
    <div class="max-w-6xl mx-auto">

      {{-- Flash Messages --}}
        @if (session('success'))
            <div id="flash-message"
                 class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative transition-opacity duration-500">
                 {{ session('success') }}
            </div>
        @endif

        @if (session('failed'))
            <div id="flash-message"
                 class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative transition-opacity duration-500">
                 {{ session('failed') }}
            </div>
        @endif  


        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <h2 class="text-2xl font-bold text-gray-800">
                Job Posts List
            </h2>
        </div>

        {{-- Search + Buttons --}}
        <div class="flex justify-between items-center flex-wrap gap-4">

            {{-- Search --}}
            <form method="GET" action="{{ route('jobPost.index') }}" class="flex gap-2">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search by designation, location..."
                       class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">

                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Search
                </button>

                @if (request('search'))
                    <a href="{{ route('jobPost.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                        Reset
                    </a>
                @endif
            </form>

            <div class="flex gap-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="bg-gray-800 text-white px-4 py-2 rounded-xl hover:bg-gray-700">
                    Back
                </a>

                <a href="{{ route('jobPost.create') }}"
                   class="bg-gray-800 text-white px-4 py-2 rounded-xl hover:bg-gray-700">
                    Create Job Post
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden mt-4">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-700">

                    {{-- Head --}}
                    <thead class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Designation</th>
                            <th class="px-6 py-4">Description</th>
                            <th class="px-6 py-4">Location</th>
                            <th class="px-6 py-4">Salary</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>

                    {{-- Body --}}
                    <tbody class="divide-y divide-gray-200">

                        @forelse($jobPosts as $job)
                        <tr class="hover:bg-gray-50 transition duration-150">

                            {{-- Serial --}}
                            <td class="px-6 py-4 font-medium">
                                {{ $jobPosts->firstItem() + $loop->index }}
                            </td>

                            {{-- Designation --}}
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                {{ $job->designation->title ?? 'N/A' }}
                            </td>

                            {{-- Description --}}
                            <td class="px-6 py-4 text-gray-600">
                                {{ Str::limit($job->description, 50) }}
                            </td>

                            {{-- Location --}}
                            <td class="px-6 py-4">
                                {{ $job->location }}
                            </td>

                            {{-- Salary --}}
                            <td class="px-6 py-4 font-semibold text-green-600">
                                ₹ {{ number_format($job->salary) }}
                            </td>

                            {{-- Toggle Status --}}
                            <td class="px-6 py-4 text-center">

                                <form action="{{ route('jobPost.toggleStatus', $job->id) }}"
                                      method="POST"
                                      class="inline-block">
                                    @csrf
                                    @method('PATCH')

                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox"
                                               class="sr-only peer"
                                               {{ $job->is_active ? 'checked' : '' }}
                                               onchange="this.form.submit()">

                                        <div class="w-11 h-6 bg-gray-300 rounded-full
                                                    peer-checked:bg-green-500
                                                    transition duration-300">
                                        </div>

                                        <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full
                                                    transition-transform duration-300
                                                    peer-checked:translate-x-5">
                                        </div>
                                    </label>
                                </form>

                                <div class="text-xs font-semibold 
                                    {{ $job->is_active ? 'text-green-600' : 'text-red-600' }}">
                                </div>

                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-3">

                                    <a href="{{ route('jobPost.edit', $job->id) }}"
                                       class="bg-yellow-500 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-yellow-600 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('jobPost.delete', $job->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this job post?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-700 transition">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                🚫 No Job Posts Found
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $jobPosts->links() }}
        </div>

    </div>
</div>
@endsection