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
        <a href="{{ route('dashboard.events', ['filter' => 'upcoming']) }}" class="{{ $filter === 'upcoming' ? 'flex items-center px-2 py-1.5 text-sm text-white bg-accent/20 rounded font-medium' : 'block px-2 py-1.5 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded transition-colors' }}">
            <span class="w-1.5 h-1.5 rounded-full bg-accent mr-2 inline-block"></span> Upcoming
        </a>
        <a href="{{ route('dashboard.events', ['filter' => 'past']) }}" class="{{ $filter === 'past' ? 'flex items-center px-2 py-1.5 text-sm text-white bg-accent/20 rounded font-medium' : 'block px-2 py-1.5 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded transition-colors' }}">
            <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-2 inline-block"></span> Past Events
        </a>
        <a href="{{ route('dashboard.events', ['filter' => 'my_events']) }}" class="{{ $filter === 'my_events' ? 'flex items-center px-2 py-1.5 text-sm text-white bg-accent/20 rounded font-medium' : 'block px-2 py-1.5 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded transition-colors' }}">
            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 mr-2 inline-block"></span> My Events
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
<main x-data="eventModal" class="flex-1 relative flex flex-col overflow-hidden bg-gray-50 dark:bg-[#0B1120] fade-in">
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
<div class="relative" x-data="{
    notificationsOpen: false,
    hasUnread: true,
    notifications: [
        { id: 1, title: 'Upcoming Event: Jakarta Marathon', time: '2 hours ago', desc: 'Don\'t forget to pick up your race pack!' },
        { id: 2, title: 'New Result Available', time: '1 day ago', desc: 'Your timing for Bandung Night Run is out.' },
        { id: 3, title: 'Registration Successful', time: '3 days ago', desc: 'You are booked for Bali Ultra 2026.' }
    ],
    toggleNotifications() {
        this.notificationsOpen = !this.notificationsOpen;
        if (this.notificationsOpen) {
            this.hasUnread = false;
        }
    }
}">
    <button @click="toggleNotifications()" @click.outside="notificationsOpen = false" class="relative text-gray-400 hover:text-primary transition-colors focus:outline-none">
        <span class="material-icons">notifications</span>
        <span x-show="hasUnread" x-transition.scale class="absolute top-0 right-0 w-2 h-2 bg-accent rounded-full border-2 border-white dark:border-card-dark"></span>
    </button>

    <div x-show="notificationsOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-1"
         style="display: none;"
         class="absolute right-0 mt-2 w-80 bg-white dark:bg-card-dark rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700 py-2 z-50 origin-top-right">
         
         <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
            <h3 class="font-bold text-gray-900 dark:text-white text-sm">Notifications</h3>
            <button @click="hasUnread = false" class="text-xs text-primary hover:text-blue-600 font-medium">Mark all read</button>
         </div>

         <div class="max-h-64 overflow-y-auto no-scrollbar">
             <template x-for="note in notifications" :key="note.id">
                 <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors border-b border-gray-50 dark:border-gray-800/50 last:border-0">
                    <div class="flex gap-3">
                        <div class="mt-1 flex-shrink-0">
                             <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary dark:text-blue-400">
                                <span class="material-icons text-sm">campaign</span>
                             </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white" x-text="note.title"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5" x-text="note.desc"></p>
                            <p class="text-[10px] text-gray-400 mt-1" x-text="note.time"></p>
                        </div>
                    </div>
                 </a>
             </template>
         </div>
    </div>
</div>
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

</div>
<div class="border-b border-gray-200 dark:border-gray-700">
@php
    $isUpcoming = $filter === 'upcoming';
    $isPast = $filter === 'past';
    $isMyEvents = $filter === 'my_events';
