<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Kalcer Run - Community Leaderboards</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
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
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head><body class="bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 font-sans h-screen flex overflow-hidden selection:bg-primary selection:text-white transition-colors duration-300">
<aside class="w-20 lg:w-64 flex-shrink-0 bg-primary dark:bg-slate-900 flex flex-col justify-between border-r border-white/10 dark:border-gray-800 transition-all duration-300 z-20 shadow-xl">
<div class="flex flex-col h-full">
<div class="h-16 lg:h-20 flex items-center justify-center lg:justify-start lg:px-6 border-b border-white/10 dark:border-gray-800 shrink-0">
<div class="flex items-center gap-3">
<span class="material-icons text-3xl text-white">directions_run</span>
<h1 class="hidden lg:block font-display font-bold text-2xl text-white tracking-wide uppercase italic">Kalcer<span class="text-accent">Run</span></h1>
</div>
</div>
<nav class="flex-1 overflow-y-auto mt-4 px-2 space-y-1 no-scrollbar pb-4">
<a class="group flex items-center px-3 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-lg transition-colors" href="{{ route('dashboard') }}">
<span class="material-icons group-hover:text-accent text-xl">dashboard</span>
<span class="hidden lg:block ml-3 font-medium text-sm">Dashboard</span>
</a>
<div class="hidden lg:block px-3 mt-6 mb-2 text-[10px] font-bold text-blue-300 uppercase tracking-widest opacity-80">Race Management</div>
<a class="group flex items-center px-3 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-lg transition-colors cursor-pointer" href="{{ route('dashboard.events') }}">
<span class="material-icons group-hover:text-accent text-xl">calendar_today</span>
<span class="hidden lg:block ml-3 font-medium text-sm flex-1">Events</span>
</a>

<div class="hidden lg:block px-3 mt-6 mb-2 text-[10px] font-bold text-blue-300 uppercase tracking-widest opacity-80">Competition</div>
<a class="group flex items-center px-3 py-2.5 text-blue-100 hover:bg-white/10 hover:text-white rounded-lg transition-colors" href="{{ route('dashboard.results') }}">
<span class="material-icons group-hover:text-accent text-xl">timer</span>
<span class="hidden lg:block ml-3 font-medium text-sm">Results &amp; Timing</span>
</a>
<a class="group flex items-center px-3 py-2.5 text-white bg-white/10 shadow-inner rounded-lg transition-colors" href="{{ route('dashboard.leaderboards') }}">
<span class="material-icons text-accent text-xl">emoji_events</span>
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
<div class="flex items-center justify-between lg:justify-between bg-black/20 rounded-lg p-1 border border-white/5">
<button class="flex-1 text-[10px] font-bold text-white bg-white/20 shadow-sm px-1 py-1 rounded transition-all hover:bg-white/30">ID</button>
<div class="w-px h-3 bg-white/20 mx-1"></div>
<button class="flex-1 text-[10px] font-medium text-blue-200 hover:text-white px-1 py-1 rounded transition-colors">EN</button>
</div>
<button class="w-full flex items-center justify-center lg:justify-between gap-2 px-3 py-2 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all border border-transparent hover:border-white/10" onclick="document.documentElement.classList.toggle('dark')">
<div class="flex items-center gap-2">
<span class="material-icons text-sm">dark_mode</span>
<span class="hidden lg:block text-xs font-medium">Dark Mode</span>
</div>
<div class="hidden lg:block relative w-8 h-4 bg-black/30 rounded-full">
<div class="absolute right-0.5 top-0.5 w-3 h-3 bg-white rounded-full shadow-sm"></div>
</div>
</button>
</div>
</div>
</aside>
<main class="flex-1 relative flex flex-col h-full bg-gray-50 dark:bg-gray-900 overflow-hidden fade-in">
<header class="h-16 lg:h-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between px-6 lg:px-10 shrink-0 z-10 shadow-sm">
<div class="flex items-center">
<button class="lg:hidden text-gray-500 mr-4">
<span class="material-icons">menu</span>
</button>
<div>
<h2 class="text-2xl font-display font-bold text-gray-900 dark:text-white uppercase italic tracking-wide">
            Leaderboards
          </h2>
<p class="text-xs text-gray-500 dark:text-gray-400 font-medium flex items-center gap-1">
            Global Ranking <span class="w-1 h-1 rounded-full bg-gray-300"></span> Updated 5 mins ago
          </p>
</div>
</div>
<div class="flex items-center gap-6">
<div class="hidden md:flex items-center gap-2 px-3 py-1.5 bg-blue-50 dark:bg-blue-900/20 rounded-full text-primary dark:text-blue-300 text-xs font-bold border border-blue-100 dark:border-blue-900">
<span class="material-icons text-sm">public</span> Global Region
        </div>
