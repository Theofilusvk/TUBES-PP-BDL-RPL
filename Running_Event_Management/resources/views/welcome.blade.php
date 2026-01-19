<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Kalcer Run - Landing &amp; Login</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;family=Oswald:wght@500;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#2563EB", // Vibrant Royal Blue/Electric Blue to match the 'kalcer' energetic vibe
              secondary: "#10B981", // Emerald green for success/active states
              accent: "#F43F5E", // Rose/Neon red for high energy accents
              "background-light": "#F3F4F6",
              "background-dark": "#111827",
              "card-light": "#FFFFFF",
              "card-dark": "#1F2937",
            },
            fontFamily: {
              sans: ["Inter", "sans-serif"],
              display: ["Oswald", "sans-serif"], // Bold condensed font for headlines
            },
            backgroundImage: {
               'hero-pattern': "url('https://images.unsplash.com/photo-1552674605-46f538316d43?q=80&w=2076&auto=format&fit=crop')",
            }
          },
        },
      };
    </script>
<style>.no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 font-sans h-screen flex overflow-hidden selection:bg-primary selection:text-white transition-colors duration-300">
<aside class="w-20 lg:w-64 flex-shrink-0 bg-primary dark:bg-slate-900 flex flex-col justify-between border-r border-white/10 dark:border-gray-800 transition-all duration-300 z-20">
<div>
<div class="h-20 flex items-center justify-center lg:justify-start lg:px-6 border-b border-white/10 dark:border-gray-800">
<div class="flex items-center gap-3">
<span class="material-icons text-3xl text-white">directions_run</span>
<h1 class="hidden lg:block font-display font-bold text-2xl text-white tracking-wide uppercase italic">Kalcer<span class="text-accent">Run</span></h1>
</div>
</div>
<nav class="mt-8 px-2 space-y-2">
<a class="group flex items-center px-3 py-3 text-white bg-white/10 rounded-lg transition-colors" href="{{ route('dashboard') }}">
<span class="material-icons text-white group-hover:text-accent">dashboard</span>
<span class="hidden lg:block ml-3 font-medium">Dashboard</span>
</a>
<div class="hidden lg:block px-3 mt-6 mb-2 text-xs font-semibold text-blue-200 uppercase tracking-wider">Management</div>
<div class="relative group">
<a class="group flex items-center px-3 py-3 text-blue-100 hover:bg-white/5 hover:text-white rounded-lg transition-colors cursor-pointer" href="{{ route('dashboard.events') }}">
<span class="material-icons group-hover:text-accent">calendar_today</span>
<span class="hidden lg:block ml-3 font-medium flex-1">Events</span>
<span class="hidden lg:block material-icons text-sm text-blue-300">expand_more</span>
</a>
<div class="hidden group-hover:block pl-11 pr-2 pb-2 space-y-1">
<a class="block px-2 py-1 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded" href="{{ route('dashboard.events', ['filter' => 'upcoming']) }}">Upcoming</a>
<a class="block px-2 py-1 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded" href="{{ route('dashboard.events', ['filter' => 'past']) }}">Past Events</a>
<a class="block px-2 py-1 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded" href="{{ route('dashboard.events', ['filter' => 'my_events']) }}">My Events</a>
</div>
</div>
<a class="group flex items-center px-3 py-3 text-blue-100 hover:bg-white/5 hover:text-white rounded-lg transition-colors" href="{{ route('dashboard.participants') }}">
<span class="material-icons group-hover:text-accent">groups</span>
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
<div class="flex items-center justify-between lg:justify-between bg-black/20 rounded-lg p-1.5 border border-white/5">
<button class="flex-1 text-xs font-bold text-white bg-white/20 shadow-sm px-2 py-1.5 rounded transition-all hover:bg-white/30">ID</button>
<div class="w-px h-4 bg-white/20 mx-1"></div>
<button class="flex-1 text-xs font-medium text-blue-200 hover:text-white px-2 py-1.5 rounded transition-colors">EN</button>
</div>
<button class="w-full flex items-center justify-center lg:justify-between gap-2 px-3 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-all border border-transparent hover:border-white/10" onclick="document.documentElement.classList.toggle('dark')">
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
<main class="flex-1 relative flex flex-col overflow-y-auto no-scrollbar">
<div class="absolute inset-0 z-0">
<img alt="Marathon runners active crowd in Jakarta morning" class="w-full h-full object-cover filter brightness-75 dark:brightness-50" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDZRiF2pskk4AQOiclOx-dh79wkwt0yZfoTFfFEpXiD-18Azy1AgayQLWGPXiUxwiV3-BiyNV58vfL91jNkYGAnpDa1AePnPift1sre5CAHSUgOg5OZd7CaY9THy0kRkcHiVoCTOxYgM95x3TlOmRdW0rr2nHdb9IYxkAAgRIEkbRwWfuzZ81s2TUjcDtQ4nCCNrCHzFOYnLF1Oh_oX40gpxwA5Xx_ICPNkHdXgqIZr9BnHRF4wfHaynRHpFzdd5PZ2DU5iwfg8qB8"/>
<div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 via-blue-900/70 to-transparent dark:from-gray-900/95 dark:via-gray-900/80 dark:to-transparent/30"></div>
</div>
<header class="lg:hidden h-16 flex items-center justify-between px-4 z-10 bg-primary/90 dark:bg-gray-900/90 backdrop-blur-sm border-b border-white/10">
<span class="font-display font-bold text-xl text-white italic">Kalcer<span class="text-accent">Run</span></span>
<button class="text-white">
<span class="material-icons">menu</span>
</button>
</header>
<div class="relative z-10 flex-1 flex flex-col lg:flex-row items-center justify-center lg:justify-between p-6 lg:p-16 gap-12">
<div class="lg:w-1/2 text-white space-y-6 animate-fade-in-up">
<div class="inline-flex items-center px-3 py-1 rounded-full border border-accent/50 bg-accent/10 backdrop-blur-sm text-accent text-xs font-bold uppercase tracking-wider mb-2">
<span class="w-2 h-2 rounded-full bg-accent mr-2 animate-pulse"></span>
                    Indonesia's #1 Running Platform
                </div>
