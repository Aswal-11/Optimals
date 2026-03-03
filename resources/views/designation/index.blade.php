@extends('layouts.app')

@section('title', 'Designation List')

@section('content')

    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">

        {{-- Flash Messages --}}
        @if (session('success'))
            <div id="flash-message" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative transition-opacity duration-500">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="flash-message" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative transition-opacity duration-500">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Designation List</h2>
        </div>

        <div class="flex justify-between items-center ">
            <form method="GET" action="{{ route('designation.index') }}" class="mb-4">
                <div class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by title"
                        class="border px-4 py-2 rounded w-72 focus:outline-none focus:ring">

                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Search
                    </button>

                    @if (request('search'))
                        <a href="{{ route('designation.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Clear
                        </a>
                    @endif
                </div>
            </form>

            <div class="flex gap-4">
                <a href="/admin/dashboard" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Back
                </a>
                <a class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700"
                    href="{{ route('designation.create') }}">Create designation</a>
            </div>

        </div>

        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-900 text-white">
                    <th class="border p-2 text-left">#</th>
                    <th class="border p-2 text-left">Title</th>
                    <th class="border p-2 text-left">View</th>
                    <th class="border p-2 text-center">Edit</th>
                    <th class="border p-2 text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($designations as $designation)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-2">
                            {{ $designations->firstItem() + $loop->index }}
                        </td>

                        <td class="border p-2">
                            {{ $designation->title }}
                        </td>

                        <td class="p-2 border">
                            <a href="{{ route('designation.show', $designation->id) }}"
                                class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">
                                View
                            </a>
                        </td>

                        {{-- Edit --}}
                        <td class="border p-2 text-center space-x-2">
                            <a href="{{ route('designation.edit', $designation->id) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
                                Edit
                            </a>
                        </td>

                        {{-- Delete --}}
                        <td class="border p-2 text-center space-x-2">
                            <form action="{{ route('designation.delete', $designation->id) }}" method="POST"
                                class="inline-block" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border p-4 text-center text-gray-500">
                            No designations found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $designations->links() }}
        </div>

    </div>

    <script>
        // Auto-fade flash messages after 5 seconds
        const flashMessages = document.querySelectorAll('#flash-message');
        if (flashMessages.length > 0) {
            setTimeout(() => {
                flashMessages.forEach(message => {
                    message.style.opacity = '0';
                });
            }, 5000);
        }
    </script>

@endsection
