<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin - @yield('title', 'Console')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#2563EB", // Royal Blue
                        secondary: "#F97316", // Orange accent for 'kalcer' vibe
                        "background-light": "#F3F4F6",
                        "background-dark": "#111827",
                        "surface-light": "#FFFFFF",
                        "surface-dark": "#1F2937",
                        "text-light": "#1F2937",
                        "text-dark": "#F9FAFB",
                        "border-light": "#E5E7EB",
                        "border-dark": "#374151",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                        body: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }.scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark antialiased transition-colors duration-200">
<div class="flex h-screen overflow-hidden">
    <aside class="w-64 flex-shrink-0 bg-primary flex flex-col transition-all duration-300 shadow-xl z-20">
        <div class="h-16 flex items-center px-6 bg-blue-700 dark:bg-blue-800 shadow-sm">
            <span class="material-icons-outlined text-white mr-2 text-2xl">directions_run</span>
            <span class="text-white font-bold text-lg tracking-wide">LariKalcer</span>
        </div>
        <nav class="flex-1 overflow-y-auto py-4 scrollbar-hide">
            <div class="px-4 mb-2">
                <a class="flex items-center px-4 py-3 bg-blue-700 rounded-lg text-white group transition-colors shadow-inner" href="{{ route('admin.dashboard') }}">
                    <span class="material-icons-outlined mr-3">dashboard</span>
                    <span class="font-medium">Dashboard</span>
                </a>
            </div>
            <div class="px-6 mt-6 mb-2">
                <p class="text-xs font-semibold text-blue-200 uppercase tracking-wider">Management</p>
            </div>
            <div class="space-y-1 px-4">
                <a class="flex items-center px-4 py-2 text-blue-100 hover:bg-blue-600 rounded-lg transition-colors group" href="#">
                    <span class="material-icons-outlined mr-3 group-hover:text-white">calendar_today</span>
                    <span class="font-medium group-hover:text-white">Events</span>
                </a>
                <a class="flex items-center px-4 py-2 text-blue-100 hover:bg-blue-600 rounded-lg transition-colors group" href="#">
                    <span class="material-icons-outlined mr-3 group-hover:text-white">people</span>
                    <span class="font-medium group-hover:text-white">Participants</span>
                </a>
                <a class="flex items-center px-4 py-2 text-blue-100 hover:bg-blue-600 rounded-lg transition-colors group" href="#">
                    <span class="material-icons-outlined mr-3 group-hover:text-white">inventory_2</span>
                    <span class="font-medium group-hover:text-white">Race Packs</span>
                </a>
            </div>
            <div class="px-6 mt-6 mb-2">
                <p class="text-xs font-semibold text-blue-200 uppercase tracking-wider">System</p>
            </div>
            <div class="space-y-1 px-4 mb-6">
                 <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center px-4 py-2 text-blue-100 hover:bg-blue-600 rounded-lg transition-colors group">
                        <span class="material-icons-outlined mr-3 group-hover:text-white">logout</span>
                        <span class="font-medium group-hover:text-white">Logout</span>
                    </button>
                </form>
            </div>
        </nav>
        <div class="p-4 bg-blue-800 dark:bg-blue-900 border-t border-blue-700">
            <div class="flex items-center gap-3">
                <img alt="Admin Profile" class="h-9 w-9 rounded-full object-cover border-2 border-white/20" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsHs2q3lClUURierS_-TvCdRralRrHeyjZQXgngJfR-_lDrsoTGEza7D1ifF2lCEA1Y5n8HcfnoIevwc_vapY-SiDUpX1K-PJJRigS0n8Qi58n54kMZJ9G9XGjLajvPs6I8ShAGI_N2o7qQvkKrYE4pzqiK9r5euDDpD4joWZ7TPKhC2G4Lt8J8zPpCaX5MCzAtCznlcxj_K-Nkp_nQFSHFq1KTga8drhRvu2_pRxBMaiqRZjuy7uaxHAVm7KEOCbOHZlNSjOk04o"/>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">Admin Panitia</p>
                    <p class="text-xs text-blue-200 truncate">Super Admin</p>
                </div>
            </div>
        </div>
    </aside>
    <main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-background-light dark:bg-background-dark">
        <header class="h-16 bg-surface-light dark:bg-surface-dark border-b border-border-light dark:border-border-dark flex items-center justify-between px-6 shadow-sm z-10">
            <div class="flex items-center gap-4">
                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">@yield('header', 'Dashboard Overview')</h1>
            </div>
            <div class="flex items-center gap-4">
                <button class="p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 transition-colors focus:outline-none" onclick="document.documentElement.classList.toggle('dark')">
                    <span class="material-icons-outlined block dark:hidden">dark_mode</span>
                    <span class="material-icons-outlined hidden dark:block">light_mode</span>
                </button>
                <button class="relative p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 transition-colors">
                    <span class="material-icons-outlined">notifications</span>
                    <span class="absolute top-1 right-1 h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white dark:ring-gray-800"></span>
                </button>
            </div>
        </header>
        <div class="flex-1 overflow-auto p-6 md:p-8">
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
