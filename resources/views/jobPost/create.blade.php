@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8 px-4">
    <div class="max-w-3xl mx-auto">

        {{-- Page Title --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Create Job Post
            </h2>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-6 rounded-lg shadow">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Card --}}
        <div class="bg-white shadow-lg rounded-2xl p-6">

            <form action="{{ route('jobPost.store') }}" method="POST">
                @csrf

                {{-- Designation --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Designation
                    </label>

                    <select name="designation_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                        <option value="">Select Designation</option>
                        @foreach ($designations as $id => $title)
                            <option value="{{ $id }}"
                                {{ old('designation_id') == $id ? 'selected' : '' }}>
                                {{ $title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Description --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea name="description"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>{{ old('description') }}</textarea>
                </div>

                {{-- Location --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Location
                    </label>

                    <input type="text"
                        name="location"
                        value="{{ old('location') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                </div>

                {{-- Salary --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Salary
                    </label>

                    <input type="number"
                        name="salary"
                        value="{{ old('salary') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-3">

                    <a href="{{ route('job-posts.index') }}"
                       class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition">
                        Cancel
                    </a>

                    <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                        Create Job Post
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>
@endsection