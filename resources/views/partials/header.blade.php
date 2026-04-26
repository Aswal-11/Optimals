<header>
    <nav class="surface shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo and Brand --}}
                <div class="flex items-center space-x-3">
                    <div class="shrink-0">
                        <div
                            class="h-8 w-8 bg-linear-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <x-icons.sparkles class="h-5 w-5 text-white" />
                        </div>
                    </div>
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-3xl font-bold bg-linear-to-r from-gray-800 to-gray-600 bg-clip-text">
                        OIU
                    </a>
                </div>
                <div>
                    @if (Auth::guard('web')->check() || Auth::guard('subuser')->check())
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Logout
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>


    </nav>
</header>