<h2 class="text-5xl lg:text-7xl font-display font-bold leading-tight uppercase italic">
                    Push Your <br/>
<span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-accent">Limits</span>
</h2>
<p class="text-lg lg:text-xl text-blue-100 max-w-lg font-light">
                    Join the <strong>Pelari Kalcer</strong> movement. Manage events, track race packs, and view real-time leaderboards all in one seamless ecosystem.
                </p>
<div class="flex flex-wrap gap-4 pt-4">
<div class="bg-black/20 backdrop-blur-md rounded-xl p-4 border border-white/10 flex items-center gap-3 w-40">
<span class="material-icons text-yellow-400 text-3xl">emoji_events</span>
<div>
<div class="text-2xl font-display font-bold">50+</div>
<div class="text-xs text-blue-200">Active Events</div>
</div>
</div>
<div class="bg-black/20 backdrop-blur-md rounded-xl p-4 border border-white/10 flex items-center gap-3 w-40">
<span class="material-icons text-secondary text-3xl">groups</span>
<div>
<div class="text-2xl font-display font-bold">12k</div>
<div class="text-xs text-blue-200">Runners</div>
</div>
</div>
</div>
</div>
<div class="w-full max-w-md lg:w-1/3">
<div class="bg-card-light dark:bg-card-dark/95 backdrop-blur-xl rounded-2xl shadow-2xl overflow-hidden border border-white/20 dark:border-gray-700">
<div class="flex border-b border-gray-200 dark:border-gray-700">
<a href="{{ route('login') }}" class="flex-1 py-4 text-center font-bold text-primary border-b-2 border-primary bg-blue-50/50 dark:bg-blue-900/20 dark:text-blue-400 transition-all">Sign In</a>
<a href="{{ route('register') }}" class="flex-1 py-4 text-center font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">Sign Up</a>
</div>
<div class="p-8">
<div class="text-center mb-8">
<h3 class="text-2xl font-display font-bold text-gray-900 dark:text-white mb-2">Welcome Runner!</h3>
<p class="text-sm text-gray-500 dark:text-gray-400">Log in to manage your races &amp; results.</p>
</div>
<form class="space-y-5" method="POST" action="{{ route('login') }}">
@csrf
<div>
<label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" for="email">Email Address</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-icons text-gray-400 text-sm">email</span>
</div>
<input class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm text-gray-900 dark:text-white transition duration-150 ease-in-out" id="email" name="email" placeholder="runner@kalcer.id" type="email" required autofocus />
</div>
</div>
<div>
                <div x-data="{ showPassword: false }">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" for="password">Password</label>
                    <div class="relative">
                        <input 
                            class="block w-full pl-4 pr-10 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm text-gray-900 dark:text-white transition duration-150 ease-in-out" 
                            id="password" 
                            name="password" 
                            placeholder="••••••••" 
                            :type="showPassword ? 'text' : 'password'" 
                            required 
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" @click="showPassword = !showPassword" class="focus:outline-none text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                                <span class="material-icons text-sm" x-text="showPassword ? 'visibility' : 'visibility_off'"></span>
                            </button>
                        </div>
                    </div>
                </div>
