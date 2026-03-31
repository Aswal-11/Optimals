<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&display=swap');

        .admin-core-ui *, .admin-core-ui *::before, .admin-core-ui *::after,
        .dashboard-specific *, .dashboard-specific *::before, .dashboard-specific *::after {
            box-sizing: border-box; margin: 0; padding: 0;
        }

        :root {
            --background:      #ffffff;
            --foreground:      #09090b;
            --card:            #ffffff;
            --muted:           #f4f4f5;
            --muted-fg:        #71717a;
            --border:          #e4e4e7;
            --input:           #e4e4e7;
            --primary:         #18181b;
            --primary-fg:      #fafafa;
            --secondary:       #f4f4f5;
            --secondary-fg:    #18181b;
            --accent:          #f4f4f5;
            --accent-fg:       #18181b;
            --radius:          0.5rem;
            --sidebar-w:       240px;
            --header-h:        57px;
        }

        body {
            font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: var(--foreground);
            background: var(--background);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Layout ── */
        .app-shell { display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            flex-shrink: 0;
            border-right: 1px solid var(--border);
            background: var(--background);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 40;
        }

        .sidebar-header {
            height: var(--header-h);
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 16px;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }

        .sidebar-logo {
            width: 28px; height: 28px;
            border-radius: 8px;
            background: var(--primary);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .sidebar-brand-name {
            font-size: 28px;
            font-weight: 600;
            color: var(--foreground);
            letter-spacing: -.01em;
            line-height: 1.2;
        }

        .sidebar-brand-sub {
            font-size: 11px;
            font-weight: 400;
            color: var(--muted-fg);
        }

        .sidebar-content { flex: 1; overflow-y: auto; padding: 8px 0; }

        .nav-group-label {
            padding: 8px 16px 4px;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--muted-fg);
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 12px;
            margin: 1px 8px;
            border-radius: calc(var(--radius) - 2px);
            font-size: 13px;
            font-weight: 500;
            color: var(--muted-fg);
            text-decoration: none;
            transition: background .12s, color .12s;
            width: calc(100% - 16px);
        }

        .nav-item:hover { background: var(--accent); color: var(--accent-fg); }
        .nav-item.active { background: var(--secondary); color: var(--foreground); }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; opacity: .7; }
        .nav-item.active svg { opacity: 1; }

        .nav-badge {
            margin-left: auto;
            font-size: 11px;
            font-weight: 600;
            padding: 1px 6px;
            border-radius: 9999px;
            background: var(--secondary);
            color: var(--secondary-fg);
            border: 1px solid var(--border);
        }

        .nav-sep { height: 1px; background: var(--border); margin: 8px 0; }

        .sidebar-footer { padding: 12px 8px; border-top: 1px solid var(--border); }

        .user-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 10px;
            border-radius: calc(var(--radius) - 2px);
            cursor: pointer;
            transition: background .12s;
        }

        .user-row:hover { background: var(--accent); }

        .user-avatar {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: var(--muted);
            display: flex; align-items: center; justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: var(--muted-fg);
            flex-shrink: 0;
            border: 1px solid var(--border);
        }

        .user-name { font-size: 13px; font-weight: 500; color: var(--foreground); }
        .user-email { font-size: 11px; color: var(--muted-fg); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 140px; }

        /* ── Main ── */
        .main-area {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Topbar ── */
        .topbar {
            height: var(--header-h);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            background: var(--background);
            position: sticky;
            top: 0;
            z-index: 30;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--muted-fg);
        }

        .breadcrumb span { color: var(--foreground); font-weight: 500; }

        .topbar-right { display: flex; align-items: center; gap: 8px; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: var(--radius);
            font-size: 13px;
            font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            transition: background .12s, border-color .12s, opacity .12s;
            text-decoration: none;
            border: 1px solid transparent;
            line-height: 1;
            white-space: nowrap;
        }

        .btn svg { width: 14px; height: 14px; }

        .btn-default { background: var(--primary); color: var(--primary-fg); border-color: var(--primary); }
        .btn-default:hover { opacity: .88; }

        .btn-outline { background: transparent; color: var(--foreground); border-color: var(--input); }
        .btn-outline:hover { background: var(--accent); }

        .btn-ghost { background: transparent; color: var(--muted-fg); border-color: transparent; }
        .btn-ghost:hover { background: var(--accent); color: var(--accent-fg); }

        .icon-btn {
            width: 34px; height: 34px;
            border-radius: var(--radius);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            background: transparent;
            border: none;
            color: var(--muted-fg);
            transition: background .12s, color .12s;
        }

        .icon-btn:hover { background: var(--accent); color: var(--foreground); }
        .icon-btn svg { width: 16px; height: 16px; }

        /* ── Content ── */
        .page-content { flex: 1; }

        .page-title { font-size: 22px; font-weight: 700; color: var(--foreground); letter-spacing: -.025em; }
        .page-desc { margin-top: 4px; font-size: 13px; color: var(--muted-fg); }

        /* ── Card primitives ── */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .card-title { font-size: 14px; font-weight: 600; color: var(--foreground); line-height: 1; }
        .card-desc { font-size: 12px; color: var(--muted-fg); margin-top: 3px; }
        .card-content { padding: 0 20px 20px; }
        .sep { height: 1px; background: var(--border); }

        /* ── Badges ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 500;
            padding: 2px 8px;
            border-radius: 9999px;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .badge-secondary { background: var(--secondary); color: var(--secondary-fg); border-color: var(--border); }
        .badge-success   { background: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
        .badge-warning   { background: #fffbeb; color: #b45309; border-color: #fde68a; }
        .badge-info      { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }

        /* ── Flash ── */
        #flash-message {
            position: fixed;
            top: 16px; right: 16px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 12px 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,.08), 0 1px 3px rgba(0,0,0,.05);
            max-width: 360px;
            animation: slideIn .3s cubic-bezier(.16,1,.3,1);
        }

        @keyframes slideIn {
            from { opacity:0; transform: translateX(16px); }
            to   { opacity:1; transform: translateX(0); }
        }

        /* ── Fade-up ── */
        .fu { animation: fadeUp .3s ease both; }
        .fu:nth-child(1){animation-delay:.04s}
        .fu:nth-child(2){animation-delay:.08s}
        .fu:nth-child(3){animation-delay:.12s}
        .fu:nth-child(4){animation-delay:.16s}

        @keyframes fadeUp {
            from { opacity:0; transform:translateY(8px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* ── Responsive Sidebar ── */
        @media (max-width: 960px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 4px 0 24px rgba(0,0,0,0.05);
            }
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            .sidebar-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.4);
                z-index: 39;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.3s ease;
                backdrop-filter: blur(2px);
            }
            .sidebar-overlay.active {
                opacity: 1;
                pointer-events: auto;
            }
            .main-area {
                margin-left: 0 !important;
            }
            .mobile-toggle {
                display: flex !important;
            }
        }
        @media (min-width: 961px) {
            .sidebar-overlay { display: none !important; }
            .mobile-toggle { display: none !important; }
        }

    </style>
    @stack('styles')
