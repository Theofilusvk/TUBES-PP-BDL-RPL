<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Kalcer Run - Participants Management</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;family=Oswald:wght@500;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#2563EB", // Vibrant Royal Blue
              secondary: "#10B981", // Emerald green
              accent: "#F43F5E", // Rose/Neon red
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
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .dark .glass-effect {
            background: rgba(31, 41, 55, 0.95);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 font-sans h-screen flex overflow-hidden selection:bg-primary selection:text-white transition-colors duration-300">
<aside class="w-20 lg:w-64 flex-shrink-0 bg-primary dark:bg-slate-900 flex flex-col justify-between border-r border-white/10 dark:border-gray-800 transition-all duration-300 z-30 shadow-xl">
<div>
<div class="h-20 flex items-center justify-center lg:justify-start lg:px-6 border-b border-white/10 dark:border-gray-800">
<div class="flex items-center gap-3">
<span class="material-icons text-3xl text-white">directions_run</span>
<h1 class="hidden lg:block font-display font-bold text-2xl text-white tracking-wide uppercase italic">Kalcer<span class="text-accent">Run</span></h1>
</div>
</div>
<nav class="mt-8 px-2 space-y-2">
<a class="group flex items-center px-3 py-3 text-blue-100 hover:bg-white/10 hover:text-white rounded-lg transition-colors" href="{{ route('dashboard') }}">
<span class="material-icons group-hover:text-accent">dashboard</span>
<span class="hidden lg:block ml-3 font-medium">Dashboard</span>
</a>
<div class="hidden lg:block px-3 mt-6 mb-2 text-xs font-semibold text-blue-200 uppercase tracking-wider">Management</div>
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="w-full group flex items-center px-3 py-3 text-blue-100 hover:bg-white/5 hover:text-white rounded-lg transition-colors cursor-pointer text-left">
        <span class="material-icons group-hover:text-accent">calendar_today</span>
        <span class="hidden lg:block ml-3 font-medium flex-1">Events</span>
        <span class="hidden lg:block material-icons text-sm text-blue-300 transition-transform duration-200" :class="{'rotate-180': open}">expand_more</span>
    </button>
    <div x-show="open" x-collapse class="pl-4 space-y-1 mt-1 bg-black/10 rounded-lg p-2" style="display: none;">
        <a href="{{ route('dashboard.events') }}?filter=upcoming" class="flex items-center px-3 py-2 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded-md transition-colors">
             <span class="w-1.5 h-1.5 bg-green-400 rounded-full mr-2"></span> Upcoming
        </a>
        <a href="{{ route('dashboard.events') }}?filter=past" class="flex items-center px-3 py-2 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded-md transition-colors">
             <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-2"></span> Past Events
        </a>
    </div>
</div>
<a class="group flex items-center px-3 py-3 text-white bg-white/20 shadow-inner rounded-lg transition-colors relative" href="{{ route('dashboard.participants') }}">
<div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-accent rounded-r-md"></div>
<span class="material-icons text-accent">groups</span>
<span class="hidden lg:block ml-3 font-medium">Participants</span>
</a>
<div class="hidden lg:block px-3 mt-6 mb-2 text-xs font-semibold text-blue-200 uppercase tracking-wider">Race Data</div>
<a class="group flex items-center px-3 py-3 text-blue-100 hover:bg-white/5 hover:text-white rounded-lg transition-colors" href="{{ route('dashboard.results') }}">
<span class="material-icons group-hover:text-accent">timer</span>
<span class="hidden lg:block ml-3 font-medium">Results &amp; Timing</span>
</a>
<a class="group flex items-center px-3 py-3 text-blue-100 hover:bg-white/5 hover:text-white rounded-lg transition-colors" href="{{ route('dashboard.leaderboards') }}">
<span class="material-icons group-hover:text-accent">emoji_events</span>
<span class="hidden lg:block ml-3 font-medium">Leaderboards</span>
</a>
</nav>
</div>
<div class="p-4 border-t border-white/10 dark:border-gray-800">
<a class="group flex items-center px-3 py-3 text-blue-100 hover:bg-white/5 hover:text-white rounded-lg transition-colors" href="{{ route('dashboard.settings') }}">
<span class="material-icons group-hover:text-accent">settings</span>
<span class="hidden lg:block ml-3 font-medium">Settings</span>
</a>
<div class="mt-4 flex flex-col gap-3 px-1">
<button class="w-full flex items-center justify-center lg:justify-between gap-2 px-3 py-2 bg-black/20 hover:bg-black/30 text-white rounded-lg transition-all border border-white/5" onclick="document.documentElement.classList.toggle('dark')">
<div class="flex items-center gap-2">
<span class="material-icons text-sm">dark_mode</span>
<span class="hidden lg:block text-xs font-medium">Dark Mode</span>
</div>
</button>
</div>
</div>
</aside>
<main class="flex-1 relative flex flex-col overflow-y-auto bg-gray-50 dark:bg-gray-900">
<header class="sticky top-0 z-20 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex items-center justify-between">
<div class="flex items-center gap-4">
<button class="lg:hidden text-gray-500 hover:text-primary">
<span class="material-icons">menu</span>
</button>
<h2 class="text-xl font-display font-bold text-gray-800 dark:text-white uppercase tracking-tight">Participants <span class="text-primary hidden sm:inline-block">Directory</span></h2>
</div>
<div class="flex items-center gap-4">
<button class="p-2 text-gray-400 hover:text-primary transition-colors relative">
<span class="material-icons">notifications</span>
<span class="absolute top-1.5 right-1.5 w-2 h-2 bg-accent rounded-full border-2 border-white dark:border-gray-800"></span>
</button>
<div class="h-8 w-px bg-gray-200 dark:bg-gray-700"></div>
<div class="flex items-center gap-3">
<div class="text-right hidden sm:block">
    <div class="text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->NamaLengkap ?? 'User' }}</div>
    <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->PeranID == 1 ? 'Administrator' : 'Organizer' }}</div>
