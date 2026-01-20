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
@if($errors->any())
    <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-center gap-3 animate-pulse">
        <span class="material-icons text-red-500">error</span>
        <span class="text-sm text-red-600 dark:text-red-400 font-bold">
            {{ $errors->first() }}
        </span>
    </div>
@endif
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
</div>

@error('password')
    <div class="mt-2 p-2 bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-800 rounded-lg flex items-center gap-2">
        <span class="material-icons text-red-500 text-sm">error_outline</span>
        <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
    </div>
@enderror

<div>
<button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all transform hover:scale-[1.02]" type="submit">
                                    Sign In
                                </button>
</div>

@error('email')
    <div class="mt-4 p-3 bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-800 rounded-lg flex items-center gap-3">
        <span class="material-icons text-red-500 text-xl">error_outline</span>
        <span class="text-sm text-red-600 dark:text-red-400 font-medium">{{ $message }}</span>
    </div>
@enderror

</form>

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