<div class="flex items-center gap-4 border-l border-gray-200 dark:border-gray-700 pl-6">
<div class="hidden md:flex flex-col text-right">
<span class="text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->NamaLengkap ?? 'User' }}</span>
<span class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->PeranID == 1 ? 'Administrator' : 'Participant' }}</span>
</div>
<div class="relative">
<img alt="Profile" class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-600 shadow-sm object-cover" src="{{ Auth::user()->Gambar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->NamaLengkap ?? 'User') . '&background=random' }}"/>
<div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full"></div>
</div>
</div>
</div>
</header>
<div class="flex-1 overflow-y-auto p-4 lg:p-8 scroll-smooth no-scrollbar">
<div class="max-w-7xl mx-auto space-y-8">
<div class="relative">
<div class="text-center mb-8">
<span class="inline-block py-1 px-3 rounded-full bg-accent/10 text-accent text-xs font-bold uppercase tracking-wider mb-2">Top Performers</span>
<h3 class="text-3xl font-display font-bold text-gray-800 dark:text-gray-100">This Month's Champions</h3>
</div>
<div class="flex flex-col md:flex-row items-end justify-center gap-6 md:gap-8 pb-4">
<div class="order-2 md:order-1 w-full md:w-72 bg-white dark:bg-gray-800 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] dark:shadow-none border border-gray-100 dark:border-gray-700 relative flex flex-col items-center p-6 pb-8 transform hover:-translate-y-2 transition-transform duration-300 group">
<div class="absolute -top-5">
<div class="w-10 h-10 rounded-full bg-slate-200 border-4 border-white dark:border-gray-800 flex items-center justify-center font-display font-bold text-slate-600 shadow-md text-xl">2</div>
</div>
<div class="w-20 h-20 rounded-full p-1 bg-gradient-to-tr from-slate-300 to-slate-100 mb-3 mt-4 group-hover:scale-105 transition-transform">
<img alt="Runner" class="w-full h-full rounded-full object-cover border-2 border-white dark:border-gray-800" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYsRi-I3p5m3IeKVN9zxtdv1_Yu78FqD-mnCnm6MmQV-vRCevBqXe9Isttqxx_bbNA_g8tCSrSMniwsmj6ucL-xA6TNSQIudn0j2VVzSEUTDghrFKcVxprSzIdbXAbmYQPlrjAbzvyqrTKukZEe115izXujYO74lrUa0ClyzLmivgItgXocogRwjzx0TSPOaE6UouXWRE7XMU1ieRCmyRZFIck2pr7IFdXXiGX2khVAKsXDeqGlRm_dDnZJylvd3IAAphyNv8XrAU"/>
</div>
<div class="text-center w-full">
<div class="font-bold text-lg text-gray-900 dark:text-white truncate">Sarah Wijaya</div>
<div class="text-xs text-gray-500 mb-4 flex items-center justify-center gap-1">
<span class="material-icons text-[14px] text-blue-500">verified</span> Jakarta Swift
                  </div>
<div class="w-full h-px bg-gray-100 dark:bg-gray-700 mb-4"></div>
<div class="flex justify-between items-center px-4">
<div class="text-xs text-gray-400 uppercase">Distance</div>
<div class="text-2xl font-display font-bold text-gray-700 dark:text-gray-200">1,180 <span class="text-xs font-sans font-medium text-gray-400">KM</span></div>
</div>
</div>
</div>
<div class="order-1 md:order-2 w-full md:w-80 bg-gradient-to-b from-blue-600 to-blue-700 dark:from-blue-900 dark:to-gray-900 text-white rounded-2xl shadow-[0_20px_50px_rgba(37,99,235,0.3)] border-4 border-yellow-400/30 relative flex flex-col items-center p-6 pb-10 z-10 transform scale-105 hover:-translate-y-3 transition-transform duration-300">
<div class="absolute -top-8">
<span class="material-icons text-6xl text-yellow-400 drop-shadow-lg">emoji_events</span>
</div>
<div class="w-28 h-28 rounded-full p-1.5 bg-gradient-to-tr from-yellow-400 via-yellow-200 to-yellow-500 mb-3 mt-8 shadow-lg">
<img alt="Runner" class="w-full h-full rounded-full object-cover border-4 border-blue-600 dark:border-gray-800" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDv8NNa6lKwIEmoJbOKxXMXhbA_B2_TkVhFdHDZXDaoQXhwLZcvPGULV6qAfqr6QDgHT49dIzH4UJOqgUumi4chwJ_UEMTjUd1DNnrnt9c8wOActfpChvOxW8KvMdWoNJJevSP6_04nx6RplJ-GAO6RjWLSDXdVFwYnOOaJOwr0NnH3f5D3Kb6HI9ZRnamz0mrPgff-r_hEBb7XbG8EjjPlT_b_b5Lb2lmbhR-zdH1YAx6wY91qKk8OAqVhzHhycQz01snxFK9FsWY"/>
</div>
<div class="text-center w-full">
<div class="font-bold text-2xl mb-1">Budi Santoso</div>
<div class="text-xs text-blue-200 font-bold mb-4 flex items-center justify-center gap-1 uppercase tracking-widest">
<span class="w-1.5 h-1.5 bg-yellow-400 rounded-full animate-pulse"></span> IndoRunners
                  </div>
