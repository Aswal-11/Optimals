@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-8 px-4">
        <div class="max-w-6xl mx-auto">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Job Posts List
                </h2>

                {{-- <a href="{{ route('job-posts.create') }}"
               class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-200">
                + Create Job Post
            </a> --}}
            </div>

            @if (session('success'))
                <div id="flash-message" class="bg-green-500 border text-white p-3 text-center transition-opacity duration-500">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div id="flash-message" class="bg-red-500 text-white p-3 text-center transition-opacity duration-500">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Card --}}
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700">

                        {{-- Table Head --}}
                        <thead class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-6 py-4">#</th>
                                <th class="px-6 py-4">Designation</th>
                                <th class="px-6 py-4">Description</th>
                                <th class="px-6 py-4">Location</th>
                                <th class="px-6 py-4">Salary</th>
                                <th class="px-6 py-4 text-center">Action</th>
                            </tr>
                        </thead>

                        {{-- Table Body --}}
                        <tbody class="divide-y divide-gray-200">

                            @forelse($jobPosts as $job)
                                <tr class="hover:bg-gray-50 transition duration-150">

                                    <td class="px-6 py-4 font-medium">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $job->designation->title ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ Str::limit($job->description, 50) }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $job->location }}
                                    </td>

                                    <td class="px-6 py-4 font-semibold text-green-600">
                                        ₹ {{ number_format($job->salary) }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-3">

                                            {{-- Edit Button --}}
                                            <a href="{{ route('jobPost.edit', $job->id) }}"
                                                class="bg-yellow-500 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-yellow-600 transition">
                                                Edit
                                            </a>

                                            {{-- Delete Button --}}
                                            <form action="{{ route('jobPost.delete', $job->id) }}" method="POST"
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
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                        🚫 No Job Posts Found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>
@endsection
