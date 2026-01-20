<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Admin Central | Pelari Kalcer')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&amp;family=Plus+Jakarta+Sans:wght@200..800&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#00ff80", // Default Neon Green (can be overridden)
                        "background-light": "#fafafa",
                        "background-dark": "#121416",
                        "surface-dark": "#1c1f23",
                        "border-dark": "#2d3239",
                        "accent-cyan": "#00f0ff",
                        "secondary": "#FF00FF",
                        "card-dark": "#0d1117",
                        "sidebar-dark": "#080a0f",
                        "accent-neon": "#00ff80", // Alias for primary in some files
                    },
                    fontFamily: {
                        "display": ["Space Grotesk", "sans-serif"],
                        "sans": ["Plus Jakarta Sans", "sans-serif"],
                        "mono": ["JetBrains Mono", "monospace"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                },
            },
        }
    </script>
    <style>
        .sidebar-item-active {
            background: linear-gradient(90deg, rgba(0, 255, 128, 0.15) 0%, rgba(0, 255, 128, 0) 100%);
            border-left: 3px solid #00ff80;
        }
        .kalcer-grid {
            background-image: radial-gradient(#2d3239 1px, transparent 1px);
            background-size: 32px 32px;
        }
         /* Additional styles from User Management */
        .neon-glow-primary {
            box-shadow: 0 0 15px rgba(0, 255, 128, 0.15);
        }
        .neon-text-primary {
            text-shadow: 0 0 8px rgba(0, 255, 128, 0.4);
        }
        .neon-text-cyan {
            text-shadow: 0 0 8px rgba(0, 240, 255, 0.4);
        }
        .active-nav-indicator {
            position: relative;
        }
        .active-nav-indicator::before {
            content: '';
            position: absolute;
            left: -1rem;
            top: 20%;
            bottom: 20%;
            width: 4px;
            background: #00ff80;
            border-radius: 0 4px 4px 0;
            box-shadow: 0 0 10px #00ff80;
        }
         ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #05070a;
        }
        ::-webkit-scrollbar-thumb {
            background: #1f2937;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #00ff80;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-800 dark:text-slate-200 transition-colors duration-200 selection:bg-primary selection:text-background-dark">
<div class="flex h-screen overflow-hidden kalcer-grid">
    <!-- Sidebar -->
    <aside class="w-72 bg-background-light dark:bg-background-dark border-r border-slate-200 dark:border-border-dark flex flex-col z-20">
        <div class="p-6 border-b border-slate-200 dark:border-border-dark flex items-center gap-3">
            <div class="w-10 h-10 bg-primary flex items-center justify-center rounded-sm shadow-[0_0_15px_rgba(0,255,128,0.3)]">
                <span class="material-symbols-outlined text-background-dark font-bold">bolt</span>
            </div>
            <div>
                <h1 class="text-lg font-bold tracking-tighter text-slate-900 dark:text-white uppercase leading-none">Admin Central</h1>
                <p class="text-[10px] uppercase tracking-[0.2em] text-primary font-bold">Pelari Kalcer</p>
            </div>
        </div>
        <nav class="flex-1 py-6">
            <div class="space-y-1">
                <a class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-item-active' : '' }} flex items-center gap-4 px-6 py-3 group transition-all" href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 group-hover:text-primary' }} group-hover:scale-110 transition-transform">dashboard</span>
                    <span class="text-sm font-semibold {{ request()->routeIs('admin.dashboard') ? 'text-slate-900 dark:text-white' : 'text-slate-500 dark:text-slate-400' }} uppercase tracking-wider">Dashboard</span>
                </a>
                <a class="{{ request()->routeIs('admin.users') ? 'sidebar-item-active' : '' }} flex items-center gap-4 px-6 py-3 group transition-all" href="{{ route('admin.users') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.users') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 group-hover:text-primary' }} group-hover:scale-110 transition-transform">group</span>
                    <span class="text-sm font-semibold {{ request()->routeIs('admin.users') ? 'text-slate-900 dark:text-white' : 'text-slate-500 dark:text-slate-400' }} uppercase tracking-wider">User Management</span>
                </a>
                <a class="{{ request()->routeIs('admin.events') ? 'sidebar-item-active' : '' }} flex items-center gap-4 px-6 py-3 group transition-all" href="{{ route('admin.events') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.events') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 group-hover:text-primary' }} group-hover:scale-110 transition-transform">event_seat</span>
                    <span class="text-sm font-semibold {{ request()->routeIs('admin.events') ? 'text-slate-900 dark:text-white' : 'text-slate-500 dark:text-slate-400' }} uppercase tracking-wider">Event Configuration</span>
                </a>
               <a class="{{ request()->routeIs('admin.financial') ? 'sidebar-item-active' : '' }} flex items-center gap-4 px-6 py-3 group transition-all" href="{{ route('admin.financial') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.financial') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 group-hover:text-primary' }} group-hover:scale-110 transition-transform">account_balance_wallet</span>
                    <span class="text-sm font-semibold {{ request()->routeIs('admin.financial') ? 'text-slate-900 dark:text-white' : 'text-slate-500 dark:text-slate-400' }} uppercase tracking-wider">Financial Reports</span>
                </a>
                <a class="{{ request()->routeIs('admin.triggers') ? 'sidebar-item-active' : '' }} flex items-center gap-4 px-6 py-3 group transition-all" href="{{ route('admin.triggers') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.triggers') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 group-hover:text-primary' }} group-hover:scale-110 transition-transform">database</span>
                    <span class="text-sm font-semibold {{ request()->routeIs('admin.triggers') ? 'text-slate-900 dark:text-white' : 'text-slate-500 dark:text-slate-400' }} uppercase tracking-wider">Database Triggers</span>
                </a>
            </div>
        </nav>
        <div class="p-6 mt-auto border-t border-slate-200 dark:border-border-dark">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full border-2 border-primary overflow-hidden shadow-[0_0_10px_rgba(0,255,128,0.2)]">
                    <img class="w-full h-full object-cover" data-alt="Admin profile avatar" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCNKmw_zERdI-sZRx4B8jm2zDp_aZY7pNF-8yrsVpp1eoMoCziqMr2rYfTbSk-xhHFlR4fWbnAsLGS77tymdSvbziAyZb2Ioe5AQglORCZEdwOem4S9tpP3MolZ-iCDNSVGISgggnF3L2AVioBBjJ_xmGlQXXIW_z1GBtnEKmxGRGCDNGUJ3SMEUWhhXslQyY0-mSEqOmROSV2LVwLroqxXL1AW5RLHdrOsOWmvapI3T8Hm9v4mGWE4vQw44qyF0qn1iH5hSvieGX0"/>
                </div>
                <div>
                     <!-- Dynamic User Info -->
                    <p class="text-sm font-bold text-slate-900 dark:text-white">{{ Auth::user()->NamaLengkap ?? 'Admin' }}</p>
                    <p class="text-xs text-slate-500">{{ Auth::user()->Email ?? 'Email' }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-4 rounded bg-slate-100 dark:bg-surface-dark border border-slate-200 dark:border-border-dark text-slate-600 dark:text-slate-400 hover:text-primary hover:border-primary transition-colors">
                    <span class="material-symbols-outlined text-sm">logout</span>
                    <span class="text-xs font-bold uppercase tracking-widest">Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-y-auto">
         <!-- Common Header could go here if uniform across all pages, otherwise yield it -->
         @yield('content')
    </main>
</div>
@stack('scripts')
</body>
</html>