<div class="w-full h-px bg-white/10 mb-4"></div>
<div class="flex justify-between items-end px-2">
<div class="text-xs text-blue-200 uppercase mb-1">Total Distance</div>
<div class="text-4xl font-display font-bold text-white">1,250 <span class="text-sm font-sans font-medium text-blue-200">KM</span></div>
</div>
<div class="mt-4 inline-block bg-yellow-400/20 border border-yellow-400/50 text-yellow-100 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                    New Record!
                  </div>
</div>
</div>
<div class="order-3 md:order-3 w-full md:w-72 bg-white dark:bg-gray-800 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] dark:shadow-none border border-gray-100 dark:border-gray-700 relative flex flex-col items-center p-6 pb-8 transform hover:-translate-y-2 transition-transform duration-300 group">
<div class="absolute -top-5">
<div class="w-10 h-10 rounded-full bg-orange-200 border-4 border-white dark:border-gray-800 flex items-center justify-center font-display font-bold text-orange-700 shadow-md text-xl">3</div>
</div>
<div class="w-20 h-20 rounded-full p-1 bg-gradient-to-tr from-orange-300 to-orange-100 mb-3 mt-4 group-hover:scale-105 transition-transform">
<img alt="Runner" class="w-full h-full rounded-full object-cover border-2 border-white dark:border-gray-800" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDmQXl3scYcmMxc4pOXFw9RA1z_bJpmY3rVxN2B4fMIaXNjalXvbexaN2wVp_v6Rfrsb5MfDO0aRGWMNwP5DddAFB7chPiX4qCGWwv9lzotOfh2vu5fFfsAeRPMRqbIKkC2csNwc4Wd8aqKf9TnwjJIMdERZmS1u1CuNvANpvJhO4MrR62wpfWGf9a3q0eaLjqFiDCUTRxf5ApY577b3AizRxh08uTNa3IM5WnwrLcS9epcYfkBDQSfAFULfVn9Lk54_4aRo58XL_w"/>
</div>
<div class="text-center w-full">
<div class="font-bold text-lg text-gray-900 dark:text-white truncate">Andi Pratama</div>
<div class="text-xs text-gray-500 mb-4 flex items-center justify-center gap-1">
<span class="material-icons text-[14px] text-orange-500">terrain</span> Bandung Explorer
                  </div>
<div class="w-full h-px bg-gray-100 dark:bg-gray-700 mb-4"></div>
<div class="flex justify-between items-center px-4">
<div class="text-xs text-gray-400 uppercase">Distance</div>
<div class="text-2xl font-display font-bold text-gray-700 dark:text-gray-200">1,150 <span class="text-xs font-sans font-medium text-gray-400">KM</span></div>
</div>
</div>
</div>
</div>
</div>
<div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 flex flex-col xl:flex-row gap-4 justify-between items-center sticky top-0 z-20">
<div class="flex flex-wrap items-center gap-3 w-full xl:w-auto">
<div class="flex items-center gap-2 text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide mr-2">
<span class="material-icons text-lg">filter_list</span> Filters
              </div>
