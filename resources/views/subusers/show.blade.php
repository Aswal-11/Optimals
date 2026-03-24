@extends('layouts.admin')

@section('title', 'Subuser Profile')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 20c0-3.314 2.686-6 6-6s6 2.686 6 6"/>
        </svg>
        <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('subusers.index') }}" class="hover:text-gray-700 transition-colors">Subusers</a>
        <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-900">Profile</span>
    </div>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">

        {{-- Profile Card --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

            {{-- Banner --}}
            <div class="h-24 bg-gradient-to-r from-violet-600 to-indigo-600"></div>

            {{-- Avatar + Name --}}
            <div class="px-6 pb-6">
                <div class="-mt-10 mb-4 flex items-end justify-between">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center shadow-lg border-4 border-white flex-shrink-0">
                        <span class="text-2xl font-extrabold text-white">{{ strtoupper(substr($subuser->name, 0, 2)) }}</span>
                    </div>
                    <a href="{{ route('subusers.edit', $subuser->id) }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-50 text-emerald-600 text-sm font-semibold hover:bg-emerald-500 hover:text-white transition-all duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                </div>

                <h1 class="text-2xl font-extrabold text-gray-900">{{ $subuser->name }}</h1>
                <p class="text-sm text-gray-400 mt-0.5">{{ $subuser->email }}</p>

                {{-- Role Badge --}}
                <div class="mt-3">
                    @if($subuser->role)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-50 text-indigo-700 text-sm font-semibold">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            {{ $subuser->role->name }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1.5 rounded-xl bg-gray-100 text-gray-500 text-sm font-medium">
                            No Role Assigned
                        </span>
                    @endif
                </div>
            </div>

            {{-- Details --}}
            <div class="border-t border-gray-100 px-6 py-5">
                <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Account Details</h2>
                <dl class="space-y-3">
                    <div class="flex items-center justify-between">
                        <dt class="text-sm font-semibold text-gray-500">Full Name</dt>
                        <dd class="text-sm text-gray-900 font-medium">{{ $subuser->name }}</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-sm font-semibold text-gray-500">Email Address</dt>
                        <dd class="text-sm text-gray-900 font-medium">{{ $subuser->email }}</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-sm font-semibold text-gray-500">Assigned Role</dt>
                        <dd class="text-sm text-gray-900 font-medium">{{ $subuser->role?->name ?? '—' }}</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-sm font-semibold text-gray-500">Created</dt>
                        <dd class="text-sm text-gray-900 font-medium">{{ $subuser->created_at->format('d M Y') }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Footer Actions --}}
            <div class="border-t border-gray-100 px-6 py-4 bg-gray-50 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('subusers.index') }}"
                   class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-700 hover:bg-gray-900 hover:text-white hover:border-gray-900 transition-all duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Subusers
                </a>
                <form action="{{ route('subusers.destroy', $subuser->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Delete {{ $subuser->name }}? This cannot be undone.')"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-red-50 text-red-500 text-sm font-medium hover:bg-red-500 hover:text-white transition-all duration-150 cursor-pointer border-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete Subuser
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection