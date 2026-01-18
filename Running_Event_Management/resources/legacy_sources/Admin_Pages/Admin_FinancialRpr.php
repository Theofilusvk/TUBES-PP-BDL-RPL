<!DOCTYPE html>
<html class="dark" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin Financial Analytics Report - Pelari Kalcer</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#39FF14",
                        "background-dark": "#0A0A0A",
                        "card-dark": "#141414",
                        "border-dark": "#1F1F1F",
                        "accent-neon": "#39FF14",
                    },
                    fontFamily: {
                        "sans": ["Plus Jakarta Sans", "sans-serif"]
                    },
                },
            },
        }
    </script>
<style type="text/tailwindcss">
        @layer base {
            body {
                @apply bg-background-dark text-gray-100;
            }
        }
        .sidebar-item {
            @apply flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 transition-all duration-200 hover:text-white hover:bg-white/5;
        }
        .active-nav {
            @apply bg-accent-neon/10 text-accent-neon;
        }
        .neon-glow {
            text-shadow: 0 0 10px rgba(57, 255, 20, 0.4);
        }
        .neon-border {
            box-shadow: 0 0 15px rgba(57, 255, 20, 0.1);
        }
    </style>
</head>
<body class="antialiased font-sans">
<div class="flex min-h-screen">
<aside class="w-72 border-r border-border-dark bg-background-dark flex flex-col fixed h-full z-20">
<div class="p-8">
<div class="flex items-center gap-3 mb-1">
<div class="bg-accent-neon p-2 rounded-lg">
<span class="material-symbols-outlined text-black font-bold">bolt</span>
</div>
<h1 class="text-xl font-extrabold tracking-tight text-white italic">PELARI <span class="text-accent-neon">KALCER</span></h1>
</div>
<p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em] mt-2">Admin Infrastructure</p>
</div>
<nav class="flex-1 px-4 space-y-2">
<a class="sidebar-item" href="#">
<span class="material-symbols-outlined text-xl">grid_view</span>
<span class="text-sm font-bold">Dashboard</span>
</a>
<a class="sidebar-item" href="#">
<span class="material-symbols-outlined text-xl">group</span>
<span class="text-sm font-bold">User Management</span>
</a>
<a class="sidebar-item" href="#">
<span class="material-symbols-outlined text-xl">settings_input_component</span>
<span class="text-sm font-bold">Event Configuration</span>
</a>
<a class="sidebar-item active-nav" href="#">
<span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1">monitoring</span>
<span class="text-sm font-bold">Financial Reports</span>
</a>
<a class="sidebar-item" href="#">
<span class="material-symbols-outlined text-xl">database</span>
<span class="text-sm font-bold">Database Triggers</span>
</a>
</nav>
<div class="p-6 border-t border-border-dark">
<div class="bg-card-dark rounded-2xl p-4 border border-border-dark">
<div class="flex items-center gap-3">
<div class="size-10 rounded-full bg-accent-neon/20 flex items-center justify-center border border-accent-neon/30">
<span class="text-accent-neon text-xs font-bold">AD</span>
</div>
<div class="flex-1 min-w-0">
<p class="text-xs font-bold text-white truncate">Super Admin</p>
<p class="text-[10px] text-gray-500 font-medium truncate">Master Controller</p>
</div>
<span class="material-symbols-outlined text-gray-500 text-lg">logout</span>
</div>
</div>
</div>
</aside>
<main class="flex-1 ml-72">
<header class="sticky top-0 z-10 flex items-center justify-between px-10 py-6 bg-background-dark/80 backdrop-blur-xl border-b border-border-dark">
<div>
<h2 class="text-2xl font-black text-white tracking-tight uppercase italic neon-glow">Financial Analytics <span class="text-accent-neon">Report</span></h2>
<div class="flex items-center gap-2 mt-1">
<span class="size-2 rounded-full bg-accent-neon animate-pulse"></span>
<p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Live View: v_rekap_keuangan_event</p>
</div>
</div>
<div class="flex items-center gap-6">
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-xl">search</span>
<input class="w-80 pl-12 pr-6 py-2.5 bg-card-dark border border-border-dark rounded-full text-sm focus:ring-1 focus:ring-accent-neon focus:border-accent-neon transition-all text-white placeholder-gray-600" placeholder="Search hash, runner, or event..." type="text"/>
</div>
<button class="bg-accent-neon text-black px-6 py-2.5 rounded-full text-xs font-black uppercase tracking-widest hover:brightness-110 transition-all flex items-center gap-2">
<span class="material-symbols-outlined text-lg">download</span>
                        Export Statement
                    </button>
