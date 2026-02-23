@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8">

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Designation Details
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-6">

                <div>
                    <p class="text-gray-500">Name</p>
                    <p class="text-lg font-semibold">{{ $designation->title }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Description</p>
                    <p class="text-lg font-semibold">{{ $designation->description }}</p>
                </div>

                {{-- Skills --}}
                <div class="col-span-2">
                    <p class="text-gray-500 mb-2">Skills</p>

                    <div class="flex flex-wrap gap-2">
                        @forelse ($designation?->skills ?? [] as $skill)
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                {{ $skill->name }}
                            </span>
                        @empty
                            <p class="text-gray-400">No Skills Assigned</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
