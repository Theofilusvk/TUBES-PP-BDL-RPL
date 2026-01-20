<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Kalcer Run - Detailed Sign Up</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;family=Oswald:wght@500;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
        }.glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .dark .glass-card {
            background: rgba(31, 41, 55, 0.95);
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
<span class="material-symbols-outlined">menu</span>
</button>
</header>
<div class="relative z-10 flex-1 flex flex-col lg:flex-row items-center justify-center lg:justify-between p-6 lg:p-16 gap-12">
<div class="hidden lg:block lg:w-1/2 text-white space-y-6 animate-fade-in-up">
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
<span class="material-symbols-outlined text-yellow-400 text-3xl">emoji_events</span>
<div>
<div class="text-2xl font-display font-bold">50+</div>
<div class="text-xs text-blue-200">Active Events</div>
</div>
</div>
<div class="bg-black/20 backdrop-blur-md rounded-xl p-4 border border-white/10 flex items-center gap-3 w-40">
<span class="material-symbols-outlined text-secondary text-3xl">groups</span>
<div>
<div class="text-2xl font-display font-bold">12k</div>
<div class="text-xs text-blue-200">Runners</div>
</div>
</div>
</div>
</div>
<div class="w-full max-w-lg lg:w-5/12">
<div class="glass-card rounded-2xl shadow-2xl overflow-hidden border border-white/20 dark:border-gray-700 flex flex-col max-h-[90vh]">
<div class="flex border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
<a href="<?php echo e(route('login')); ?>" class="flex-1 py-4 text-center font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">Sign In</a>
<a href="<?php echo e(route('register')); ?>" class="flex-1 py-4 text-center font-bold text-primary border-b-2 border-primary bg-blue-50/50 dark:bg-blue-900/20 dark:text-blue-400 transition-all">Sign Up</a>
</div>
<div class="p-8 overflow-y-auto no-scrollbar">
                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-display font-bold text-gray-900 dark:text-white mb-1">Join the Community</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Start your journey with Kalcer Run today.</p>
                            </div>

<form class="space-y-6" method="POST" action="<?php echo e(route('register')); ?>">
<?php echo csrf_field(); ?>
<div class="space-y-4">
<div class="flex items-center gap-2 mb-2">
<span class="flex items-center justify-center w-6 h-6 rounded-full bg-primary text-white text-xs font-bold">1</span>
<h4 class="text-sm font-bold uppercase tracking-wider text-gray-900 dark:text-gray-100">Account Setup</h4>
</div>
<div>
<label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5" for="fullname">Full Name</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-gray-400 text-sm">badge</span>
</div>
<input class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:ring-primary focus:border-primary sm:text-sm text-gray-900 dark:text-white <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="fullname" name="name" placeholder="John Doe" required="" type="text" value="<?php echo e(old('name')); ?>"/>
</div>
<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div>
<label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5" for="signup-email">Email Address</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-gray-400 text-sm">email</span>
</div>
<input class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:ring-primary focus:border-primary sm:text-sm text-gray-900 dark:text-white <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="signup-email" name="email" placeholder="runner@kalcer.id" required="" type="email" value="<?php echo e(old('email')); ?>"/>
</div>
<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div>
<label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5" for="signup-password">Create Password</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-gray-400 text-sm">lock</span>
</div>
<input class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:ring-primary focus:border-primary sm:text-sm text-gray-900 dark:text-white <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="signup-password" name="password" placeholder="Min. 8 characters" required="" type="password"/>
</div>
<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div>
<label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5" for="password_confirmation">Confirm Password</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-gray-400 text-sm">lock</span>
</div>
<input class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:ring-primary focus:border-primary sm:text-sm text-gray-900 dark:text-white" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required="" type="password"/>
</div>
</div>
</div>
<div class="space-y-4 pt-2">
<div class="flex items-center gap-2 mb-2">
<span class="flex items-center justify-center w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs font-bold group-hover:bg-primary group-hover:text-white transition-colors">2</span>
<h4 class="text-sm font-bold uppercase tracking-wider text-gray-900 dark:text-gray-100">Runner Profile</h4>
</div>
<div class="grid grid-cols-2 gap-4">
<div>
<label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5" for="dob">Date of Birth</label>
<input class="block w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:ring-primary focus:border-primary sm:text-sm text-gray-900 dark:text-white" id="dob" type="date"/>
</div>
<div>
<label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5" for="gender">Gender</label>
<select class="block w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:ring-primary focus:border-primary sm:text-sm text-gray-900 dark:text-white" id="gender">
<option value="">Select...</option>
<option value="male">Male</option>
<option value="female">Female</option>
</select>
</div>
</div>
<div class="grid grid-cols-2 gap-4">
<div>
<label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5" for="tshirt">T-Shirt Size</label>
<select class="block w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:ring-primary focus:border-primary sm:text-sm text-gray-900 dark:text-white" id="tshirt">
<option value="">Size...</option>
<option value="XS">XS</option>
<option value="S">S</option>
<option value="M">M</option>
<option value="L">L</option>
<option value="XL">XL</option>
<option value="XXL">XXL</option>
</select>
</div>
<div>
<label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5" for="bloodtype">Blood Type</label>
<select class="block w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:ring-primary focus:border-primary sm:text-sm text-gray-900 dark:text-white" id="bloodtype">
<option value="">Type...</option>
<option value="A+">A+</option>
<option value="A-">A-</option>
<option value="B+">B+</option>
<option value="B-">B-</option>
<option value="AB+">AB+</option>
<option value="AB-">AB-</option>
<option value="O+">O+</option>
<option value="O-">O-</option>
</select>
</div>
</div>
</div>
<div class="pt-2">
<button class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-bold text-white bg-gradient-to-r from-primary to-blue-600 hover:from-blue-600 hover:to-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all transform hover:scale-[1.02]" type="submit">
                                Create Account
                                <span class="material-symbols-outlined text-sm ml-2">arrow_forward</span>
</button>
</div>
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
<span class="material-symbols-outlined text-sm">help_outline</span> Support
            </a>
<div class="flex gap-3">
<div class="w-2 h-2 rounded-full bg-green-500"></div>
<span class="uppercase font-bold tracking-wider text-[10px] text-green-400">System Normal</span>
</div>
</div>
</footer>
</main>
</body></html>
<?php /**PATH C:\Kuliah\Semester 3\Rekayasa Perangkat Lunak\TUBES-PP-BDL-RPL\Running_Event_Management\resources\views/auth/register.blade.php ENDPATH**/ ?>