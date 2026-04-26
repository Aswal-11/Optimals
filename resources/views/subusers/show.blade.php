@extends('layouts.admin')

@section('title', 'Subuser Profile')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
        <x-icons.user class="w-4 h-4 text-gray-400" />
        <x-icons.chevron-right class="w-3 h-3 text-gray-300" />
        <a href="{{ route('subusers.index') }}" class="hover:text-gray-700 transition-colors">Subusers</a>
        <x-icons.chevron-right class="w-3 h-3 text-gray-300" />
        <span class="text-gray-900">Profile</span>
    </div>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">

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
                        <x-icons.edit class="w-4 h-4" />
                        Edit
                    </a>
                </div>

                <h1 class="text-2xl font-extrabold text-gray-900">{{ $subuser->name }}</h1>
                <p class="text-sm text-gray-400 mt-0.5">{{ $subuser->email }}</p>

                {{-- Role Badge --}}
                <div class="mt-3">
                    @if($subuser->role)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-50 text-indigo-700 text-sm font-semibold">
                            <x-icons.shield-check class="w-3.5 h-3.5" />
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
                    <x-icons.arrow-left class="w-4 h-4" />
                    Back to Subusers
                </a>
                <form action="{{ route('subusers.destroy', $subuser->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Delete {{ $subuser->name }}? This cannot be undone.')"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-red-50 text-red-500 text-sm font-medium hover:bg-red-500 hover:text-white transition-all duration-150 cursor-pointer border-0">
                        <x-icons.trash class="w-4 h-4" />
                        Delete Subuser
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection