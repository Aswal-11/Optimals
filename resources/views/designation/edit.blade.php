@extends('layouts.app')

@section('title', 'Edit Designation')

@section('content')

    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="w-full max-w-lg bg-white p-8 rounded-2xl shadow-lg">

            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                Edit Designation
            </h2>

            {{-- Flash Messages --}}
            @if (session('success'))
                <div id="flash-message"
                    class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative transition-opacity duration-500">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div id="flash-message"
                    class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative transition-opacity duration-500">
                    {{ session('error') }}
                </div>
            @endif

            <form class="space-y-5">
                @csrf
                @method('PATCH')

                {{-- Designation Dropdown --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Designation
                    </label>

                    <select name="designation_id"
                        class="w-full border rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-blue-400 focus:outline-none @error('designation_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Select Designation --</option>

                        @foreach ($designations as $id => $title)
                            <option value="{{ $id }}"
                                {{ old('designation_id', $jobPost->designation_id ?? '') == $id ? 'selected' : '' }}>
                                {{ $title }}
                            </option>
                        @endforeach
                    </select>

                    @error('designation_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Description
                    </label>
                    <textarea name="description" rows="4"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none @error('description') border-red-500 @enderror"
                        placeholder="Enter description" required>{{ old('description', $designation->description) }}</textarea>

                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Skills --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Skills
                    </label>

                    <select name="skill_id[]" multiple
                        class="w-full border rounded-lg px-4 py-2 h-32 focus:ring-2 focus:ring-blue-400 focus:outline-none @error('skill_id') border-red-500 @enderror">
                        @foreach ($skills as $id => $name)
                            <option value="{{ $id }}"
                                {{ in_array($id, old('skill_id', $designation->skills->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>

                    <p class="text-xs text-gray-500 mt-1">
                        Hold Ctrl (Windows) / Command (Mac) to select multiple skills
                    </p>

                    @error('skill_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex gap-4 pt-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        Update
                    </button>

                    <a href="{{ route('designation.index') }}"
                        class="flex-1 bg-gray-500 text-white py-2.5 rounded-lg font-semibold hover:bg-gray-600 transition duration-200 text-center">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

@endsection