</head>
<body>
    <div class="app-shell">

        {{-- ── SIDEBAR OVERLAY ── --}}
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

        {{-- ── SIDEBAR ── --}}
        <aside class="sidebar admin-core-ui">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <svg width="14" height="14" fill="none" stroke="#fafafa" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                    </svg>
                </div>
                <div>
                    <div class="sidebar-brand-name">OIU</div>
                </div>
            </div>

            <div class="sidebar-content">
                <div class="nav-group-label">Overview</div>

                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <div class="nav-sep"></div>
                <div class="nav-group-label">Manage</div>

                @can('viewAny', \App\Models\Employee::class)
                <a href="{{ route('employee.index') }}" class="nav-item {{ request()->routeIs('employee.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Employees
                </a>
                @endcan

                @can('viewAny', \App\Models\JobPost::class)
                <a href="{{ route('jobPost.index') }}" class="nav-item {{ request()->routeIs('jobPost.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Job Posts
                </a>
                @endcan

                @can('viewAny', \App\Models\Designation::class)
                <a href="{{ route('designation.index') }}" class="nav-item {{ request()->routeIs('designation.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a3 3 0 01-3-3V6a3 3 0 013-3z"/>
                    </svg>
                    Designations
                </a>
                @endcan

                @can('viewAny', \App\Models\Skill::class)
                <a href="{{ route('skill.create') }}" class="nav-item {{ request()->routeIs('skill.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    Skills
                </a>
                @endcan

                @can('viewAny', \App\Models\Role::class)
                <a href="{{ route('roles.index') }}" class="nav-item {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" stroke-linecap="round" stroke-linejoin="round" />
                        <path stroke-linecap="round" stroke-linejoin="round"  d="M6 20c0-3.314 2.686-6 6-6s6 2.686 6 6" /> 
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 10l4 2v4c0 2.5-1.5 4.5-4 5-2.5-.5-4-2.5-4-5v-4l4-2z" />
                    </svg>
                    Roles
                </a>
                @endcan

                @can('viewAny', \App\Models\SubUser::class)
                <a href="{{ route('subusers.index') }}" class="nav-item {{ request()->routeIs('subusers.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" stroke-linecap="round" stroke-linejoin="round" />
                        <path stroke-linecap="round" stroke-linejoin="round"  d="M6 20c0-3.314 2.686-6 6-6s6 2.686 6 6" /> 
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 10l4 2v4c0 2.5-1.5 4.5-4 5-2.5-.5-4-2.5-4-5v-4l4-2z" />
                    </svg>
                    Subusers
                </a>
                @endcan
            </div>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST" class="hidden" id="logout-form-sidebar">
                    @csrf
                </form>
                <div class="user-row" onclick="document.getElementById('logout-form-sidebar').submit();">
                    <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</div>
                    <div style="flex:1;min-width:0;">
                        <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="user-email" style="color: #ef4444; font-weight: 500;">Click to Logout</div>
                    </div>
                    <svg width="14" height="14" fill="none" stroke="#ef4444" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </div>
            </div>
        </aside>

        {{-- ── MAIN ── --}}
        <div class="main-area">

            {{-- Topbar --}}
            <header class="topbar admin-core-ui">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <button class="icon-btn mobile-toggle" style="display: none;" onclick="toggleSidebar()">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div class="breadcrumb">
                        @yield('breadcrumb')
                    </div>
                </div>
                <div class="topbar-right">
                    @yield('topbar-actions')
                    
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0;">
                        @csrf
                        <button type="submit" class="btn btn-outline" style="border-color:#fca5a5; color:#dc2626; margin-left:10px;">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Flash --}}
            @if(session('success'))
            <div id="flash-message">
                <div style="width:20px;height:20px;border-radius:50%;background:#f0fdf4;border:1px solid #bbf7d0;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <svg width="10" height="10" fill="none" stroke="#16a34a" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <p style="font-size:13px;color:var(--foreground);flex:1;font-weight:500;">{{ session('success') }}</p>
                <button onclick="this.closest('#flash-message').remove()" style="background:none;border:none;cursor:pointer;color:var(--muted-fg);display:flex;padding:0">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            @endif

            {{-- Content --}}
            <main class="page-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const f = document.getElementById('flash-message');
            if (f) {
                f.style.transition = 'opacity .3s, transform .3s';
                f.style.opacity = '0';
                f.style.transform = 'translateX(16px)';
                setTimeout(() => f.remove(), 300);
            }
        }, 4000);

        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('mobile-open');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        }
    </script>
    @stack('scripts')
</body>
</html>
