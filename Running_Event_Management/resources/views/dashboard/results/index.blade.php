<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Kalcer Run - Results</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Oswald:wght@500;700&display=swap" rel="stylesheet"/>
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
          },
        },
      };
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .fade-in { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 font-sans h-screen flex overflow-hidden selection:bg-primary selection:text-white transition-colors duration-300">
    <aside class="w-20 lg:w-64 flex-shrink-0 bg-primary dark:bg-slate-900 flex flex-col justify-between border-r border-white/10 dark:border-gray-800 transition-all duration-300 z-20 shadow-xl">
        <div>
            <div class="h-20 flex items-center justify-center lg:justify-start lg:px-6 border-b border-white/10 dark:border-gray-800 bg-primary/10">
                <div class="flex items-center gap-3">
                    <span class="material-icons text-3xl text-white">directions_run</span>
                    <h1 class="hidden lg:block font-display font-bold text-2xl text-white tracking-wide uppercase italic">Kalcer<span class="text-accent">Run</span></h1>
                </div>
            </div>
            <nav class="mt-6 px-3 space-y-1.5 overflow-y-auto max-h-[calc(100vh-280px)] no-scrollbar">
                <a class="group flex items-center px-3 py-2.5 text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-colors" href="{{ route('dashboard') }}">
                    <span class="material-icons group-hover:text-accent transition-colors">dashboard</span>
                    <span class="hidden lg:block ml-3 font-medium text-sm">Dashboard</span>
                </a>
                <div class="hidden lg:block px-3 mt-6 mb-2 text-[10px] font-bold text-blue-200/70 uppercase tracking-widest">Management</div>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full group flex items-center px-3 py-2.5 text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-colors cursor-pointer text-left">
                        <span class="material-icons group-hover:text-accent">calendar_today</span>
                        <span class="hidden lg:block ml-3 font-semibold text-sm flex-1">Events</span>
                        <span class="hidden lg:block material-icons text-sm text-blue-300 transition-transform duration-200" :class="{'rotate-180': open}">expand_more</span>
                    </button>
                    <div x-show="open" x-collapse class="block pl-3 pr-2 py-2 space-y-1 border-l-2 border-accent/30 ml-4 lg:ml-6 my-1">
                        <a href="{{ route('dashboard.events') }}?filter=upcoming" class="block px-2 py-1.5 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded transition-colors">Upcoming</a>
                        <a href="{{ route('dashboard.events') }}?filter=past" class="block px-2 py-1.5 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded transition-colors">Past Events</a>
                        <a href="{{ route('dashboard.events') }}?filter=my_events" class="block px-2 py-1.5 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded transition-colors">My Events</a>
                    </div>
                </div>

                <div class="hidden lg:block px-3 mt-6 mb-2 text-[10px] font-bold text-blue-200/70 uppercase tracking-widest">Race Data</div>
                <a class="group flex items-center px-3 py-2.5 text-white bg-white/10 rounded-lg transition-colors shadow-inner" href="{{ route('dashboard.results') }}">
                    <span class="material-icons text-accent transition-colors">timer</span>
                    <span class="hidden lg:block ml-3 font-medium text-sm">Results & Timing</span>
                </a>
                <a class="group flex items-center px-3 py-2.5 text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-colors" href="{{ route('dashboard.leaderboards') }}">
                    <span class="material-icons group-hover:text-accent transition-colors">emoji_events</span>
                    <span class="hidden lg:block ml-3 font-medium text-sm">Leaderboards</span>
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-white/10 dark:border-gray-800 bg-black/10">
            <a class="group flex items-center px-3 py-2 mb-3 text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-colors" href="{{ route('dashboard.settings') }}">
                <span class="material-icons text-xl group-hover:text-accent transition-colors">settings</span>
                <span class="hidden lg:block ml-3 font-medium text-sm">Settings</span>
            </a>
            <div class="flex flex-col gap-3 px-1">
                 <button class="relative w-full flex items-center justify-between px-3 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-all border border-transparent hover:border-white/10 group" onclick="document.documentElement.classList.toggle('dark')">
                    <div class="flex items-center gap-2">
                        <span class="material-icons text-sm group-hover:text-yellow-300 transition-colors">light_mode</span>
                        <span class="hidden lg:block text-xs font-medium">Theme</span>
                    </div>
                </button>
            </div>
        </div>
    </aside>

    <main class="flex-1 relative flex flex-col overflow-hidden bg-gray-50 dark:bg-[#0B1120] fade-in">
        <header class="h-20 bg-white dark:bg-card-dark border-b border-gray-200 dark:border-gray-800 flex items-center justify-between px-8 z-10 shadow-sm">
            <div class="flex items-center gap-4">
                <nav class="hidden md:flex items-center text-sm font-medium text-gray-500 dark:text-gray-400">
                    <a class="hover:text-primary transition-colors" href="#">Race Data</a>
                    <span class="material-icons text-base mx-2">chevron_right</span>
                    <span class="text-gray-900 dark:text-white font-semibold">Results & Timing</span>
                </nav>
            </div>
            <div class="flex items-center gap-6">
                 <div class="flex items-center gap-3 pl-6 border-l border-gray-200 dark:border-gray-700">
                    <div class="text-right hidden md:block">
                        <div class="text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->NamaLengkap ?? 'User' }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Participant</div>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-primary to-accent p-[2px]">
                        <img alt="Profile" class="h-full w-full rounded-full object-cover border-2 border-white dark:border-card-dark" src="{{ Auth::user()->Gambar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->NamaLengkap ?? 'User') . '&background=random' }}"/>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 lg:p-10 no-scrollbar">
            <div class="max-w-7xl mx-auto space-y-8">
                <div>
                    <h1 class="text-3xl lg:text-4xl font-display font-bold uppercase italic text-gray-900 dark:text-white">
                        RESULTS <span class="text-primary">& TIMING</span>
                    </h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Analyze your race history, track personal bests, and download official certificates.
                    </p>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-card-dark p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm flex items-center gap-4">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                            <span class="material-icons text-3xl text-primary">emoji_events</span>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-gray-500 uppercase tracking-wide">Personal Best</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white flex items-baseline gap-2">
                                {{ $personalBest->TimeDisplay ?? '--:--:--' }}
                                <span class="text-xs font-normal text-gray-500">
                                    ({{ $personalBest->NamaEvent ?? 'No Data' }} - {{ $personalBest->NamaKategori ?? '' }})
                                </span>
                            </div>
                            <div class="text-xs text-green-600 font-medium mt-1">Fastest Pace: {{ $pbPaceFormatted }}/km</div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-card-dark p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm flex items-center gap-4">
                        <div class="p-3 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl">
                            <span class="material-icons text-3xl text-secondary">directions_run</span>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-gray-500 uppercase tracking-wide">Total Finished</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalRaces }} <span class="text-sm font-normal text-gray-500">Races</span></div>
                            <div class="text-xs text-gray-500 mt-1">All time history</div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-card-dark p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm flex items-center gap-4">
                        <div class="p-3 bg-rose-100 dark:bg-rose-900/30 rounded-xl">
                            <span class="material-icons text-3xl text-accent">speed</span>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-gray-500 uppercase tracking-wide">Average Pace</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $avgPace }} <span class="text-sm font-normal text-gray-500">/km</span></div>
                            <div class="text-xs text-gray-500 mt-1">Across all distances</div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-white dark:bg-card-dark p-4 rounded-xl border border-gray-200 dark:border-gray-800 flex flex-wrap gap-4 items-center justify-between">
                    <div class="relative flex-1 min-w-[200px]">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-icons text-gray-400 text-sm">search</span>
                        </span>
                        <input class="pl-9 pr-4 py-2 bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-sm w-full focus:ring-2 focus:ring-primary text-gray-900 dark:text-white placeholder-gray-500" placeholder="Search by event name..." type="text"/>
                    </div>
                    <div class="flex gap-2">
                        <select class="bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-sm text-gray-700 dark:text-gray-300 py-2 pl-3 pr-8 focus:ring-1 focus:ring-primary" onchange="window.location.href='?year='+this.value">
                            <option value="All">Year: All</option>
                            <option value="2026">2026</option>
                            <option value="2025">2025</option>
                        </select>
                        <select class="bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-sm text-gray-700 dark:text-gray-300 py-2 pl-3 pr-8 focus:ring-1 focus:ring-primary" onchange="window.location.href='?distance='+this.value">
                            <option value="All">Distance: All</option>
                            <option value="5K">5K</option>
                            <option value="10K">10K</option>
                            <option value="21K">21K</option>
                            <option value="42K">42K</option>
                        </select>
                    </div>
                </div>

                <!-- Results Table -->
                <div class="bg-white dark:bg-card-dark rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                            <thead class="bg-gray-50 dark:bg-gray-800/50 text-xs uppercase font-bold text-gray-700 dark:text-gray-300">
                                <tr>
                                    <th class="px-6 py-4">Event Name</th>
                                    <th class="px-6 py-4">Date</th>
                                    <th class="px-6 py-4">Distance</th>
                                    <th class="px-6 py-4">Official Time</th>
                                    <th class="px-6 py-4 text-center">Rank</th>
                                    <th class="px-6 py-4 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse($results as $res)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-lg bg-gray-200 overflow-hidden">
                                                <img src="{{ $res->GambarEvent ?? 'https://placehold.co/100' }}" alt="Event" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900 dark:text-white">{{ $res->NamaEvent }}</div>
                                                <div class="text-xs">{{ $res->NamaKategori }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($res->EventDate ?? $res->TanggalPendaftaran)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                            {{ $res->Jarak }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-mono font-medium text-gray-900 dark:text-white">
                                        {{ $res->WaktuFinish }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="font-bold text-gray-900 dark:text-white">#{{ $res->PeringkatUmum }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="text-gray-400 hover:text-primary transition-colors" title="View Details">
                                                <span class="material-icons text-lg">visibility</span>
                                            </button>
                                            <button class="text-gray-400 hover:text-accent transition-colors" title="Download Certificate">
                                                <span class="material-icons text-lg">workspace_premium</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                        No race results found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">
                        {{ $results->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
