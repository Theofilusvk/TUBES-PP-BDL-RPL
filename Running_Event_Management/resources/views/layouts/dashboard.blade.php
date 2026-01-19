<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Kalcer Run - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;family=Oswald:wght@500;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#2563EB", 
              secondary: "#10B981", 
              accent: "#F43F5E",
              "background-light": "#F3F4F6",
              "background-dark": "#111827",
              "card-light": "#FFFFFF",
              "card-dark": "#1F2937",
            },
            fontFamily: {
              sans: ["Inter", "sans-serif"],
              display: ["Oswald", "sans-serif"],
            },
            backgroundImage: {
               'hero-pattern': "url('https://images.unsplash.com/photo-1552674605-46f538316d43?q=80&w=2076&auto=format&fit=crop')",
            }
          },
        },
      };
    </script>
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        /* Dark mode scrollbar */
        .dark ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #4b5563;
        }
        .dark ::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 font-sans h-screen flex overflow-hidden selection:bg-primary selection:text-white transition-colors duration-300" x-data="{ sidebarOpen: false }">

    <!-- Mobile Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 bg-black/50 z-20 lg:hidden"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 w-64 bg-primary dark:bg-slate-900 flex flex-col justify-between border-r border-white/10 dark:border-gray-800 transition-transform duration-300 z-30 shadow-xl lg:static lg:translate-x-0">
        <div>
            <div class="h-20 flex items-center justify-center lg:justify-start lg:px-6 border-b border-white/10 dark:border-gray-800 bg-primary/10">
                <div class="flex items-center gap-3">
                    <span class="material-icons text-3xl text-white">directions_run</span>
                    <h1 class="font-display font-bold text-2xl text-white tracking-wide uppercase italic">Kalcer<span class="text-accent">Run</span></h1>
                </div>
            </div>
            <nav class="mt-6 px-3 space-y-1.5 overflow-y-auto max-h-[calc(100vh-280px)]">
                <a class="group flex items-center px-3 py-2.5 text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white shadow-inner' : '' }}" href="{{ route('dashboard') }}">
                    <span class="material-icons group-hover:text-accent transition-colors">dashboard</span>
                    <span class="ml-3 font-medium text-sm">Dashboard</span>
                </a>
        
                <div class="px-3 mt-6 mb-2 text-[10px] font-bold text-blue-200/70 uppercase tracking-widest">Management</div>
                
                <div class="relative" x-data="{ open: {{ request()->routeIs('dashboard.events*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" class="w-full group flex items-center px-3 py-2.5 text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-colors cursor-pointer text-left" :class="{'bg-white/10 text-white shadow-inner': open}">
                        <span class="material-icons text-accent">calendar_today</span>
                        <span class="ml-3 font-semibold text-sm flex-1">Events</span>
                        <span class="material-icons text-sm text-blue-300 transition-transform duration-200" :class="{'rotate-180': open}">expand_more</span>
                    </button>
                    <div x-show="open" x-collapse class="block pl-3 pr-2 py-2 space-y-1 border-l-2 border-accent/30 ml-4 lg:ml-6 my-1">
                        <a href="{{ route('dashboard.events', ['filter' => 'upcoming']) }}" class="block px-2 py-1.5 text-sm {{ request()->fullUrlIs('*filter=upcoming*') ? 'text-white bg-accent/20 rounded font-medium' : 'text-blue-200 hover:text-white hover:bg-white/5 rounded transition-colors' }}">
                            Upcoming
                        </a>
                        <a href="{{ route('dashboard.events', ['filter' => 'past']) }}" class="block px-2 py-1.5 text-sm {{ request()->fullUrlIs('*filter=past*') ? 'text-white bg-accent/20 rounded font-medium' : 'text-blue-200 hover:text-white hover:bg-white/5 rounded transition-colors' }}">
                            Past Events
                        </a>
                        <a href="{{ route('dashboard.events', ['filter' => 'my_events']) }}" class="block px-2 py-1.5 text-sm {{ request()->fullUrlIs('*filter=my_events*') ? 'text-white bg-accent/20 rounded font-medium' : 'text-blue-200 hover:text-white hover:bg-white/5 rounded transition-colors' }}">
                            My Events
                        </a>
                    </div>
                </div>

                <div class="px-3 mt-6 mb-2 text-[10px] font-bold text-blue-200/70 uppercase tracking-widest">Race Data</div>
                <a class="group flex items-center px-3 py-2.5 text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-colors {{ request()->routeIs('dashboard.results') ? 'bg-white/10 text-white shadow-inner' : '' }}" href="{{ route('dashboard.results') }}">
                    <span class="material-icons group-hover:text-accent transition-colors">timer</span>
                    <span class="ml-3 font-medium text-sm">Results &amp; Timing</span>
                </a>
                <a class="group flex items-center px-3 py-2.5 text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-colors {{ request()->routeIs('dashboard.leaderboards') ? 'bg-white/10 text-white shadow-inner' : '' }}" href="{{ route('dashboard.leaderboards') }}">
                    <span class="material-icons group-hover:text-accent transition-colors">emoji_events</span>
                    <span class="ml-3 font-medium text-sm">Leaderboards</span>
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-white/10 dark:border-gray-800 bg-black/10">
            <a class="group flex items-center px-3 py-2 mb-3 text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-colors {{ request()->routeIs('dashboard.settings') ? 'bg-white/10 text-white shadow-inner' : '' }}" href="{{ route('dashboard.settings') }}">
                <span class="material-icons text-xl group-hover:text-accent transition-colors">settings</span>
                <span class="ml-3 font-medium text-sm">Settings</span>
            </a>
            
            <!-- User Info (Visible on Mobile Sidebar too) -->
             <div class="flex items-center gap-3 px-3 py-2 border-t border-white/10 pt-4 mt-2">
                <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-primary to-accent p-[1px]">
                     <img alt="Profile" class="h-full w-full rounded-full object-cover" src="{{ Auth::user()->Gambar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->NamaLengkap ?? 'User') . '&background=random' }}"/>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-bold text-white truncate">{{ Auth::user()->NamaLengkap ?? 'User' }}</div>
                    <div class="text-xs text-blue-200 truncate">{{ Auth::user()->Email }}</div>
                </div>
                 <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-blue-300 hover:text-white">
                        <span class="material-icons text-sm">logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 relative flex flex-col overflow-hidden bg-gray-50 dark:bg-[#0B1120] fade-in">
        <header class="h-20 bg-white dark:bg-card-dark border-b border-gray-200 dark:border-gray-800 flex items-center justify-between px-4 lg:px-8 z-10 shadow-sm shrink-0">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-primary">
                    <span class="material-icons">menu</span>
                </button>
                <nav class="hidden md:flex items-center text-sm font-medium text-gray-500 dark:text-gray-400">
                    <a class="hover:text-primary transition-colors" href="{{ route('dashboard') }}">Dashboard</a>
                    <span class="material-icons text-base mx-2">chevron_right</span>
                    <span class="text-gray-900 dark:text-white font-semibold">@yield('header_title', 'Events Hub')</span>
                </nav>
                 <!-- Mobile Title if Breadcrumb hidden -->
                 <span class="md:hidden text-gray-900 dark:text-white font-bold font-display uppercase italic text-lg">Kalcer<span class="text-accent">Run</span></span>
            </div>
            
            <div class="flex items-center gap-4">
                 <!-- Theme Toggle -->
                <button class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all text-gray-600 dark:text-gray-300" onclick="document.documentElement.classList.toggle('dark')">
                    <span class="material-icons text-xl">light_mode</span>
                </button>
            </div>
        </header>
        
        <!-- Content Area -->
        <div class="flex-1 overflow-y-auto p-4 lg:p-10" id="main-content">
            <!-- Alerts -->
            @if(session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 border border-green-200 dark:border-green-800 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="material-icons text-sm">check_circle</span>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700 dark:hover:text-green-200">
                    <span class="material-icons text-sm">close</span>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 p-4 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-800 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="material-icons text-sm">error</span>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 dark:hover:text-red-200">
                    <span class="material-icons text-sm">close</span>
                </button>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-4 p-4 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-800">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-icons text-sm">warning</span>
                    <span class="text-sm font-bold">Please correct the following errors:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1 ml-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

             @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