</div>
<div class="flex justify-end">
<div class="text-xs">
<a class="font-medium text-primary hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300" href="#">
                                        Forgot password?
                                    </a>
</div>
</div>
<div>
<button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all transform hover:scale-[1.02]" type="submit">
                                    Sign In
                                </button>
</div>
</form>
<div class="mt-6">
<div class="relative">
<div class="absolute inset-0 flex items-center">
<div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
</div>
<div class="relative flex justify-center text-sm">
<span class="px-2 bg-white dark:bg-card-dark text-gray-500 dark:text-gray-400">
                                        Or continue with
                                    </span>
</div>
</div>
<div class="mt-6 grid grid-cols-2 gap-3">
<button class="w-full inline-flex justify-center items-center py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
<svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
<path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"></path>
</svg>
<span class="hidden sm:inline">Google</span>
</button>
<button class="w-full inline-flex justify-center items-center py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
<svg class="h-5 w-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
</svg>
<span class="hidden sm:inline">Facebook</span>
</button>
</div>
</div>
</div>
<div class="px-8 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700 text-center">
<p class="text-xs text-gray-500 dark:text-gray-400">
                            By signing in, you agree to our <a class="underline hover:text-primary" href="#">Terms</a> and <a class="underline hover:text-primary" href="#">Privacy Policy</a>.
                        </p>
</div>
</div>
</div>
</div>
<footer class="relative z-10 w-full bg-white/10 dark:bg-gray-900/80 backdrop-blur-md border-t border-white/10 dark:border-gray-800 text-white py-4 px-6 lg:px-12 flex justify-between items-center text-xs lg:text-sm">
<div class="flex items-center gap-4 opacity-70">
<span>© 2023 Kalcer Run System</span>
<span class="hidden lg:inline">•</span>
<span class="hidden lg:inline">v2.4.0 (Stable)</span>
</div>
<div class="flex items-center gap-6">
<a class="hover:text-accent transition-colors flex items-center gap-1" href="#">
<span class="material-icons text-sm">help_outline</span> Support
                 </a>
<div class="flex gap-3">
<div class="w-2 h-2 rounded-full bg-green-500"></div>
<span class="uppercase font-bold tracking-wider text-[10px] text-green-400">System Normal</span>
</div>
</div>
</footer>
</main>
</body></html>
