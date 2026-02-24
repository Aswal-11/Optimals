@extends('layouts.app')

@section('title', 'Create Designation')

@section('content')

    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Create Designation</h2>

        <form action="{{ route('designation.store') }}" method="POST">
            @csrf

            {{-- Title --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium">Title</label>
                <input type="text" name="title"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                    value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Skills --}}
            <div class="mb-4">
                <label class="block mb-1">Skills</label>

                <select name="skill_id[]" multiple class="w-full border rounded px-3 py-2">

                    @foreach ($skills as $id => $name)
                        <option value="{{ $id }}" {{ collect(old('skill_id'))->contains($id) ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach

                </select>

                @error('skill_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Submit
                </button>
                <a href="{{ route('designation.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Back
                </a>
            </div>
        </form>
    </div>
@endsection