@endphp
<nav aria-label="Tabs" class="-mb-px flex space-x-8">
    <a class="{{ $isUpcoming ? 'border-accent text-accent font-bold' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 font-medium' }} whitespace-nowrap py-4 px-1 border-b-2 text-sm flex items-center gap-2" 
       href="{{ route('dashboard.events', ['filter' => 'upcoming']) }}">
        <span class="material-icons text-lg">calendar_month</span>
        Upcoming Events
        @if($isUpcoming)
        <span class="bg-accent/10 text-accent py-0.5 px-2.5 rounded-full text-xs ml-2">{{ $events->count() }}</span>
        @endif
    </a>
    <a class="{{ $isPast ? 'border-accent text-accent font-bold' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 font-medium' }} whitespace-nowrap py-4 px-1 border-b-2 text-sm flex items-center gap-2" 
       href="{{ route('dashboard.events', ['filter' => 'past']) }}">
        <span class="material-icons text-lg">history</span>
        Past Events
        @if($isPast)
        <span class="bg-accent/10 text-accent py-0.5 px-2.5 rounded-full text-xs ml-2">{{ $events->count() }}</span>
        @endif
    </a>
    <a class="{{ $isMyEvents ? 'border-accent text-accent font-bold' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 font-medium' }} whitespace-nowrap py-4 px-1 border-b-2 text-sm flex items-center gap-2" 
       href="{{ route('dashboard.events', ['filter' => 'my_events']) }}">
        <span class="material-icons text-lg">collections_bookmark</span>
        My Events
        @if($isMyEvents)
        <span class="bg-accent/10 text-accent py-0.5 px-2.5 rounded-full text-xs ml-2">{{ $events->count() }}</span>
        @endif
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
                                    <div class="mt-4 flex items-center justify-between">
                                        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="material-icons text-base">calendar_today</span>
                                            <span>Start: {{ \Carbon\Carbon::parse($earliestSlot)->format('d M Y') }}</span>
                                        </div>
                                        
                                        @if($event->userRegistration)
                                            <button @click="openRegistrationModal(@js($event))" 
                                                class="px-4 py-2 rounded-lg text-sm font-bold text-white transition-all transform hover:-translate-y-0.5 shadow-lg shadow-green-500/20 bg-green-500 hover:bg-green-600">
                                                Check Credentials
                                            </button>
                                        @elseif($event->StatusEvent == 'Buka')
                                            <button @click="openRegistrationModal(@js($event))" 
                                                class="px-4 py-2 rounded-lg text-sm font-bold text-white transition-all transform hover:-translate-y-0.5 shadow-lg shadow-blue-500/20 bg-primary hover:bg-blue-600">
                                                Register Now
                                            </button>
                                        @else
                                            <button disabled class="px-4 py-2 rounded-lg text-sm font-bold text-gray-400 bg-gray-200 dark:bg-gray-700 cursor-not-allowed">
                                                Event Closed
                                            </button>
                                        @endif
                                    </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Registration Modal -->