</div>
</header>
<div class="p-10 space-y-8">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<div class="bg-card-dark p-6 rounded-2xl border border-border-dark hover:border-accent-neon/30 transition-all group">
<div class="flex justify-between items-start mb-4">
<span class="material-symbols-outlined text-accent-neon">payments</span>
<span class="text-[10px] font-bold text-emerald-500 bg-emerald-500/10 px-2 py-1 rounded">+12.5%</span>
</div>
<p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-1">Total Revenue</p>
<p class="text-2xl font-black text-white tracking-tighter italic">Rp 1.250.000k</p>
</div>
<div class="bg-card-dark p-6 rounded-2xl border border-border-dark hover:border-accent-neon/30 transition-all">
<div class="flex justify-between items-start mb-4">
<span class="material-symbols-outlined text-accent-neon">account_balance_wallet</span>
<span class="text-[10px] font-bold text-emerald-500 bg-emerald-500/10 px-2 py-1 rounded">+8.2%</span>
</div>
<p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-1">Net Profit</p>
<p class="text-2xl font-black text-white tracking-tighter italic">Rp 850.000k</p>
</div>
<div class="bg-card-dark p-6 rounded-2xl border border-border-dark hover:border-accent-neon/30 transition-all">
<div class="flex justify-between items-start mb-4">
<span class="material-symbols-outlined text-accent-neon">pending_actions</span>
<span class="text-[10px] font-bold text-rose-500 bg-rose-500/10 px-2 py-1 rounded">-2.4%</span>
</div>
<p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-1">Pending Gateways</p>
<p class="text-2xl font-black text-white tracking-tighter italic">Rp 45.200k</p>
</div>
<div class="bg-card-dark p-6 rounded-2xl border border-border-dark hover:border-accent-neon/30 transition-all">
<div class="flex justify-between items-start mb-4">
<span class="material-symbols-outlined text-accent-neon">group_add</span>
<span class="text-[10px] font-bold text-emerald-500 bg-emerald-500/10 px-2 py-1 rounded">+15%</span>
</div>
<p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-1">Active Registrations</p>
<p class="text-2xl font-black text-white tracking-tighter italic">12.450</p>
</div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<div class="lg:col-span-2 bg-card-dark p-8 rounded-3xl border border-border-dark">
<div class="flex items-center justify-between mb-8">
<div>
<h3 class="font-black text-white text-lg uppercase italic">Growth <span class="text-accent-neon">Velocity</span></h3>
<p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-1">Revenue accumulation (Quarterly)</p>
</div>
<div class="flex gap-2">
<button class="px-4 py-1.5 rounded-full bg-accent-neon text-black text-[10px] font-black uppercase">30D</button>
<button class="px-4 py-1.5 rounded-full bg-white/5 text-gray-400 text-[10px] font-black uppercase hover:bg-white/10">90D</button>
</div>
</div>
<div class="h-72 w-full relative">
<svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 500 150">
<defs>
<linearGradient id="neonGrad" x1="0%" x2="0%" y1="0%" y2="100%">
<stop offset="0%" style="stop-color:#39FF14;stop-opacity:0.3"></stop>
<stop offset="100%" style="stop-color:#39FF14;stop-opacity:0"></stop>
</linearGradient>
</defs>
<path d="M0,130 Q50,110 100,100 T200,80 T300,40 T400,60 T500,20 V150 H0 Z" fill="url(#neonGrad)"></path>
<path d="M0,130 Q50,110 100,100 T200,80 T300,40 T400,60 T500,20" fill="none" stroke="#39FF14" stroke-linecap="round" stroke-width="3"></path>
<circle cx="100" cy="100" fill="#0A0A0A" r="5" stroke="#39FF14" stroke-width="2"></circle>
<circle cx="300" cy="40" fill="#0A0A0A" r="5" stroke="#39FF14" stroke-width="2"></circle>
<circle cx="500" cy="20" fill="#0A0A0A" r="5" stroke="#39FF14" stroke-width="2"></circle>
</svg>
<div class="flex justify-between mt-6 px-2">
<span class="text-[10px] font-black text-gray-600 uppercase tracking-widest">JUL</span>
<span class="text-[10px] font-black text-gray-600 uppercase tracking-widest">AUG</span>
<span class="text-[10px] font-black text-gray-600 uppercase tracking-widest">SEP</span>
<span class="text-[10px] font-black text-gray-600 uppercase tracking-widest">OCT</span>
<span class="text-[10px] font-black text-gray-600 uppercase tracking-widest">NOV</span>
<span class="text-[10px] font-black text-gray-600 uppercase tracking-widest">DEC</span>
</div>
</div>
</div>
<div class="bg-card-dark p-8 rounded-3xl border border-border-dark">
<h3 class="font-black text-white text-lg uppercase italic mb-1">Gateway <span class="text-accent-neon">Split</span></h3>
<p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-8">Method distribution</p>
<div class="space-y-6">
<div class="space-y-3">
<div class="flex justify-between text-[10px] font-black uppercase tracking-widest">
<span class="text-gray-400">Virtual Account</span>
<span class="text-accent-neon">45%</span>
</div>
<div class="w-full bg-white/5 rounded-full h-1.5 overflow-hidden">
<div class="bg-accent-neon h-full rounded-full" style="width: 45%"></div>
</div>
</div>
<div class="space-y-3">
<div class="flex justify-between text-[10px] font-black uppercase tracking-widest">
<span class="text-gray-400">E-Wallet (OVO/GOPAY)</span>
<span class="text-accent-neon">30%</span>
</div>
<div class="w-full bg-white/5 rounded-full h-1.5 overflow-hidden">
<div class="bg-accent-neon h-full rounded-full" style="width: 30%"></div>
</div>
</div>
<div class="space-y-3">
<div class="flex justify-between text-[10px] font-black uppercase tracking-widest">
<span class="text-gray-400">Credit Engine</span>
<span class="text-accent-neon">15%</span>
</div>
<div class="w-full bg-white/5 rounded-full h-1.5 overflow-hidden">
<div class="bg-accent-neon h-full rounded-full" style="width: 15%"></div>
</div>
</div>
<div class="space-y-3">
<div class="flex justify-between text-[10px] font-black uppercase tracking-widest">
<span class="text-gray-400">Retailers</span>
<span class="text-accent-neon">10%</span>
</div>
<div class="w-full bg-white/5 rounded-full h-1.5 overflow-hidden">
<div class="bg-accent-neon h-full rounded-full" style="width: 10%"></div>
</div>
</div>
</div>
<div class="mt-10 pt-6 border-t border-border-dark">
<button class="w-full py-3 rounded-xl border border-border-dark text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-accent-neon hover:border-accent-neon/30 transition-all">
                                Request Raw Data
                            </button>
</div>
</div>
</div>
<div class="bg-card-dark rounded-3xl border border-border-dark overflow-hidden">
<div class="p-8 border-b border-border-dark flex items-center justify-between">
<h3 class="font-black text-white text-lg uppercase italic">Recent <span class="text-accent-neon">Nodes</span></h3>
<button class="text-[10px] font-black text-gray-500 hover:text-accent-neon transition-colors uppercase tracking-widest flex items-center gap-2">
                            Fetch full ledger <span class="material-symbols-outlined text-sm">arrow_forward</span>
</button>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-white/5">
<th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Node ID</th>
<th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Runner Authority</th>
<th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Race Event</th>
<th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Amount</th>
<th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Timestamp</th>
<th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Validation</th>
</tr>
</thead>
<tbody class="divide-y divide-border-dark">
<tr class="hover:bg-white/[0.02] transition-colors group">
<td class="px-8 py-5 text-sm font-black text-gray-300 group-hover:text-accent-neon">#PK-2024001</td>
<td class="px-8 py-5">
<div class="flex items-center gap-3">
<div class="size-8 rounded-lg bg-accent-neon/10 flex items-center justify-center border border-accent-neon/20">
<span class="text-accent-neon font-black text-[10px]">BP</span>
</div>
<span class="text-sm font-bold text-gray-200">Budi Pratama</span>
</div>
</td>
<td class="px-8 py-5 text-sm text-gray-400 font-medium italic">Jakarta Marathon 2024</td>
<td class="px-8 py-5 text-sm font-black text-white italic">Rp 750.000</td>
<td class="px-8 py-5 text-[10px] font-bold text-gray-500 uppercase">Oct 12, 14:30</td>
<td class="px-8 py-5">
<span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-black rounded-full border border-emerald-500/20">VERIFIED</span>
</td>
</tr>
<tr class="hover:bg-white/[0.02] transition-colors group">
<td class="px-8 py-5 text-sm font-black text-gray-300 group-hover:text-accent-neon">#PK-2024002</td>
<td class="px-8 py-5">
<div class="flex items-center gap-3">
<div class="size-8 rounded-lg bg-white/5 flex items-center justify-center border border-white/10">
<span class="text-white font-black text-[10px]">SL</span>
</div>
<span class="text-sm font-bold text-gray-200">Siti Lestari</span>
</div>
</td>
<td class="px-8 py-5 text-sm text-gray-400 font-medium italic">Ultra Trail Merapi</td>
<td class="px-8 py-5 text-sm font-black text-white italic">Rp 1.200.000</td>
<td class="px-8 py-5 text-[10px] font-bold text-gray-500 uppercase">Oct 12, 13:15</td>
<td class="px-8 py-5">
<span class="px-3 py-1 bg-accent-neon/10 text-accent-neon text-[10px] font-black rounded-full border border-accent-neon/20">PENDING</span>
</td>
</tr>
<tr class="hover:bg-white/[0.02] transition-colors group">
<td class="px-8 py-5 text-sm font-black text-gray-300 group-hover:text-accent-neon">#PK-2024003</td>
<td class="px-8 py-5">
<div class="flex items-center gap-3">
<div class="size-8 rounded-lg bg-accent-neon/10 flex items-center justify-center border border-accent-neon/20">
<span class="text-accent-neon font-black text-[10px]">AH</span>
</div>
<span class="text-sm font-bold text-gray-200">Agus Hidayat</span>
</div>
</td>
<td class="px-8 py-5 text-sm text-gray-400 font-medium italic">Sunset Run Bali</td>
<td class="px-8 py-5 text-sm font-black text-white italic">Rp 450.000</td>
<td class="px-8 py-5 text-[10px] font-bold text-gray-500 uppercase">Oct 11, 20:05</td>
<td class="px-8 py-5">
<span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-black rounded-full border border-emerald-500/20">VERIFIED</span>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</main>
</div>

</body></html>