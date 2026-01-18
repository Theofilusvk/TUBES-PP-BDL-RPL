<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Kalcer Run - Settings</title>
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
              primary: "#2563EB", // Vibrant Royal Blue/Electric Blue
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
        }.toggle-checkbox:checked {
            right: 0;
            border-color: #2563EB;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #2563EB;
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
<aside class="w-20 lg:w-64 flex-shrink-0 bg-primary dark:bg-slate-900 flex flex-col justify-between border-r border-white/10 dark:border-gray-800 transition-all duration-300 z-20">
<div>
<div class="h-20 flex items-center justify-center lg:justify-start lg:px-6 border-b border-white/10 dark:border-gray-800">
<div class="flex items-center gap-3">
<span class="material-icons text-3xl text-white">directions_run</span>
<h1 class="hidden lg:block font-display font-bold text-2xl text-white tracking-wide uppercase italic">Kalcer<span class="text-accent">Run</span></h1>
</div>
</div>
<nav class="mt-8 px-2 space-y-2">
<a class="group flex items-center px-3 py-3 text-blue-100 hover:bg-white/5 hover:text-white rounded-lg transition-colors" href="{{ route('dashboard') }}">
<span class="material-icons group-hover:text-accent">dashboard</span>
<span class="hidden lg:block ml-3 font-medium">Dashboard</span>
</a>
<div class="hidden lg:block px-3 mt-6 mb-2 text-xs font-semibold text-blue-200 uppercase tracking-wider">Management</div>
<a class="group flex items-center px-3 py-3 text-blue-100 hover:bg-white/5 hover:text-white rounded-lg transition-colors cursor-pointer" href="{{ route('dashboard.events') }}">
<span class="material-icons group-hover:text-accent">calendar_today</span>
<span class="hidden lg:block ml-3 font-medium flex-1">Events</span>
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
<a class="group flex items-center px-3 py-3 text-white bg-white/10 rounded-lg transition-colors shadow-inner" href="{{ route('dashboard.settings') }}">
<span class="material-icons text-accent">settings</span>
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
<main class="flex-1 flex flex-col overflow-y-auto no-scrollbar relative bg-background-light dark:bg-background-dark fade-in">
<header class="lg:hidden h-16 flex items-center justify-between px-4 z-10 bg-primary dark:bg-slate-900 border-b border-white/10 dark:border-gray-800 shadow-md">
<div class="flex items-center gap-2">
<span class="material-icons text-white">settings</span>
<span class="font-display font-bold text-lg text-white">Settings</span>
</div>
<button class="text-white">
<span class="material-icons">menu</span>
</button>
</header>
<div class="p-6 lg:p-10 w-full max-w-7xl mx-auto space-y-8">
<div>
<h1 class="text-3xl font-display font-bold text-gray-900 dark:text-white uppercase italic tracking-wide">
                Account <span class="text-primary">&amp; System</span>
</h1>
<p class="text-gray-500 dark:text-gray-400 mt-2 text-sm lg:text-base">
                Manage your profile, security, and application preferences.
            </p>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
    @if(session('success'))
    <div class="lg:col-span-3 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
<div class="lg:col-span-2 space-y-6">
<div class="bg-card-light dark:bg-card-dark rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
<div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex items-center gap-3">
<div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
<span class="material-icons text-primary text-xl">person</span>
</div>
<h2 class="font-bold text-gray-800 dark:text-white">Profile Settings</h2>
</div>
<div class="p-6 lg:p-8">
<form action="{{ route('dashboard.settings.update-profile') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="flex flex-col sm:flex-row gap-8 items-start">
<div class="flex-shrink-0 flex flex-col items-center gap-3">
<div class="relative group cursor-pointer">
<div class="w-28 h-28 rounded-full overflow-hidden border-4 border-gray-100 dark:border-gray-600 shadow-sm">
<img id="preview-image" alt="Profile" class="w-full h-full object-cover transition-transform group-hover:scale-105" src="{{ Auth::user()->Gambar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->NamaLengkap ?? 'User') . '&background=random' }}"/>
</div>
<div class="absolute inset-0 bg-black/40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity" onclick="document.getElementById('profile-upload').click()">
<span class="material-icons text-white">edit</span>
</div>
<button type="button" class="absolute bottom-1 right-1 bg-primary text-white p-2 rounded-full shadow-lg hover:bg-blue-600 transition-colors" onclick="document.getElementById('profile-upload').click()">
<span class="material-icons text-xs">photo_camera</span>
</button>
<input type="file" id="profile-upload" name="Gambar" class="hidden" accept="image/*" onchange="previewImage(this)">
</div>
<span class="text-xs text-gray-500 dark:text-gray-400">Allowed: JPG, PNG</span>
@error('Gambar') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
</div>
<div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-5 w-full">
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Full Name</label>
<input name="NamaLengkap" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary focus:border-primary transition-shadow" type="text" value="{{ Auth::user()->NamaLengkap }}"/>
@error('NamaLengkap') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
</div>
<div>
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Username</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">@</span>
<input name="Username" class="w-full pl-7 rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary focus:border-primary transition-shadow" type="text" value="{{ Auth::user()->Username }}"/>
</div>
@error('Username') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
</div>
<div>
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Phone Number</label>
<input name="NomorTelepon" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary focus:border-primary transition-shadow" type="tel" value="{{ Auth::user()->NomorTelepon }}"/>
@error('NomorTelepon') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
</div>
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Email</label>
<input name="Email" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary focus:border-primary transition-shadow" type="email" value="{{ Auth::user()->Email }}"/>
@error('Email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
</div>
</div>
</div>
<div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end">
<button type="submit" class="px-6 py-2.5 bg-primary hover:bg-blue-600 text-white font-medium rounded-lg shadow-sm transition-all transform hover:translate-y-px active:translate-y-0">
                                Save Changes
                            </button>
</div>
</form>
</div>
</div>
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<div class="bg-card-light dark:bg-card-dark rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
<div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex items-center gap-3">
<div class="p-2 bg-rose-100 dark:bg-rose-900/30 rounded-lg">
<span class="material-icons text-accent text-xl">lock_reset</span>
</div>
<h2 class="font-bold text-gray-800 dark:text-white">Security &amp; Login</h2>
</div>
<div class="p-6 lg:p-8 space-y-6">
<form action="{{ route('dashboard.settings.update-password') }}" method="POST">
@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Current Password</label>
<input name="current_password" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-accent focus:border-accent" placeholder="••••••••" type="password"/>
@error('current_password') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
</div>
<div>
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">New Password</label>
<input name="new_password" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-accent focus:border-accent" type="password"/>
@error('new_password') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
</div>
<div>
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Confirm Password</label>
<input name="new_password_confirmation" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-accent focus:border-accent" type="password"/>
</div>
</div>
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
<button type="button" class="w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
<span class="material-icons text-sm">phonelink_lock</span>
                                Manage 2FA
                            </button>
<button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-medium rounded-lg shadow-sm hover:opacity-90 transition-opacity">
                                Update Password
                            </button>
</div>
</form>
</div>
</div>
</div>
<div class="space-y-6">
<div class="bg-card-light dark:bg-card-dark rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
<div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex items-center gap-3">
<div class="p-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg">
<span class="material-icons text-secondary text-xl">tune</span>
</div>
<h2 class="font-bold text-gray-800 dark:text-white">Preferences</h2>
</div>
<div class="p-6 space-y-6">
<div class="flex items-center justify-between">
<div>
<h3 class="text-sm font-semibold text-gray-900 dark:text-white">Email Notifications</h3>
<p class="text-xs text-gray-500 dark:text-gray-400">Receive race updates &amp; news</p>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox"/>
<div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-secondary"></div>
</label>
</div>
<hr class="border-gray-100 dark:border-gray-700"/>
<div>
<h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Language</h3>
<div class="flex bg-gray-100 dark:bg-gray-900 p-1 rounded-lg">
<button class="flex-1 text-xs font-medium py-2 rounded-md bg-white dark:bg-gray-700 shadow-sm text-primary dark:text-white transition-all">English</button>
<button class="flex-1 text-xs font-medium py-2 rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-all">Bahasa Indonesia</button>
</div>
</div>
<hr class="border-gray-100 dark:border-gray-700"/>
<div class="flex items-center justify-between">
<div>
<h3 class="text-sm font-semibold text-gray-900 dark:text-white">Appearance</h3>
<p class="text-xs text-gray-500 dark:text-gray-400">Toggle light/dark theme</p>
</div>
<button class="relative inline-flex items-center cursor-pointer" onclick="document.documentElement.classList.toggle('dark')">
<div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full dark:bg-primary transition-colors flex items-center px-0.5">
<div class="w-5 h-5 bg-white rounded-full shadow-md transform transition-transform duration-300 translate-x-0 dark:translate-x-5"></div>
</div>
</button>
</div>
</div>
</div>
<div class="bg-card-light dark:bg-card-dark rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
<div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex items-center gap-3">
<div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
<span class="material-icons text-gray-500 dark:text-gray-300 text-xl">info</span>
</div>
<h2 class="font-bold text-gray-800 dark:text-white">System Info</h2>
</div>
<div class="p-6">
<div class="flex justify-between items-center mb-4">
<span class="text-sm text-gray-500 dark:text-gray-400">App Version</span>
<span class="text-sm font-mono font-medium text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">v2.4.0 (Stable)</span>
</div>
<div class="space-y-2">
<a class="flex items-center justify-between text-sm text-primary hover:text-blue-700 dark:hover:text-blue-300 group" href="#">
<span>Terms of Service</span>
<span class="material-icons text-xs opacity-0 group-hover:opacity-100 transition-opacity">open_in_new</span>
</a>
<a class="flex items-center justify-between text-sm text-primary hover:text-blue-700 dark:hover:text-blue-300 group" href="#">
<span>Privacy Policy</span>
<span class="material-icons text-xs opacity-0 group-hover:opacity-100 transition-opacity">open_in_new</span>
</a>
</div>
<div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700 text-center">
<p class="text-xs text-gray-400">© 2023 Kalcer Run System</p>
</div>
</div>
</div>
</div>
</div>
</div>
</main>
</body></html>
