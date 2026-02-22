@extends('layouts.app')

@section('title', 'Edit Designation')

@section('content')

    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Edit Designation</h2>

        @if (session('success'))
            <div id="flash-message" class="bg-green-500 text-white p-3 text-center transition-opacity duration-500">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="flash-message" class="bg-red-500 text-white p-3 text-center transition-opacity duration-500">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('designation.update', $designation->id) }}" method="POST">
            @csrf
            @method('PATCH')

            {{-- Title --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium">Title</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2"
                    value="{{ old('title', $designation->title) }}">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $designation->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Skills --}}
            <div class="mb-4">
                <label class="block mb-1">Skills</label>

                <select name="skill_id[]" multiple class="w-full border rounded px-3 py-2">
                    @foreach ($skills as $id => $name)
                        <option value="{{ $id }}"
                            {{ in_array($id, old('skill_id', $designation->skills->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @error('skill_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update
            </button>
        </form>
    </div>

@endsection
