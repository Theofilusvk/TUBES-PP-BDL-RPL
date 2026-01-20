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
<body x-data="{ showLogoutModal: false }" class="bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 font-sans h-screen flex overflow-hidden selection:bg-primary selection:text-white transition-colors duration-300">
<aside class="w-20 lg:w-64 flex-shrink-0 bg-primary dark:bg-slate-900 flex flex-col justify-between border-r border-white/10 dark:border-gray-800 transition-all duration-300 z-20">
<div>
<div class="h-20 flex items-center justify-center lg:justify-start lg:px-6 border-b border-white/10 dark:border-gray-800">
<div class="flex items-center gap-3">
<span class="material-icons text-3xl text-white">directions_run</span>
<h1 class="hidden lg:block font-display font-bold text-2xl text-white tracking-wide uppercase italic">Kalcer<span class="text-accent">Run</span></h1>
</div>
</div>
<nav class="mt-8 px-2 space-y-2">
<a class="group flex items-center px-3 py-3 text-blue-100 hover:bg-white/5 hover:text-white rounded-lg transition-colors" href="<?php echo e(route('dashboard')); ?>">
<span class="material-icons group-hover:text-accent">dashboard</span>
<span class="hidden lg:block ml-3 font-medium">Dashboard</span>
</a>
<div class="hidden lg:block px-3 mt-6 mb-2 text-xs font-semibold text-blue-200 uppercase tracking-wider">Management</div>
<a class="group flex items-center px-3 py-3 text-blue-100 hover:bg-white/5 hover:text-white rounded-lg transition-colors cursor-pointer" href="<?php echo e(route('dashboard.events')); ?>">
<span class="material-icons group-hover:text-accent">calendar_today</span>
<span class="hidden lg:block ml-3 font-medium flex-1">Events</span>
</a>

<div class="hidden lg:block px-3 mt-6 mb-2 text-xs font-semibold text-blue-200 uppercase tracking-wider">Race Data</div>
<a class="group flex items-center px-3 py-3 text-blue-100 hover:bg-white/5 hover:text-white rounded-lg transition-colors" href="<?php echo e(route('dashboard.results')); ?>">
<span class="material-icons group-hover:text-accent">timer</span>
<span class="hidden lg:block ml-3 font-medium">Results &amp; Timing</span>
</a>
<a class="group flex items-center px-3 py-3 text-blue-100 hover:bg-white/5 hover:text-white rounded-lg transition-colors" href="<?php echo e(route('dashboard.leaderboards')); ?>">
<span class="material-icons group-hover:text-accent">emoji_events</span>
<span class="hidden lg:block ml-3 font-medium">Leaderboards</span>
</a>
</nav>
</div>
<div class="p-4 border-t border-white/10 dark:border-gray-800">
<a class="group flex items-center px-3 py-3 text-white bg-white/10 rounded-lg transition-colors shadow-inner" href="<?php echo e(route('dashboard.settings')); ?>">
<span class="material-icons text-accent">settings</span>
<span class="hidden lg:block ml-3 font-medium">Settings</span>
</a>
<div class="mt-4 flex flex-col gap-3 px-1">

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
    <?php if(session('success')): ?>
    <div class="lg:col-span-3 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline"><?php echo e(session('success')); ?></span>
    </div>
    <?php endif; ?>
<div class="lg:col-span-2 space-y-6">
<div class="bg-card-light dark:bg-card-dark rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
<div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex items-center gap-3">
<div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
<span class="material-icons text-primary text-xl">person</span>
</div>
<h2 class="font-bold text-gray-800 dark:text-white">Profile Settings</h2>
</div>
<div class="p-6 lg:p-8">
<form action="<?php echo e(route('dashboard.settings.update-profile')); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<div class="flex flex-col sm:flex-row gap-8 items-start">
<div class="flex-shrink-0 flex flex-col items-center gap-3">
<div class="relative group cursor-pointer">
<div class="w-28 h-28 rounded-full overflow-hidden border-4 border-gray-100 dark:border-gray-600 shadow-sm">
<img id="preview-image" alt="Profile" class="w-full h-full object-cover transition-transform group-hover:scale-105" src="<?php echo e(Auth::user()->Gambar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->NamaLengkap ?? 'User') . '&background=random'); ?>"/>
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
<?php $__errorArgs = ['Gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-5 w-full">
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Full Name</label>
<input name="NamaLengkap" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary focus:border-primary transition-shadow" type="text" value="<?php echo e(Auth::user()->NamaLengkap); ?>"/>
<?php $__errorArgs = ['NamaLengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div>
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Username</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">@</span>
<input name="Username" class="w-full pl-7 rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary focus:border-primary transition-shadow" type="text" value="<?php echo e(Auth::user()->Username); ?>"/>
</div>
<?php $__errorArgs = ['Username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Phone Number</label>
                                    <input name="NomorTelepon" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary focus:border-primary transition-shadow" type="tel" value="<?php echo e(Auth::user()->NomorTelepon); ?>"/>
                                    <?php $__errorArgs = ['NomorTelepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">City / Domicile</label>
                                    <input name="Kota" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary focus:border-primary transition-shadow" type="text" value="<?php echo e(Auth::user()->Kota ?? ''); ?>" placeholder="e.g. Jakarta, Bandung"/>
                                    <?php $__errorArgs = ['Kota'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Email</label>
<input name="Email" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary focus:border-primary transition-shadow" type="email" value="<?php echo e(Auth::user()->Email); ?>"/>
<?php $__errorArgs = ['Email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<form action="<?php echo e(route('dashboard.settings.update-password')); ?>" method="POST">
<?php echo csrf_field(); ?>
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Current Password</label>
<input name="current_password" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-accent focus:border-accent" placeholder="••••••••" type="password"/>
<?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div>
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">New Password</label>
<input name="new_password" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-accent focus:border-accent" type="password"/>
<?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div>
<label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Confirm Password</label>
<input name="new_password_confirmation" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-accent focus:border-accent" type="password"/>
</div>
</div>
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
<button type="button" @click="showLogoutModal = true" class="w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2 border border-red-200 dark:border-red-900 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
<span class="material-icons text-sm">logout</span>
                                Log Out
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
    <!-- Logout Confirmation Modal -->
    <div x-show="showLogoutModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showLogoutModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showLogoutModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="showLogoutModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30 sm:mx-0 sm:h-10 sm:w-10">
                            <span class="material-icons text-red-600 dark:text-red-400">warning</span>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                Log Out
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Are you sure you want to log out?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-full sm:w-auto sm:ml-3">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                            Yes, Log Out
                        </button>
                    </form>
                    <button type="button" @click="showLogoutModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        No
                    </button>
                </div>
            </div>
        </div>
    </div>
</body></html>
<?php /**PATH C:\Kuliah\Semester 3\Rekayasa Perangkat Lunak\TUBES-PP-BDL-RPL\Running_Event_Management\resources\views/dashboard/settings/index.blade.php ENDPATH**/ ?>