</div>
<img alt="{{ Auth::user()->NamaLengkap }}" class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-700 shadow-sm object-cover" src="{{ Auth::user()->Gambar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->NamaLengkap ?? 'User') . '&background=random' }}"/>
</div>
</div>
</header>
<div class="p-6 lg:p-8 max-w-7xl mx-auto w-full space-y-6">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
<div class="bg-white dark:bg-card-dark p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
<div>
<p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Total Registered</p>
<h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($totalParticipants) }}</h3>
</div>
<div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-primary">
<span class="material-icons">groups</span>
</div>
</div>
<div class="bg-white dark:bg-card-dark p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
<div>
<p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Pending Verification</p>
<h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($pendingVerifications) }}</h3>
</div>
<div class="p-3 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg text-yellow-600">
<span class="material-icons">pending_actions</span>
</div>
</div>
<div class="bg-white dark:bg-card-dark p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
<div>
<p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Total KM Logged</p>
<h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($totalDistance, 2) }} km</h3>
</div>
<div class="p-3 bg-green-50 dark:bg-green-900/30 rounded-lg text-secondary">
<span class="material-icons">timeline</span>
</div>
</div>
<div class="bg-white dark:bg-card-dark p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
<div>
<p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Clubs Active</p>
<h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $activeClubs }}</h3>
</div>
<div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg text-purple-600">
<span class="material-icons">flag</span>
</div>
</div>
</div>
<div class="bg-white dark:bg-card-dark rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
<div class="flex flex-col lg:flex-row gap-4 justify-between items-start lg:items-center">
<div class="w-full lg:w-96 relative">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-icons text-gray-400">search</span>
</div>
<input class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg leading-5 bg-gray-50 dark:bg-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out" placeholder="Search by name, bib, or email..." type="text"/>
</div>
<div class="flex flex-wrap gap-3 w-full lg:w-auto">
<select class="form-select block w-full sm:w-auto pl-3 pr-10 py-2.5 text-base border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-lg dark:bg-gray-800 dark:text-gray-200">
<option>All Events</option>
<option>Jakarta Marathon 2023</option>
<option>Bali Trail Run</option>
<option>Bandung 10K</option>
</select>
<select class="form-select block w-full sm:w-auto pl-3 pr-10 py-2.5 text-base border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-lg dark:bg-gray-800 dark:text-gray-200">
<option>All Genders</option>
<option>Male</option>
<option>Female</option>
</select>
<select class="form-select block w-full sm:w-auto pl-3 pr-10 py-2.5 text-base border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-lg dark:bg-gray-800 dark:text-gray-200">
<option>Age Group</option>
<option>18-24</option>
<option>25-34</option>
<option>35-44</option>
<option>45+</option>
</select>
<button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
<span class="material-icons text-sm mr-2">filter_list</span> Apply
                    </button>
