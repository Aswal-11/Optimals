@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 py-10 px-4">
    <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-2xl p-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
            Edit Job Post
        </h2>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc pl-5 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('jobPost.update', $jobPost->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            {{-- Designation --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Designation
                </label>

                <select 
                    name="designation_id"
                    class="w-full border rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required
                >
                    <option value="">Select Designation</option>

                    @foreach ($designations as $id => $title)
                        <option value="{{ $id }}"
                            {{ old('designation_id', $jobPost->designation_id) == $id ? 'selected' : '' }}>
                            {{ $title }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Description
                </label>

                <textarea 
                    name="description"
                    rows="4"
                    class="w-full border rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required
                >{{ old('description', $jobPost->description) }}</textarea>
            </div>

            {{-- Location --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Location
                </label>

                <input 
                    type="text"
                    name="location"
                    value="{{ old('location', $jobPost->location) }}"
                    class="w-full border rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required
                >
            </div>

            {{-- Salary --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Salary
                </label>

                <div class="relative">
                    <span class="absolute left-4 top-2.5 text-gray-500">₹</span>
                    <input 
                        type="number"
                        name="salary"
                        value="{{ old('salary', $jobPost->salary) }}"
                        class="w-full border rounded-xl pl-8 pr-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required
                    >
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-4 pt-4">
                <button 
                    type="submit"
                    class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition shadow-md"
                >
                    Update Job Post
                </button>

                <a 
                    href="{{ route('jobPost.index') }}"
                    class="flex-1 bg-gray-500 text-white py-3 rounded-xl font-semibold hover:bg-gray-600 transition text-center shadow-md"
                >
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection