<header>
    <nav class="surface shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo and Brand --}}
                <div class="flex items-center space-x-3">
                    <div class="shrink-0">
                        <div
                            class="h-8 w-8 bg-linear-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="text-3xl font-bold bg-linear-to-r from-gray-800 to-gray-600 bg-clip-text">
                        OIU
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