</div>
</div>
</div>
<div class="bg-white dark:bg-card-dark rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
<div class="overflow-x-auto">
<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
<thead class="bg-gray-50 dark:bg-gray-800">
<tr>
<th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider" scope="col">Participant</th>
<th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider" scope="col">Bib Number</th>
<th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider" scope="col">Club / Community</th>
<th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider" scope="col">Total KM</th>
<th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider" scope="col">Status</th>
<th class="px-6 py-4 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider" scope="col">Action</th>
</tr>
</thead>
<tbody class="bg-white dark:bg-card-dark divide-y divide-gray-200 dark:divide-gray-700">
    @forelse($participants as $participant)
    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors group">
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                    <img alt="" class="h-10 w-10 rounded-full object-cover border border-gray-200 dark:border-gray-600" src="https://ui-avatars.com/api/?name={{ urlencode($participant->NamaLengkap) }}&background=random"/>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-primary transition-colors">{{ $participant->NamaLengkap }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $participant->Email }}</div>
                </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-mono border border-gray-200 dark:border-gray-600">
                #{{ $participant->PenggunaID + 1000 }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900 dark:text-gray-200 font-medium">Free Runner</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Independent</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white font-bold">
            {{ number_format($participant->totalDistance->TotalDistance ?? 0, 1) }} km
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
               <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5 self-center"></span> Verified
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <span class="text-gray-400 cursor-not-allowed px-3 py-1.5 rounded-md text-xs font-bold border border-gray-100 dark:border-gray-800">
                View Details
            </span>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400">
            No participants found.
        </td>
    </tr>
    @endforelse
</tbody>
<div class="flex-shrink-0 h-10 w-10">
<img alt="" class="h-10 w-10 rounded-full object-cover border border-gray-200 dark:border-gray-600" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDKQvit478D_hajB59S50uaPMPCYztYtn8jkZJrJ71PXYteFkNOFYC9nzQyXGey31bTAbn25rAedXbwEgc59MjaeAFjie1PEiKbBseuANshzBGxCQrOxMkt2cmtl8sd9jdBSSHwP3RfXLcXYklEDAHwkGQ7NhwORr8VkAe4LCPCZSZjl6RnlVkPJNUw9i8zQXDsZVbuyMDTf--Mv-rVCBYFYOQAelSnkZ288wO95ER5Wc-5tmZLgPD3_Tqxcp4dIRoZVTaLQFBS6FQ"/>
</div>
<div class="ml-4">
<div class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-primary transition-colors">Siti Aminah</div>
<div class="text-xs text-gray-500 dark:text-gray-400">siti.aminah@kalcer.id</div>
</div>
</div>
</td>
<td class="px-6 py-4 whitespace-nowrap">
<span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-mono border border-gray-200 dark:border-gray-600">
                                    1025
                                </span>
</td>
<td class="px-6 py-4 whitespace-nowrap">
<div class="text-sm text-gray-900 dark:text-gray-200 font-medium">Free Runners</div>
<div class="text-xs text-gray-500 dark:text-gray-400">Community</div>
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white font-bold">
                                21.1 km
                            </td>
<td class="px-6 py-4 whitespace-nowrap">
<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
<span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5 self-center animate-pulse"></span> Pending
                                </span>
</td>
<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
<a href="{{ route('dashboard.participants.show', 2) }}" class="text-primary hover:text-blue-900 dark:hover:text-blue-400 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/40 px-3 py-1.5 rounded-md text-xs font-bold transition-all border border-blue-200 dark:border-blue-800">
                                    View Details
                                </a>
</td>
</tr>
</tbody>
</table>
</div>
<div class="bg-white dark:bg-card-dark px-4 py-3 flex items-center justify-between border-t border-gray-200 dark:border-gray-700 sm:px-6">
<div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
<div>
<p class="text-sm text-gray-700 dark:text-gray-300">
                            Showing
                            <span class="font-medium text-primary">1</span>
                            to
                            <span class="font-medium text-primary">10</span>
                            of
                            <span class="font-medium text-primary">1,248</span>
                            results
                        </p>
</div>
<div>
<nav aria-label="Pagination" class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
<a class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-700" href="#">
<span class="sr-only">Previous</span>
<span class="material-icons text-sm">chevron_left</span>
</a>
<a aria-current="page" class="z-10 bg-primary border-primary text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="#">
                                1
                            </a>
<a class="bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="#">
                                2
                            </a>
<a class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-700" href="#">
<span class="sr-only">Next</span>
<span class="material-icons text-sm">chevron_right</span>
</a>
</nav>
</div>
</div>
</div>
</div>
</div>
</main>
</body></html>