<select class="form-select pl-3 pr-10 py-2 text-sm rounded-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:ring-primary focus:border-primary shadow-sm">
<option>All Time</option>
<option selected="">Monthly</option>
<option>Yearly</option>
</select>
<select class="form-select pl-3 pr-10 py-2 text-sm rounded-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:ring-primary focus:border-primary shadow-sm">
<option>All Cities</option>
<option>Jakarta</option>
<option>Bandung</option>
<option>Surabaya</option>
<option>Bali</option>
</select>
<select class="form-select pl-3 pr-10 py-2 text-sm rounded-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:ring-primary focus:border-primary shadow-sm">
<option>All Categories</option>
<option>Male Open</option>
<option>Female Open</option>
<option>Age Group: 18-30</option>
<option>Age Group: 31-45</option>
<option>Masters: 45+</option>
</select>
</div>
<div class="relative w-full xl:w-96 group">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 group-focus-within:text-primary transition-colors">
<span class="material-icons">search</span>
</span>
<input class="form-input w-full pl-10 pr-4 py-2 rounded-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:ring-primary focus:border-primary shadow-sm transition-all" placeholder="Search runner name, club, or BIB number..." type="text"/>
</div>
</div>
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden relative flex flex-col">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-gray-50/80 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
<th class="px-6 py-4 font-bold text-center w-20">Rank</th>
<th class="px-6 py-4 font-bold">Runner Name</th>
<th class="px-6 py-4 font-bold hidden md:table-cell">Club / Community</th>
<th class="px-6 py-4 font-bold hidden lg:table-cell text-right">Total Events</th>
<th class="px-6 py-4 font-bold hidden sm:table-cell text-right">Elev. Gain</th>
<th class="px-6 py-4 font-bold text-right text-primary">Total Distance</th>
</tr>
</thead>
<tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
<tr class="hover:bg-blue-50/50 dark:hover:bg-gray-700/30 transition-colors group">
<td class="px-6 py-4 text-center font-display font-bold text-gray-700 dark:text-gray-300 text-lg group-hover:text-primary transition-colors">4</td>
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="relative">
<img class="w-10 h-10 rounded-full bg-gray-200 object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuABCWmFW6ULXKF6cS4BtymzTSKnT1Gr_ar3fLXR-POpEB3elo6LmitBzEqynjGqAoZVwc8XiR-ml6hs1qmSuqYpHZKLilsvorfGCbmNfVs1q2gDijFAz3hGegfGT-Ef_mVTJp19zTUDOuT89YgwSoVk4hGPq-5v5NETMe8jNN2zfJgoYPHos8c05v4BE85JVQAmFmB3bDszYUffzkQuQDX0KEGiPNI1Kiv1tA0RBpXBI-LXf5XdNYUVn4uArjY9VpcmxWSkAsMuVaY"/>
<div class="absolute -bottom-1 -right-1 bg-white dark:bg-gray-800 rounded-full p-0.5">
<span class="material-icons text-xs text-blue-500">verified</span>
</div>
</div>
<div>
<span class="font-bold text-gray-900 dark:text-white block">Denny Caknan</span>
<span class="text-xs text-gray-500">M, 28</span>
</div>
</div>
</td>
<td class="px-6 py-4 hidden md:table-cell text-gray-500 dark:text-gray-400">Ngawi Runners</td>
<td class="px-6 py-4 hidden lg:table-cell text-right text-gray-900 dark:text-white font-medium">12</td>
<td class="px-6 py-4 hidden sm:table-cell text-right font-mono text-gray-600 dark:text-gray-400">8,450m</td>
<td class="px-6 py-4 text-right font-display font-bold text-gray-900 dark:text-white text-lg">980 <span class="text-xs text-gray-400 font-sans font-normal">KM</span></td>
</tr>
</tbody>
</table>
</div>
<div class="sticky bottom-0 bg-primary dark:bg-blue-900 text-white border-t-4 border-blue-400 dark:border-blue-800 shadow-2xl z-20">
<div class="overflow-x-auto no-scrollbar">
<table class="w-full text-left">
<tbody>
<tr class="bg-gradient-to-r from-primary to-blue-600 dark:from-blue-900 dark:to-slate-900">
<td class="px-6 py-3 text-center w-20">
<div class="flex flex-col items-center">
<span class="text-[10px] uppercase tracking-wider opacity-75">Your Rank</span>
<span class="font-display font-bold text-2xl">142</span>
</div>
</td>
<td class="px-6 py-3 min-w-[200px]">
<div class="flex items-center gap-3">
<img class="w-10 h-10 rounded-full border-2 border-white/30" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBmZwswpz4cpKy4hkwQlaAY4ojgyIu6Yxf3_-LIz6Dj6g9cVcBSeGP4IkWzC4LmJtoPir7rsY-3tque50sg9u8Yo20eDUi9oXJNxQbOgshsSmyLUPBhKnCmMcPcIUHnqArH-5y7i34QhOfFFGNnjOfknZZLPCR_Y_FkZpliEaA5sZP-cEt6oFkpjo_tfUZmem9uv4SCleiJsxwc-2afVwZsjip6lGyv1y1uVP2-CSsnjywlOUSJJMu_Qkf17WIylaX5rcEloi-YBJw"/>
<div>
<span class="font-bold block text-lg">You</span>
<span class="text-xs text-blue-100 flex items-center gap-1"><span class="material-icons text-[10px]">arrow_upward</span> Top 15%</span>
</div>
</div>
</td>
<td class="px-6 py-3 hidden md:table-cell text-blue-100 font-medium">Pelari Kalcer Member</td>
<td class="px-6 py-3 hidden lg:table-cell text-right font-bold text-lg">5</td>
<td class="px-6 py-3 hidden sm:table-cell text-right font-mono text-blue-100">2,100m</td>
<td class="px-6 py-3 text-right">
<div class="flex flex-col items-end">
<span class="font-display font-bold text-white text-xl">450 <span class="text-sm font-sans font-normal opacity-80">KM</span></span>
</div>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</main>
</body></html>
