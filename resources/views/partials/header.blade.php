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
                    <h1 class="text-3xl font-bold bg-linear-to-r from-gray-800 to-gray-600 bg-clip-text">
                        OIU
                    </h1>
                </div>

                {{-- User Menu, Theme Switch and Logout --}}
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">Welcome back,</p>
                            <p class="text-xs text-gray-500">{{ $userRole ?? 'Guest' }}</p>
                        </div>
                        <div
                            class="h-10 px-3 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center text-white font-semibold">
                            {{ $adminName }}
                        </div>
                    </div>

                    {{-- Theme toggle --}}
                    <button id="theme-toggle"
                        type="button"
                        class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                    </button>

                    @if(!empty($logoutRoute))
                        <form action="{{ route($logoutRoute) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>
