<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Kalcer Run - Events Hub</title>
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
<div class="relative" x-data="{ open: true }">
    <button @click="open = !open" class="w-full group flex items-center px-3 py-2.5 text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-colors cursor-pointer text-left" :class="{'bg-white/10 text-white shadow-inner': open}">
        <span class="material-icons text-accent">calendar_today</span>
        <span class="hidden lg:block ml-3 font-semibold text-sm flex-1">Events</span>
        <span class="hidden lg:block material-icons text-sm text-blue-300 transition-transform duration-200" :class="{'rotate-180': open}">expand_more</span>
    </button>
    <div x-show="open" x-collapse class="block pl-3 pr-2 py-2 space-y-1 border-l-2 border-accent/30 ml-4 lg:ml-6 my-1">
        <a href="{{ route('dashboard.events') }}?filter=upcoming" class="flex items-center px-2 py-1.5 text-sm text-white bg-accent/20 rounded font-medium">
            <span class="w-1.5 h-1.5 rounded-full bg-accent mr-2"></span> Upcoming
        </a>
        <a href="{{ route('dashboard.events') }}?filter=past" class="block px-2 py-1.5 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded transition-colors">
            <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-2 inline-block"></span> Past Events
        </a>
    </div>
</div>

<div class="hidden lg:block px-3 mt-6 mb-2 text-[10px] font-bold text-blue-200/70 uppercase tracking-widest">Race Data</div>
<a class="group flex items-center px-3 py-2.5 text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-colors" href="{{ route('dashboard.results') }}">
<span class="material-icons group-hover:text-accent transition-colors">timer</span>
<span class="hidden lg:block ml-3 font-medium text-sm">Results &amp; Timing</span>
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
<div class="flex flex-col gap-3">
<div class="flex items-center bg-black/20 rounded-lg p-1 border border-white/5">
<button class="flex-1 flex items-center justify-center gap-1 py-1.5 rounded-md text-xs font-bold text-primary bg-white shadow-sm transition-all">
<span>ID</span>
</button>
<button class="flex-1 flex items-center justify-center gap-1 py-1.5 rounded-md text-xs font-medium text-blue-200 hover:text-white hover:bg-white/10 transition-all">
<span>EN</span>
</button>
</div>
<button class="relative w-full flex items-center justify-between px-3 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-all border border-transparent hover:border-white/10 group" onclick="document.documentElement.classList.toggle('dark')">
<div class="flex items-center gap-2">
<span class="material-icons text-sm group-hover:text-yellow-300 transition-colors">light_mode</span>
<span class="hidden lg:block text-xs font-medium">Theme</span>
</div>
<div class="hidden lg:block relative w-8 h-4 bg-black/40 rounded-full border border-white/10 dark:bg-primary dark:border-transparent transition-colors">
<div class="absolute left-0.5 top-0.5 w-3 h-3 bg-white rounded-full shadow-sm transform dark:translate-x-4 transition-transform duration-300"></div>
</div>
</button>
</div>
</div>
</aside>
<main class="flex-1 relative flex flex-col overflow-hidden bg-gray-50 dark:bg-[#0B1120] fade-in">
<header class="h-20 bg-white dark:bg-card-dark border-b border-gray-200 dark:border-gray-800 flex items-center justify-between px-8 z-10 shadow-sm">
<div class="flex items-center gap-4">
<button class="lg:hidden text-gray-500 hover:text-primary">
<span class="material-icons">menu</span>
</button>
<nav class="hidden md:flex items-center text-sm font-medium text-gray-500 dark:text-gray-400">
<a class="hover:text-primary transition-colors" href="#">Dashboard</a>
<span class="material-icons text-base mx-2">chevron_right</span>
<span class="text-gray-900 dark:text-white font-semibold">Events Hub</span>
</nav>
</div>
<div class="flex items-center gap-6">
<div class="hidden md:block relative">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-icons text-gray-400 text-sm">search</span>
</span>
<input class="pl-9 pr-4 py-2 bg-gray-100 dark:bg-gray-800 border-none rounded-full text-sm w-64 focus:ring-2 focus:ring-primary text-gray-900 dark:text-white placeholder-gray-500" placeholder="Search events..." type="text"/>
</div>
<button class="relative text-gray-400 hover:text-primary transition-colors">
<span class="material-icons">notifications</span>
<span class="absolute top-0 right-0 w-2 h-2 bg-accent rounded-full border-2 border-white dark:border-card-dark"></span>
</button>
<div class="flex items-center gap-3 pl-6 border-l border-gray-200 dark:border-gray-700">
<div class="text-right hidden md:block">
<div class="text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->NamaLengkap ?? 'User' }}</div>
<div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->PeranID == 1 ? 'Administrator' : 'Participant' }}</div>
</div>
<div class="h-10 w-10 rounded-full bg-gradient-to-tr from-primary to-accent p-[2px]">
<img alt="Profile" class="h-full w-full rounded-full object-cover border-2 border-white dark:border-card-dark" src="{{ Auth::user()->Gambar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->NamaLengkap ?? 'User') . '&background=random' }}"/>
</div>
</div>
</div>
</header>
<div class="flex-1 overflow-y-auto p-6 lg:p-10 no-scrollbar">
<div class="max-w-7xl mx-auto space-y-8">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<h1 class="text-3xl lg:text-4xl font-display font-bold uppercase italic text-gray-900 dark:text-white">
                            Events <span class="text-primary">Master Hub</span>
