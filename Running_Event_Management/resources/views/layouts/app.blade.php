<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>LariKalcer - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#1d4ed8", // Using a strong blue similar to sidebar highlight
                        "sidebar-bg": "#1e3a8a", // Dark blue from reference
                        "sidebar-hover": "#2563eb",
                        "background-light": "#f3f4f6",
                        "background-dark": "#111827",
                        "card-light": "#ffffff",
                        "card-dark": "#1f2937",
                        "text-light": "#1f2937",
                        "text-dark": "#f9fafb",
                        "muted-light": "#6b7280",
                        "muted-dark": "#9ca3af",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                        sans: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        'xl': "1rem",
                        '2xl': "1.5rem",
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark min-h-screen flex transition-colors duration-200">
    <aside class="w-64 bg-sidebar-bg text-white flex-shrink-0 hidden md:flex flex-col h-screen fixed left-0 top-0 overflow-y-auto z-10 shadow-xl">
        <div class="p-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight italic">Lari<span class="text-yellow-400">Kalcer</span></h1>
        </div>
        <nav class="flex-1 px-4 space-y-2 py-4">
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-sidebar-hover/80 text-white' : 'text-blue-100 hover:bg-sidebar-hover/50 hover:text-white' }} rounded-lg shadow-sm transition-colors group"
                href="{{ route('dashboard') }}">
                <span class="material-icons-outlined text-xl">dashboard</span>
                <span class="font-medium text-sm">Dashboard</span>
            </a>
            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-blue-200 uppercase tracking-wider">Management</p>
            </div>
            <a class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('events.*') ? 'bg-sidebar-hover/80 text-white' : 'text-blue-100 hover:bg-sidebar-hover/50 hover:text-white' }} rounded-lg transition-colors group"
                href="{{ route('events.register') }}">
                <span class="material-icons-outlined text-xl group-hover:scale-110 transition-transform">calendar_today</span>
                <span class="font-medium text-sm">Events</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-2.5 text-blue-100 hover:bg-sidebar-hover/50 hover:text-white rounded-lg transition-colors group"
                href="#">
                <span class="material-icons-outlined text-xl group-hover:scale-110 transition-transform">groups</span>
                <span class="font-medium text-sm">Participants</span>
            </a>
            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-blue-200 uppercase tracking-wider">Race Data</p>
            </div>
            <a class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('history') ? 'bg-sidebar-hover/80 text-white' : 'text-blue-100 hover:bg-sidebar-hover/50 hover:text-white' }} rounded-lg transition-colors group"
                href="{{ route('history') }}">
                <span class="material-icons-outlined text-xl group-hover:scale-110 transition-transform">timer</span>
                <span class="font-medium text-sm">Results &amp; History</span>
            </a>
            <!-- Added Logout for functionality -->
            <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-blue-100 hover:bg-sidebar-hover/50 hover:text-white rounded-lg transition-colors group">
                    <span class="material-icons-outlined text-xl">logout</span>
                    <span class="font-medium text-sm">Logout</span>
                </button>
            </form>
        </nav>
        <div class="p-4 border-t border-blue-800">
            <div class="flex items-center gap-3">
                <img alt="User Profile" class="w-10 h-10 rounded-full border-2 border-blue-400"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfncrwZZFqdQCCufJfp-nrjbxj62ZflSjNPh8GYgShbkPpto9A92HICmNjs5RTsy15z3LbDL2yPY53htupuw2EYZtPJ9D_R3haFs9PMIueU2BVEF8qibNlleYiG51gQqy71sWrDU6jrS_MeUbR0vfyeHIAtISziyty8rgdDdYb54cSgaRIKDJCfACAwUWWK1CcIOnAsls4UR75EmMXSCFWJeF2xfgKygWWnW909RRP8KWwdQsnd4rdF_PNwODFcdwFKeZoE0tNksk" />
                <div class="flex flex-col">
                    <span class="text-sm font-semibold text-white">Budi Santoso</span>
                    <span class="text-xs text-blue-300">Organizer</span>
                </div>
            </div>
        </div>
    </aside>
    <main class="flex-1 md:ml-64 p-4 md:p-8 overflow-y-auto">
        <div class="md:hidden flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold italic text-sidebar-bg dark:text-blue-400">Lari<span
                    class="text-yellow-500">Kalcer</span></h1>
            <button class="p-2 text-text-light dark:text-text-dark">
                <span class="material-icons-outlined">menu</span>
            </button>
        </div>
        
        @yield('content')

    </main>
</body>
</html>