<div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="showModal = false"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl w-full border border-gray-700">
            
            <template x-if="activeEvent">
                <div>
                     <!-- Modal Header with Image -->
                     <div class="relative h-64 sm:h-80">
                         <img :src="activeEvent.GambarEvent || 'https://placehold.co/800x400'" class="w-full h-full object-cover" alt="Event Banner">
                         <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
                         <button @click="showModal = false" class="absolute top-4 right-4 bg-black/30 hover:bg-black/50 text-white rounded-full p-2 backdrop-blur-md transition-colors">
                             <span class="material-icons">close</span>
                         </button>
                         <div class="absolute bottom-6 left-6 right-6 text-white">
                             <div class="flex gap-2 mb-3">
                                 <span class="bg-accent px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Open Registration</span>
                             </div>
                             <h2 class="text-3xl sm:text-4xl font-display font-bold mb-2" x-text="activeEvent.NamaEvent"></h2>
                             <div class="flex items-center gap-4 text-sm sm:text-base text-gray-200">
                                 <span class="flex items-center gap-1"><span class="material-icons text-sm text-primary">location_on</span> <span x-text="activeEvent.categories?.[0]?.slots?.[0]?.LokasiEvent || 'Location TBA'"></span></span>
                                 <span class="flex items-center gap-1"><span class="material-icons text-sm text-primary">calendar_today</span> <span x-text="formatDate(activeEvent.categories?.[0]?.slots?.[0]?.TanggalMulai)"></span></span>
                             </div>
                         </div>
                     </div>

                     <div class="grid grid-cols-1 lg:grid-cols-3">
                         <!-- Details Sidebar -->
                         <div class="lg:col-span-1 bg-gray-50 dark:bg-gray-900/50 p-6 space-y-6 border-r border-gray-200 dark:border-gray-700">
                             <div>
                                 <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                     <span class="material-icons text-primary">map</span> Route & Location
                                 </h3>
                                 <div class="space-y-3">
                                     <!-- Trail Image Mockup -->
                                     <div class="rounded-lg overflow-hidden relative group cursor-pointer h-32">
                                         <img src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&q=80&w=400" class="w-full h-full object-cover" alt="Trail Map">
                                         <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                             <span class="text-white text-xs font-bold">View Trail Map</span>
                                         </div>
                                     </div>
                                     <div class="grid grid-cols-2 gap-2">
                                         <div class="rounded-lg overflow-hidden h-20">
                                              <img src="https://images.unsplash.com/photo-1552674605-46f538316d43?auto=format&fit=crop&q=80&w=200" class="w-full h-full object-cover" alt="Start Line">
                                         </div>
                                         <div class="rounded-lg overflow-hidden h-20">
                                              <img src="https://images.unsplash.com/photo-1533561052604-c3beb6d55760?auto=format&fit=crop&q=80&w=200" class="w-full h-full object-cover" alt="Finish Line">
                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <div>
                                 <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                     <span class="material-icons text-primary">info</span> Event Info
                                 </h3>
                                 <div class="space-y-3 text-sm">
                                     <div class="flex justify-between">
                                         <span class="text-gray-500">Total Participants</span>
                                         <span class="font-bold text-gray-900 dark:text-gray-200">2,500+</span>
                                     </div>
                                     <div class="flex justify-between">
                                         <span class="text-gray-500">Surface</span>
                                         <span class="font-bold text-gray-900 dark:text-gray-200">Road / Asphalt</span>
                                     </div>
                                      <div class="flex justify-between">
                                         <span class="text-gray-500">Weather Est.</span>
                                         <span class="font-bold text-gray-900 dark:text-gray-200">24°C Cloudy</span>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <!-- Registration Form -->
                         <div class="lg:col-span-2 p-6 sm:p-8">
                             <div class="mb-8">
                                 <h3 class="font-bold text-xl text-gray-900 dark:text-white mb-2">About Event</h3>
                                 <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed" x-text="activeEvent.DeskripsiEvent"></p>
                             </div>

                                     <div x-show="!activeEvent.userRegistration || activeEvent.userRegistration.StatusPendaftaran == 'Pendaftaran Ditolak'">
                                         
                                         <!-- Rejection Message -->
                                         <div x-show="activeEvent.userRegistration && activeEvent.userRegistration.StatusPendaftaran == 'Pendaftaran Ditolak'" class="mb-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                                            <div class="flex items-center gap-3 text-red-700 dark:text-red-400">
                                                <span class="material-icons">error_outline</span>
                                                <div class="font-bold">Registration Rejected</div>
                                            </div>
                                            <p class="text-xs text-red-600 dark:text-red-300 mt-1 pl-9">
                                                Your payment proof was rejected. Please upload a valid receipt to continue.
                                            </p>
                                         </div>

                                         <form action="{{ route('dashboard.events') }}" method="POST" enctype="multipart/form-data">
                                             @csrf
                                             <!-- Hidden inputs for re-submission logic if needed, or just standard form -->
                                             <div class="space-y-6">
                                                 <div>
                                                     <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3 uppercase tracking-wider">Select Category</label>
                                                     <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                         <template x-for="cat in activeEvent.categories" :key="cat.KategoriID">
                                                             <label class="relative block cursor-pointer group">
                                                                 <input type="radio" name="category_id" :value="cat.KategoriID" class="peer sr-only" required :checked="activeEvent.userRegistration && activeEvent.userRegistration.KategoriID == cat.KategoriID">
                                                                 <div class="p-4 rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-blue-400 dark:hover:border-blue-500 peer-checked:border-primary peer-checked:bg-blue-50/50 dark:peer-checked:bg-blue-900/20 transition-all h-full">
                                                                     <div class="flex justify-between items-start mb-2">
                                                                         <span class="text-2xl font-black text-gray-800 dark:text-white" x-text="cat.NamaKategori"></span>
                                                                         <span class="material-icons text-primary opacity-0 peer-checked:opacity-100 transition-opacity">check_circle</span>
                                                                     </div>
                                                                     <div class="text-lg font-bold text-primary" x-text="'Rp ' + (cat.Harga ? Number(cat.Harga).toLocaleString('id-ID') : 'Free')"></div>
                                                                     <div class="text-xs text-gray-500 mt-2" x-text="(cat.Jarak || '5') + 'km • Road • Chip Timing'"></div>
                                                                 </div>
                                                             </label>
                                                         </template>
                                                     </div>
                                                 </div>
             
                                                 <div>
                                                     <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3 uppercase tracking-wider">Payment & Confirmation</label>
                                                     
                                                     <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 mb-4 border border-blue-100 dark:border-blue-800">
                                                        <div class="flex flex-col sm:flex-row gap-4 items-center">
                                                            <div class="bg-white p-2 rounded-lg shrink-0">
                                                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=SeaBank-1234567890" alt="QR Payment" class="w-20 h-20">
                                                            </div>
                                                            <div class="text-sm text-center sm:text-left">
                                                                <p class="font-bold text-gray-900 dark:text-white mb-1">Transfer to SeaBank</p>
                                                                <p class="font-mono text-lg text-primary font-bold tracking-wider select-all">9012 3456 7890</p>
                                                                <p class="text-gray-500 text-xs mt-1">Ref: EVENT-<span x-text="activeEvent.EventID"></span></p>
                                                            </div>
                                                        </div>
                                                     </div>
             
                                                     <label class="block text-xs font-medium text-gray-500 mb-2">Upload Payment Proof <span class="text-red-500">*</span></label>
                                                     <div class="relative rounded-xl border-3 border-dashed border-gray-300 dark:border-gray-600 p-8 flex flex-col items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors cursor-pointer group hover:border-primary" :class="{'border-primary bg-blue-50/50 dark:bg-blue-900/20': hasFile}">
                                                         <span class="material-icons text-gray-400 text-5xl mb-3 group-hover:text-primary transition-colors transform group-hover:scale-110 duration-300" :class="{'text-primary': hasFile}">cloud_upload</span>
                                                         <span class="text-base font-bold text-gray-900 dark:text-white" x-text="fileName || 'Drop your receipt here'"></span>
                                                         <span class="text-sm text-gray-500 dark:text-gray-400 mt-1" x-show="!hasFile">or click to browse files</span>
                                                         <div class="mt-2 text-xs text-center text-gray-400" x-show="!hasFile">
                                                             Supported: JPG, PNG, PDF (Max 2MB)
                                                         </div>
                                                         <input type="file" name="payment_proof" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" @change="handleFileSelect($event)" required>
                                                     </div>
                                                 </div>
             
                                                 <div class="pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                                                     <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Cancel</button>
                                                     <button type="submit" 
                                                        :disabled="!hasFile"
                                                        class="px-8 py-2.5 rounded-lg text-sm font-bold text-white transition-all transform"
                                                        :class="hasFile ? 'bg-primary hover:bg-blue-600 shadow-lg shadow-blue-500/30 hover:-translate-y-0.5' : 'bg-gray-300 dark:bg-gray-700 cursor-not-allowed opacity-70'">
                                                         Confirm Registration
                                                     </button>
                                                 </div>
                                             </div>
                                         </form>
                                     </div>

                                     <!-- STATUS: PENDING / ACCEPTED -->
                                     <div x-show="activeEvent.userRegistration && activeEvent.userRegistration.StatusPendaftaran != 'Pendaftaran Ditolak'" class="space-y-6">
                                        
                                        <!-- Accepted State -->
                                        <div x-show="['Terverifikasi', 'Selesai'].includes(activeEvent.userRegistration.StatusPendaftaran)" class="bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-2xl p-6 text-center">
                                            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 dark:bg-green-800 rounded-full mb-4">
                                                <span class="material-icons text-3xl text-green-600 dark:text-green-300">check_circle</span>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Registration Confirmed!</h3>
                                            <p class="text-gray-500 dark:text-gray-400 mb-6 font-medium">See you at the starting line!</p>
                                            
                                            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm inline-block min-w-[200px] border border-gray-100 dark:border-gray-700">
                                                <div class="text-xs text-gray-500 uppercase tracking-widest mb-1">BIB Number</div>
                                                <div class="text-4xl font-black text-primary font-mono tracking-wider" x-text="activeEvent.userRegistration.NomorBIB"></div>
                                            </div>
                                        </div>

                                        <!-- Pending/Payment Check State -->
                                        <div x-show="!['Terverifikasi', 'Selesai'].includes(activeEvent.userRegistration.StatusPendaftaran)" class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-100 dark:border-yellow-800 rounded-2xl p-6">
                                            <div class="flex items-center gap-4 mb-6">
                                                <div class="p-3 bg-yellow-100 dark:bg-yellow-800/50 rounded-full shrink-0">
                                                    <span class="material-icons text-yellow-600 dark:text-yellow-400">hourglass_top</span>
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-gray-900 dark:text-white text-lg">Payment Under Review</h4>
                                                    <p class="text-sm text-yellow-700 dark:text-yellow-400">We are verifying your payment proof. This process usually takes 24 hours.</p>
                                                </div>
                                            </div>

                                            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-100 dark:border-gray-700">
                                                <div class="text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider">Submitted Proof</div>
                                                <div class="relative aspect-video rounded-lg overflow-hidden bg-gray-100">
                                                    <template x-if="activeEvent.userRegistration.payment && activeEvent.userRegistration.payment.BuktiPembayaran">
                                                        <img :src="'/' + activeEvent.userRegistration.payment.BuktiPembayaran" class="w-full h-full object-cover">
                                                    </template>
                                                    <template x-if="!activeEvent.userRegistration.payment || !activeEvent.userRegistration.payment.BuktiPembayaran">
                                                        <div class="flex items-center justify-center h-full text-gray-400">No Image Available</div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end">
                                            <button @click="showModal = false" class="px-6 py-2.5 rounded-lg text-sm font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 transition-colors">Close</button>
                                        </div>
                                     </div>
                         </div>
                     </div>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('eventModal', () => ({
            showModal: false,
            activeEvent: null,
            hasFile: false,
            fileName: null,
            
            init() {
                // Pre-load if needed
            },

            openRegistrationModal(event) {
                this.activeEvent = event;
                this.showModal = true;
                this.hasFile = false; // Reset state
                this.fileName = null;
            },
            
            handleFileSelect(event) {
                const file = event.target.files[0];
                if (file) {
                    this.hasFile = true;
                    this.fileName = file.name;
                } else {
                    this.hasFile = false;
                    this.fileName = null;
                }
            },

            formatDate(dateString) {
                if(!dateString) return 'Date TBA';
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                return new Date(dateString).toLocaleDateString('en-US', options);
            }
        }))
    })
</script>
</div>
</div>
</main>
</body></html>
