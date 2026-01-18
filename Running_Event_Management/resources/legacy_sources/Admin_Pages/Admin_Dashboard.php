<!DOCTYPE html>
<html class="dark" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin Central | Pelari Kalcer</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#00ff80", // Neon Green
                        "background-light": "#fafafa",
                        "background-dark": "#121416", // Dark background
                        "surface-dark": "#1c1f23",
                        "border-dark": "#2d3239",
                    },
                    fontFamily: {
                        "display": ["Space Grotesk", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                },
            },
        }
    </script>
<style>
        .sidebar-item-active {
            background: linear-gradient(90deg, rgba(0, 255, 128, 0.15) 0%, rgba(0, 255, 128, 0) 100%);
            border-left: 3px solid #00ff80;
        }
        .kalcer-grid {
            background-image: radial-gradient(#2d3239 1px, transparent 1px);
            background-size: 32px 32px;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-800 dark:text-slate-200 transition-colors duration-200 selection:bg-primary selection:text-background-dark">
<div class="flex h-screen overflow-hidden kalcer-grid">
<aside class="w-72 bg-background-light dark:bg-background-dark border-r border-slate-200 dark:border-border-dark flex flex-col z-20">
<div class="p-6 border-b border-slate-200 dark:border-border-dark flex items-center gap-3">
<div class="w-10 h-10 bg-primary flex items-center justify-center rounded-sm shadow-[0_0_15px_rgba(0,255,128,0.3)]">
<span class="material-symbols-outlined text-background-dark font-bold">bolt</span>
</div>
<div>
<h1 class="text-lg font-bold tracking-tighter text-slate-900 dark:text-white uppercase leading-none">Admin Central</h1>
<p class="text-[10px] uppercase tracking-[0.2em] text-primary font-bold">Pelari Kalcer</p>
</div>
</div>
<nav class="flex-1 py-6">
<div class="space-y-1">
<a class="sidebar-item-active flex items-center gap-4 px-6 py-3 group transition-all" href="#">
<span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">dashboard</span>
<span class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider">Dashboard</span>
</a>
<a class="flex items-center gap-4 px-6 py-3 text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-all group" href="#">
<span class="material-symbols-outlined group-hover:scale-110 transition-transform">group</span>
<span class="text-sm font-semibold uppercase tracking-wider">User Management</span>
</a>
<a class="flex items-center gap-4 px-6 py-3 text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-all group" href="#">
<span class="material-symbols-outlined group-hover:scale-110 transition-transform">event_seat</span>
<span class="text-sm font-semibold uppercase tracking-wider">Event Configuration</span>
</a>
<a class="flex items-center gap-4 px-6 py-3 text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-all group" href="#">
<span class="material-symbols-outlined group-hover:scale-110 transition-transform">account_balance_wallet</span>
<span class="text-sm font-semibold uppercase tracking-wider">Financial Reports</span>
</a>
<a class="flex items-center gap-4 px-6 py-3 text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-all group" href="#">
<span class="material-symbols-outlined group-hover:scale-110 transition-transform">database</span>
<span class="text-sm font-semibold uppercase tracking-wider">Database Triggers</span>
</a>
</div>
</nav>
<div class="p-6 mt-auto border-t border-slate-200 dark:border-border-dark">
<div class="flex items-center gap-3 mb-4">
<div class="w-10 h-10 rounded-full border-2 border-primary overflow-hidden shadow-[0_0_10px_rgba(0,255,128,0.2)]">
<img class="w-full h-full object-cover" data-alt="Admin profile avatar" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCNKmw_zERdI-sZRx4B8jm2zDp_aZY7pNF-8yrsVpp1eoMoCziqMr2rYfTbSk-xhHFlR4fWbnAsLGS77tymdSvbziAyZb2Ioe5AQglORCZEdwOem4S9tpP3MolZ-iCDNSVGISgggnF3L2AVioBBjJ_xmGlQXXIW_z1GBtnEKmxGRGCDNGUJ3SMEUWhhXslQyY0-mSEqOmROSV2LVwLroqxXL1AW5RLHdrOsOWmvapI3T8Hm9v4mGWE4vQw44qyF0qn1iH5hSvieGX0"/>
</div>
<div>
<p class="text-sm font-bold text-slate-900 dark:text-white">Admin Utama</p>
<p class="text-xs text-slate-500">Root Access</p>
</div>
</div>
<button class="w-full flex items-center justify-center gap-2 py-2 px-4 rounded bg-slate-100 dark:bg-surface-dark border border-slate-200 dark:border-border-dark text-slate-600 dark:text-slate-400 hover:text-primary hover:border-primary transition-colors">
<span class="material-symbols-outlined text-sm">logout</span>
<span class="text-xs font-bold uppercase tracking-widest">Sign Out</span>
</button>
</div>
</aside>
<main class="flex-1 flex flex-col overflow-y-auto">
<header class="h-20 flex items-center justify-between px-10 border-b border-slate-200 dark:border-border-dark bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md sticky top-0 z-10">
<div class="flex items-center gap-2">
<span class="text-xs font-bold text-primary uppercase tracking-[0.3em] shadow-primary drop-shadow-sm">System Status:</span>
<div class="flex items-center gap-1.5">
<div class="w-2 h-2 rounded-full bg-primary animate-pulse shadow-[0_0_8px_#00ff80]"></div>
<span class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">Nominal</span>
</div>
</div>
<div class="flex items-center gap-6">
<div class="flex p-1 bg-slate-100 dark:bg-surface-dark border border-slate-200 dark:border-border-dark rounded-sm">
<button class="px-3 py-1 text-[10px] font-bold tracking-tighter bg-primary text-background-dark rounded-sm">ID</button>
<button class="px-3 py-1 text-[10px] font-bold tracking-tighter text-slate-500 hover:text-primary transition-colors">EN</button>
</div>
<div class="flex items-center gap-4">
<button class="p-2 text-slate-500 hover:text-primary transition-colors relative">
<span class="material-symbols-outlined">notifications</span>
<span class="absolute top-2 right-2 w-1.5 h-1.5 bg-primary rounded-full shadow-[0_0_5px_#00ff80]"></span>
</button>
<button class="p-2 text-slate-500 hover:text-primary transition-colors">
<span class="material-symbols-outlined">settings</span>
</button>
</div>
</div>
</header>
<div class="p-10 space-y-10">
<div class="flex flex-col gap-2">
<h2 class="text-4xl font-bold tracking-tighter text-slate-900 dark:text-white uppercase leading-none">
                    Dashboard Overview<span class="text-primary drop-shadow-[0_0_8px_rgba(0,255,128,0.5)]">.</span>
</h2>
<p class="text-slate-500 dark:text-slate-400 tracking-wide">Real-time system monitoring and performance metrics across the Kalcer ecosystem.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<div class="p-6 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark flex flex-col justify-between group hover:border-primary hover:shadow-[0_0_20px_rgba(0,255,128,0.05)] transition-all duration-300">
<div>
<div class="flex justify-between items-start mb-4">
<span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">groups</span>
<span class="text-xs font-bold text-primary px-2 py-1 bg-primary/10 rounded-sm">+12%</span>
</div>
<p class="text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-1">Total Active Users</p>
<p class="text-3xl font-bold tracking-tighter text-slate-900 dark:text-white">12,402</p>
</div>
</div>
<div class="p-6 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark flex flex-col justify-between group hover:border-primary hover:shadow-[0_0_20px_rgba(0,255,128,0.05)] transition-all duration-300">
<div>
<div class="flex justify-between items-start mb-4">
<span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">stadium</span>
<span class="text-xs font-bold text-primary px-2 py-1 bg-primary/10 rounded-sm">LIVE</span>
</div>
<p class="text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-1">Ongoing Events</p>
<p class="text-3xl font-bold tracking-tighter text-slate-900 dark:text-white">8 Active Races</p>
</div>
</div>
<div class="p-6 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark flex flex-col justify-between group hover:border-primary hover:shadow-[0_0_20px_rgba(0,255,128,0.05)] transition-all duration-300">
<div>
<div class="flex justify-between items-start mb-4">
<span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">payments</span>
<span class="text-xs font-bold text-primary px-2 py-1 bg-primary/10 rounded-sm">-5%</span>
</div>
<p class="text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-1">Total Revenue</p>
<p class="text-3xl font-bold tracking-tighter text-slate-900 dark:text-white">Rp 420.5M</p>
</div>
</div>
<div class="p-6 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark flex flex-col justify-between group hover:border-primary hover:shadow-[0_0_20px_rgba(0,255,128,0.05)] transition-all duration-300">
<div>
<div class="flex justify-between items-start mb-4">
<span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">dynamic_form</span>
<span class="text-xs font-bold text-primary px-2 py-1 bg-primary/10 rounded-sm">99.9%</span>
</div>
<p class="text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-1">System Health</p>
<p class="text-3xl font-bold tracking-tighter text-primary drop-shadow-[0_0_5px_rgba(0,255,128,0.5)]">OPERATIONAL</p>
</div>
</div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
<div class="lg:col-span-2 p-8 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark hover:border-primary/50 transition-colors">
<div class="flex items-center justify-between mb-8">
<h3 class="text-lg font-bold uppercase tracking-widest text-slate-900 dark:text-white">Registration Analytics</h3>
<div class="flex gap-2">
<button class="text-[10px] font-bold px-3 py-1 border border-border-dark bg-background-dark/20 text-slate-400 hover:text-primary hover:border-primary transition-colors">7D</button>
<button class="text-[10px] font-bold px-3 py-1 bg-primary text-background-dark shadow-[0_0_10px_rgba(0,255,128,0.4)]">30D</button>
</div>
</div>
<div class="aspect-[16/7] relative border-l border-b border-border-dark flex items-end justify-between px-2 pb-2">
<div class="w-[8%] bg-primary/20 h-[40%] border-t-2 border-primary shadow-[0_0_10px_rgba(0,255,128,0.1)] hover:bg-primary/40 transition-all"></div>
<div class="w-[8%] bg-primary/20 h-[60%] border-t-2 border-primary shadow-[0_0_10px_rgba(0,255,128,0.1)] hover:bg-primary/40 transition-all"></div>
<div class="w-[8%] bg-primary/20 h-[55%] border-t-2 border-primary shadow-[0_0_10px_rgba(0,255,128,0.1)] hover:bg-primary/40 transition-all"></div>
<div class="w-[8%] bg-primary/20 h-[85%] border-t-2 border-primary shadow-[0_0_10px_rgba(0,255,128,0.1)] hover:bg-primary/40 transition-all"></div>
<div class="w-[8%] bg-primary/20 h-[70%] border-t-2 border-primary shadow-[0_0_10px_rgba(0,255,128,0.1)] hover:bg-primary/40 transition-all"></div>
<div class="w-[8%] bg-primary/20 h-[90%] border-t-2 border-primary shadow-[0_0_10px_rgba(0,255,128,0.1)] hover:bg-primary/40 transition-all"></div>
<div class="w-[8%] bg-primary/20 h-[65%] border-t-2 border-primary shadow-[0_0_10px_rgba(0,255,128,0.1)] hover:bg-primary/40 transition-all"></div>
<div class="w-[8%] bg-primary/20 h-[80%] border-t-2 border-primary shadow-[0_0_10px_rgba(0,255,128,0.1)] hover:bg-primary/40 transition-all"></div>
<div class="w-[8%] bg-primary/20 h-[95%] border-t-2 border-primary shadow-[0_0_10px_rgba(0,255,128,0.1)] hover:bg-primary/40 transition-all"></div>
<div class="w-[8%] bg-primary/20 h-[75%] border-t-2 border-primary shadow-[0_0_10px_rgba(0,255,128,0.1)] hover:bg-primary/40 transition-all"></div>
</div>
</div>
<div class="p-8 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark hover:border-primary/50 transition-colors">
<h3 class="text-lg font-bold uppercase tracking-widest text-slate-900 dark:text-white mb-6">Recent Triggers</h3>
<div class="space-y-6">
<div class="flex gap-4 items-start group">
<div class="mt-1 w-2 h-2 rounded-full bg-primary shadow-[0_0_5px_#00ff80]"></div>
<div>
<p class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider group-hover:text-primary transition-colors">Race.Finish_Sync</p>
<p class="text-[10px] text-slate-500">2 minutes ago • SUCCESS</p>
</div>
</div>
<div class="flex gap-4 items-start opacity-70 group">
<div class="mt-1 w-2 h-2 rounded-full bg-slate-500"></div>
<div>
<p class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider group-hover:text-primary transition-colors">User.Bulk_Verify</p>
<p class="text-[10px] text-slate-500">14 minutes ago • QUEUED</p>
</div>
</div>
<div class="flex gap-4 items-start group">
<div class="mt-1 w-2 h-2 rounded-full bg-red-500 shadow-[0_0_5px_rgba(239,68,68,0.5)]"></div>
<div>
<p class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider group-hover:text-red-400 transition-colors">Payment.Hook_Failure</p>
<p class="text-[10px] text-slate-500">28 minutes ago • ERROR</p>
</div>
</div>
<div class="flex gap-4 items-start group">
<div class="mt-1 w-2 h-2 rounded-full bg-primary shadow-[0_0_5px_#00ff80]"></div>
<div>
<p class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider group-hover:text-primary transition-colors">Event.Auto_Archive</p>
<p class="text-[10px] text-slate-500">1 hour ago • SUCCESS</p>
</div>
</div>
</div>
<button class="mt-8 w-full py-3 border border-border-dark text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:bg-primary hover:text-background-dark hover:border-primary transition-all duration-300">
                        View All Logs
                    </button>
</div>
</div>
<div class="flex flex-wrap justify-between items-center pt-10 border-t border-slate-200 dark:border-border-dark opacity-50">
<p class="text-[10px] uppercase tracking-[0.4em] font-bold">Admin Central V2.4.0-Stable</p>
<div class="flex gap-8">
<div class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-primary shadow-[0_0_5px_#00ff80]"></span>
<span class="text-[10px] font-bold uppercase tracking-widest">API: Online</span>
</div>
<div class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-primary shadow-[0_0_5px_#00ff80]"></span>
<span class="text-[10px] font-bold uppercase tracking-widest">DB: Latency 14ms</span>
</div>
</div>
</div>
</div>
</main>
</div>

</body></html>