<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Admin Central') | Pelari Kalcer</title>
    
    <!-- Tailwind & Fonts -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;family=JetBrains+Mono:wght@400;500&amp;family=Space+Grotesk:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#00ff80", // Neon Green
                        "accent-neon": "#39FF14",
                        "accent-cyan": "#00f0ff",
                        "secondary": "#FF00FF",
                        "background-light": "#fafafa",
                        "background-dark": "#0a0a0a", // Unified dark bg
                        "card-dark": "#121212",
                        "surface-dark": "#1c1f23",
                        "border-dark": "#2d3239",
                        "sidebar-dark": "#080a0f"
                    },
                    fontFamily: {
                        "display": ["Space Grotesk", "sans-serif"],
                        "sans": ["Plus Jakarta Sans", "sans-serif"],
                        "mono": ["JetBrains Mono", "monospace"]
                    }
                },
            },
        }
    </script>

    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    @stack('styles')
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-800 dark:text-slate-200 transition-colors duration-200 selection:bg-primary selection:text-background-dark">

<div class="flex h-screen overflow-hidden kalcer-grid">
    <!-- Sidebar -->
    <aside class="w-72 bg-background-light dark:bg-sidebar-dark border-r border-slate-200 dark:border-border-dark flex flex-col z-20 shrink-0">
        <div class="p-6 border-b border-slate-200 dark:border-border-dark flex items-center gap-3">
            <div class="w-10 h-10 bg-primary flex items-center justify-center rounded-sm shadow-[0_0_15px_rgba(0,255,128,0.3)]">
                <span class="material-symbols-outlined text-background-dark font-bold">bolt</span>
            </div>
            <div>
                <h1 class="text-lg font-bold tracking-tighter text-slate-900 dark:text-white uppercase leading-none">Admin Central</h1>
                <p class="text-[10px] uppercase tracking-[0.2em] text-primary font-bold">Pelari Kalcer</p>
            </div>
        </div>
        
        <nav class="flex-1 py-6 px-4 space-y-1">
            <a class="flex items-center gap-4 px-6 py-3 group transition-all rounded-lg {{ request()->routeIs('admin.dashboard') ? 'sidebar-item-active' : 'text-slate-500 hover:text-primary' }}" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.dashboard') ? 'text-primary' : '' }} group-hover:scale-110 transition-transform">dashboard</span>
                <span class="text-sm font-semibold uppercase tracking-wider">Dashboard</span>
            </a>
            
            <a class="flex items-center gap-4 px-6 py-3 group transition-all rounded-lg {{ request()->routeIs('admin.users*') ? 'sidebar-item-active' : 'text-slate-500 hover:text-primary' }}" href="#">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">group</span>
                <span class="text-sm font-semibold uppercase tracking-wider">User Management</span>
            </a>
            
            <a class="flex items-center gap-4 px-6 py-3 group transition-all rounded-lg {{ request()->routeIs('admin.events*') ? 'sidebar-item-active' : 'text-slate-500 hover:text-primary' }}" href="#">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">event_seat</span>
                <span class="text-sm font-semibold uppercase tracking-wider">Event Config</span>
            </a>
            
            <a class="flex items-center gap-4 px-6 py-3 group transition-all rounded-lg {{ request()->routeIs('admin.financial*') ? 'sidebar-item-active' : 'text-slate-500 hover:text-primary' }}" href="#">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">account_balance_wallet</span>
                <span class="text-sm font-semibold uppercase tracking-wider">Financial Reports</span>
            </a>
            
            <a class="flex items-center gap-4 px-6 py-3 group transition-all rounded-lg {{ request()->routeIs('admin.triggers*') ? 'sidebar-item-active' : 'text-slate-500 hover:text-primary' }}" href="#">
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">database</span>
                <span class="text-sm font-semibold uppercase tracking-wider">DB Triggers</span>
            </a>
        </nav>

        <div class="p-6 mt-auto border-t border-slate-200 dark:border-border-dark">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full border-2 border-primary overflow-hidden shadow-[0_0_10px_rgba(0,255,128,0.2)]">
                    <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCNKmw_zERdI-sZRx4B8jm2zDp_aZY7pNF-8yrsVpp1eoMoCziqMr2rYfTbSk-xhHFlR4fWbnAsLGS77tymdSvbziAyZb2Ioe5AQglORCZEdwOem4S9tpP3MolZ-iCDNSVGISgggnF3L2AVioBBjJ_xmGlQXXIW_z1GBtnEKmxGRGCDNGUJ3SMEUWhhXslQyY0-mSEqOmROSV2LVwLroqxXL1AW5RLHdrOsOWmvapI3T8Hm9v4mGWE4vQw44qyF0qn1iH5hSvieGX0" alt="Admin"/>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ Auth::user()->NamaLengkap ?? 'Admin' }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ Auth::user()->Email ?? '' }}</p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-4 rounded bg-slate-100 dark:bg-surface-dark border border-slate-200 dark:border-border-dark text-slate-600 dark:text-slate-400 hover:text-primary hover:border-primary transition-colors">
                    <span class="material-symbols-outlined text-sm">logout</span>
                    <span class="text-xs font-bold uppercase tracking-widest">Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-y-auto min-w-0">
        <!-- Topbar -->
        <header class="h-20 flex items-center justify-between px-10 border-b border-slate-200 dark:border-border-dark bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md sticky top-0 z-10 shrink-0">
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-primary uppercase tracking-[0.3em] shadow-primary drop-shadow-sm">System Status:</span>
                <div class="flex items-center gap-1.5">
                    <div class="w-2 h-2 rounded-full bg-primary animate-pulse shadow-[0_0_8px_#00ff80]"></div>
                    <span class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">Nominal</span>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <!-- Lang Switcher -->
                <div class="flex p-1 bg-slate-100 dark:bg-surface-dark border border-slate-200 dark:border-border-dark rounded-sm">
                    <button class="px-3 py-1 text-[10px] font-bold tracking-tighter bg-primary text-background-dark rounded-sm">ID</button>
                    <button class="px-3 py-1 text-[10px] font-bold tracking-tighter text-slate-500 hover:text-primary transition-colors">EN</button>
                </div>
                <!-- Controls -->
                <div class="flex items-center gap-4">
                    <button class="p-2 text-slate-500 hover:text-primary transition-colors relative">
                        <span class="material-symbols-outlined">notifications</span>
                        <span class="absolute top-2 right-2 w-1.5 h-1.5 bg-primary rounded-full shadow-[0_0_5px_#00ff80]"></span>
                    </button>
                    <button class="p-2 text-slate-500 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined">settings</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-1">
            @yield('content')
        </div>
        
        <!-- Footer (Optional) -->
        <div class="px-10 py-6 border-t border-slate-200 dark:border-border-dark opacity-50 flex justify-between items-center text-[10px] uppercase font-bold tracking-widest text-slate-500 mt-auto">
             <span>Pelari Kalcer Admin v2.4</span>
             <span>{{ now()->format('Y-m-d H:i:s') }}</span>
        </div>
    </main>
</div>

@stack('scripts')
</body>
</html>