</h1>
<p class="mt-2 text-gray-600 dark:text-gray-400 max-w-2xl">
                            Manage your race portfolio. Create new events, track registrations, and coordinate race pack distributions all in one place.
                        </p>
</div>
<button class="flex items-center gap-2 bg-primary hover:bg-blue-600 text-white px-5 py-2.5 rounded-lg shadow-lg shadow-blue-500/20 transition-all transform hover:-translate-y-0.5 font-medium">
<span class="material-icons text-sm">add</span>
                        Create Event
                    </button>
</div>
<div class="border-b border-gray-200 dark:border-gray-700">
<nav aria-label="Tabs" class="-mb-px flex space-x-8">
<a class="border-accent text-accent whitespace-nowrap py-4 px-1 border-b-2 font-bold text-sm flex items-center gap-2" href="#">
<span class="material-icons text-lg">calendar_month</span>
                            Upcoming Events
                            <span class="bg-accent/10 text-accent py-0.5 px-2.5 rounded-full text-xs ml-2">3</span>
</a>
<a class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2" href="#">
<span class="material-icons text-lg">history</span>
                            Past Events
                        </a>
</nav>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @foreach($events as $event)
        @php
            $earliestSlot = null;
            $allSlots = collect();
            
            foreach($event->categories as $cat) {
                 foreach($cat->slots as $slot) {
                     $allSlots->push($slot);
                     if ($slot->TanggalMulai && (!$earliestSlot || $slot->TanggalMulai < $earliestSlot->TanggalMulai)) {
                         $earliestSlot = $slot;
                     }
                 }
            }
            $date = $earliestSlot ? $earliestSlot->TanggalMulai : null;
            $location = $earliestSlot ? $earliestSlot->LokasiEvent : 'Location TBA';
            
            $distances = $event->categories->pluck('Jarak')->unique()->implode(', ');
             if(!$distances) $distances = "Multiple Distances";
        @endphp
        
        <div class="group bg-white dark:bg-card-dark rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-xl hover:border-primary/50 dark:hover:border-primary/50 transition-all duration-300">
            <div class="relative h-48 overflow-hidden">
                 <img alt="{{ $event->NamaEvent }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ $event->GambarEvent ?? 'https://placehold.co/600x400?text=No+Image' }}"/>
                 <div class="absolute top-4 left-4 flex gap-2">
                      <span class="bg-primary/90 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">{{ $event->categories->first()->NamaKategori ?? 'Event' }}</span>
                 </div>
                 @if($date && $date->diffInDays(now()) < 30 && $date->isFuture())
                     <div class="absolute bottom-4 right-4 bg-black/60 backdrop-blur-md text-white px-3 py-1.5 rounded-lg border border-white/10 flex items-center gap-2">
                          <span class="material-icons text-yellow-400 text-sm">timer</span>
                          <span class="text-xs font-mono font-bold">{{ $date->diffInDays(now()) }} DAYS LEFT</span>
                     </div>
                 @endif
            </div>
            
            <div class="p-6">
                 <div class="flex justify-between items-start mb-4">
                      <div>
                           <h3 class="text-xl font-display font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors line-clamp-1" title="{{ $event->NamaEvent }}">{{ $event->NamaEvent }}</h3>
                           <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm mt-1">
                                <span class="material-icons text-sm mr-1">location_on</span>
                                <span class="line-clamp-1">{{ $location }}</span>
                           </div>
                      </div>
                      <div class="text-center bg-gray-100 dark:bg-gray-800 rounded-lg p-2 min-w-[60px]">
                           <div class="text-xs text-gray-500 uppercase font-bold">{{ $date ? $date->format('M') : 'TBA' }}</div>
                           <div class="text-xl font-bold text-gray-900 dark:text-white">{{ $date ? $date->format('d') : '--' }}</div>
                      </div>
                 </div>
                 
                 <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2" title="{{ $event->DeskripsiEvent }}">
                     {{ $event->DeskripsiEvent }}
                 </p>
                 
                 <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                      <div class="flex items-center gap-2">
                           <span class="text-xs text-gray-500 font-medium bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">{{ $distances }}</span>
                      </div>
                      
                      @if($event->StatusEvent == 'Buka')
                          <button class="bg-primary hover:bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-lg transition-colors shadow-lg shadow-blue-500/20">
                               Register Now
                          </button>
                      @else
                           <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                {{ $event->StatusEvent ?? 'Closed' }}
                           </span>
                      @endif
                 </div>
            </div>
        </div>
    @endforeach
</div>

</div>
</div>
</main>
</body></html>
