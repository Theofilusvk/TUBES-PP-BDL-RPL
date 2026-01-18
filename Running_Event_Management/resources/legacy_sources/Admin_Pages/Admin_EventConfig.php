<!DOCTYPE html>
<html class="dark" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin Event Configuration Setup - Pelari Kalcer</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              colors: {
                "primary": "#00ff80",
                "background-dark": "#0a0c10",
                "surface-dark": "#161b22",
                "border-dark": "#30363d",
                "accent-neon": "#00ff80",
              },
              fontFamily: {
                "display": ["Space Grotesk", "sans-serif"],
                "sans": ["Plus Jakarta Sans", "sans-serif"]
              },
              borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px"},
            },
          },
        }
    </script>
<style type="text/tailwindcss">
        @layer base {
            body {
                @apply bg-background-dark text-slate-100 font-sans;
            }
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #0a0c10;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #30363d;
            border-radius: 10px;
        }
        .glass-panel {
            background: rgba(22, 27, 34, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(48, 54, 61, 0.8);
        }
        .neon-glow {
            box-shadow: 0 0 15px rgba(0, 255, 128, 0.15);
        }
        .neon-border-hover:hover {
            border-color: #00ff80;
            box-shadow: 0 0 10px rgba(0, 255, 128, 0.1);
        }
    </style>
</head>
<body class="antialiased overflow-hidden">
<div class="flex h-screen overflow-hidden">
<aside class="w-72 border-r border-border-dark bg-background-dark flex flex-col shrink-0">
<div class="p-8 flex items-center gap-4">
<div class="w-12 h-12 bg-accent-neon rounded-xl flex items-center justify-center text-background-dark shadow-[0_0_20px_rgba(0,255,128,0.3)]">
<span class="material-symbols-outlined font-bold text-2xl">bolt</span>
</div>
<div class="flex flex-col">
<h1 class="text-white text-xl font-display font-bold leading-tight uppercase tracking-[0.2em]">Kalcer</h1>
<p class="text-accent-neon text-[10px] font-extrabold tracking-widest opacity-90 uppercase">Admin Central</p>
</div>
</div>
<nav class="flex-1 px-4 py-4 space-y-1">
<a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all group" href="#">
<span class="material-symbols-outlined text-xl group-hover:text-accent-neon">dashboard</span>
<span class="text-sm font-semibold">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all group" href="#">
<span class="material-symbols-outlined text-xl group-hover:text-accent-neon">group</span>
<span class="text-sm font-semibold">User Management</span>
</a>
<a class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-accent-neon/10 text-accent-neon border border-accent-neon/20 shadow-[0_0_15px_rgba(0,255,128,0.05)]" href="#">
<span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1">settings_input_component</span>
<span class="text-sm font-bold">Event Configuration</span>
</a>
<a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all group" href="#">
<span class="material-symbols-outlined text-xl group-hover:text-accent-neon">payments</span>
<span class="text-sm font-semibold">Financial Reports</span>
</a>
<a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all group" href="#">
<span class="material-symbols-outlined text-xl group-hover:text-accent-neon">database_upload</span>
<span class="text-sm font-semibold">Database Triggers</span>
</a>
</nav>
<div class="p-6 mt-auto">
<div class="p-4 rounded-2xl bg-surface-dark/50 border border-border-dark flex items-center gap-3">
<div class="size-10 rounded-full bg-cover bg-center ring-2 ring-accent-neon/30" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBjhN8dsif1Su1nobS8RgqhljDY9CVZYfE8bqt5qaURa0v7lCtZMtWPZ1fy2JnB1NO0Sy0Do_yNutHgY9cI1zTcoJRJnVjBCcojvuSaKJzdEDNa7q9MIYP-e7v8-LJKAjF1Hyx6CnYy2Rttf0G1soDJdx3n56P3XAo9cPFB2EK9YnEhYbE6XNjMwAvJWUdPEAJveKn_LbtRtEZf05-gk6NRMvaKBDAcX95DWzla0QGX_5k9zaQKG4fzP444HyhltKDJI4DewvPt9y0')"></div>
<div class="flex flex-col overflow-hidden">
<p class="text-sm font-bold text-white truncate">Super_Admin</p>
<p class="text-[10px] text-accent-neon font-bold uppercase tracking-tighter">System Access</p>
</div>
<button class="ml-auto material-symbols-outlined text-slate-500 hover:text-white text-lg">logout</button>
</div>
</div>
</aside>
<main class="flex-1 flex flex-col overflow-hidden bg-[#0d1117]">
<header class="h-24 border-b border-border-dark flex items-center justify-between px-10 bg-background-dark/80 backdrop-blur-xl z-10 shrink-0">
<div class="flex items-center gap-6">
<div>
<h2 class="text-2xl font-display font-bold text-white tracking-tight">Admin Event Configuration Setup</h2>
<div class="flex items-center gap-3 mt-1">
<span class="text-[10px] font-mono text-slate-500 uppercase tracking-widest bg-surface-dark px-2 py-0.5 rounded border border-border-dark">Table: ms_event</span>
<div class="flex items-center gap-1.5">
<span class="w-1.5 h-1.5 rounded-full bg-accent-neon animate-pulse"></span>
<span class="text-[10px] font-bold text-accent-neon tracking-widest">LIVE SYSTEM</span>
</div>
</div>
</div>
</div>
<div class="flex items-center gap-4">
<div class="relative group">
<span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-500 text-lg group-focus-within:text-accent-neon transition-colors">search</span>
<input class="bg-surface-dark border-border-dark rounded-xl pl-12 pr-6 py-2.5 text-sm focus:ring-1 focus:ring-accent-neon focus:border-accent-neon w-72 transition-all text-white placeholder:text-slate-600" placeholder="Query event master data..." type="text"/>
</div>
<button class="px-6 py-2.5 bg-accent-neon text-background-dark rounded-xl text-sm font-extrabold hover:brightness-110 transition-all flex items-center gap-2 shadow-[0_0_20px_rgba(0,255,128,0.2)]">
<span class="material-symbols-outlined text-xl">save</span>
                        COMMIT CHANGES
                    </button>
</div>
</header>
<div class="flex-1 overflow-y-auto custom-scrollbar p-10 space-y-10">
<section>
<div class="flex items-center justify-between mb-6">
<div class="flex items-center gap-3">
<span class="w-1 h-6 bg-accent-neon rounded-full"></span>
<h3 class="text-white font-display font-bold uppercase tracking-[0.15em] text-sm">Active Event Templates</h3>
</div>
<button class="text-[10px] font-bold text-slate-500 hover:text-accent-neon uppercase tracking-widest transition-colors flex items-center gap-1">
                            View All Master Records <span class="material-symbols-outlined text-sm">arrow_forward</span>
</button>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<div class="glass-panel p-6 rounded-2xl border-t-2 border-t-accent-neon group hover:bg-surface-dark/80 transition-all">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 rounded-xl bg-accent-neon/10 flex items-center justify-center text-accent-neon border border-accent-neon/20">
<span class="material-symbols-outlined text-2xl">sprint</span>
</div>
<span class="text-[10px] font-black bg-accent-neon text-background-dark px-2.5 py-1 rounded-full uppercase tracking-tighter">Running</span>
</div>
<h4 class="text-white font-bold text-xl leading-tight mb-2">Jakarta Night Run</h4>
<p class="text-slate-500 text-xs mb-6 font-medium">GBK Stadium • Aug 2024</p>
<div class="space-y-3">
<div class="flex justify-between text-[10px] font-bold text-slate-400 uppercase tracking-widest">
<span>REGISTRATION</span>
<span class="text-accent-neon">82% Capacity</span>
</div>
<div class="w-full bg-border-dark/50 h-1.5 rounded-full overflow-hidden">
<div class="bg-accent-neon h-full w-[82%] shadow-[0_0_10px_rgba(0,255,128,0.5)]"></div>
</div>
</div>
</div>
<div class="glass-panel p-6 rounded-2xl border-t-2 border-t-slate-700 group hover:bg-surface-dark/80 transition-all">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 border border-slate-700">
<span class="material-symbols-outlined text-2xl">landscape</span>
</div>
<span class="text-[10px] font-black border border-slate-700 text-slate-500 px-2.5 py-1 rounded-full uppercase tracking-tighter">Draft Mode</span>
</div>
<h4 class="text-white font-bold text-xl leading-tight mb-2">Bali Ultra Trail</h4>
<p class="text-slate-500 text-xs mb-6 font-medium">Mount Batur • Oct 2024</p>
<div class="flex items-center gap-2">
<span class="text-[10px] font-bold text-slate-400 border border-border-dark px-3 py-1.5 rounded-lg uppercase">Trail Run</span>
<span class="text-[10px] font-bold text-slate-400 border border-border-dark px-3 py-1.5 rounded-lg uppercase">100K</span>
</div>
</div>
<div class="glass-panel p-6 rounded-2xl border-2 border-dashed border-border-dark hover:border-accent-neon/50 bg-transparent flex flex-col items-center justify-center text-center group cursor-pointer transition-all">
<div class="w-14 h-14 rounded-full border border-border-dark flex items-center justify-center mb-4 group-hover:bg-accent-neon/10 group-hover:border-accent-neon transition-all">
<span class="material-symbols-outlined text-slate-500 group-hover:text-accent-neon text-3xl">add_circle</span>
</div>
<p class="text-sm font-bold text-slate-400 group-hover:text-white transition-colors">Initialize New Config</p>
<p class="text-[10px] font-mono text-slate-600 mt-2 tracking-widest uppercase">ms_template_v2.sys</p>
</div>
</div>
</section>
<div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
<div class="xl:col-span-2 space-y-10">
<div class="glass-panel rounded-2xl overflow-hidden shadow-2xl">
<div class="p-6 border-b border-border-dark bg-surface-dark/50 flex justify-between items-center">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-accent-neon/10 flex items-center justify-center text-accent-neon">
<span class="material-symbols-outlined">database</span>
</div>
<h3 class="font-display font-bold text-white text-base">ms_event <span class="text-slate-500 font-normal ml-2">// Master Configuration</span></h3>
</div>
<span class="text-[10px] font-mono text-accent-neon font-bold tracking-[0.2em] bg-accent-neon/10 px-3 py-1 rounded-full">STEP 01</span>
</div>
<div class="p-8 grid grid-cols-2 gap-8">
<div class="col-span-2 flex flex-col gap-3">
<label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest flex justify-between">
<span>Event Name</span>
<span class="text-slate-600 font-mono">VARCHAR(255)</span>
</label>
<input class="bg-background-dark border-border-dark rounded-xl p-4 text-white focus:ring-accent-neon focus:border-accent-neon placeholder:text-slate-700 transition-all" type="text" value="Surabaya 10K Series - Leg 1"/>
</div>
<div class="flex flex-col gap-3">
<label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest flex justify-between">
<span>Race Date</span>
<span class="text-slate-600 font-mono">DATE</span>
</label>
<div class="relative">
<span class="absolute right-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-500">calendar_today</span>
<input class="w-full bg-background-dark border-border-dark rounded-xl p-4 text-white focus:ring-accent-neon focus:border-accent-neon transition-all" type="date"/>
</div>
</div>
<div class="flex flex-col gap-3">
<label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest flex justify-between">
<span>Category</span>
<span class="text-slate-600 font-mono">ENUM</span>
</label>
<select class="bg-background-dark border-border-dark rounded-xl p-4 text-white focus:ring-accent-neon focus:border-accent-neon transition-all appearance-none">
<option>Road Running</option>
<option>Trail Running</option>
<option>Obstacle Course</option>
<option>Virtual Run</option>
</select>
</div>
<div class="col-span-2 flex flex-col gap-3">
<label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest flex justify-between">
<span>Meta Description</span>
<span class="text-slate-600 font-mono">TEXT</span>
</label>
<textarea class="bg-background-dark border-border-dark rounded-xl p-4 text-white focus:ring-accent-neon focus:border-accent-neon placeholder:text-slate-700 transition-all min-h-[120px]" placeholder="Configure the event's public narrative and cultural context..."></textarea>
</div>
</div>
</div>
<div class="glass-panel rounded-2xl overflow-hidden shadow-2xl">
<div class="p-6 border-b border-border-dark bg-surface-dark/50 flex justify-between items-center">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-accent-neon/10 flex items-center justify-center text-accent-neon">
<span class="material-symbols-outlined">payments</span>
</div>
<h3 class="font-display font-bold text-white text-base">ms_biayakategori <span class="text-slate-500 font-normal ml-2">// Pricing Tiers</span></h3>
</div>
<button class="text-[11px] text-accent-neon font-black flex items-center gap-2 hover:bg-accent-neon/10 px-4 py-2 rounded-full border border-accent-neon/30 transition-all uppercase tracking-widest">
<span class="material-symbols-outlined text-sm">add</span> Insert Entry
                                </button>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left text-sm">
<thead>
<tr class="text-slate-500 uppercase text-[10px] tracking-[0.2em] border-b border-border-dark">
<th class="px-8 py-5 font-black">Dist. Category</th>
<th class="px-6 py-5 font-black text-accent-neon/70">Early Bird</th>
<th class="px-6 py-5 font-black">Standard</th>
<th class="px-6 py-5 font-black text-yellow-500/70">Flash Sale</th>
<th class="px-8 py-5 text-right font-black">Admin</th>
</tr>
</thead>
<tbody class="divide-y divide-border-dark">
<tr class="hover:bg-white/5 transition-colors group">
<td class="px-8 py-5 font-bold text-white">5K - Fun Run</td>
<td class="px-6 py-5"><input class="bg-transparent border-none p-0 focus:ring-0 text-slate-300 font-mono" type="text" value="IDR 150,000"/></td>
<td class="px-6 py-5"><input class="bg-transparent border-none p-0 focus:ring-0 text-slate-300 font-mono" type="text" value="IDR 250,000"/></td>
<td class="px-6 py-5 text-slate-600 font-mono italic">null</td>
<td class="px-8 py-5 text-right">
<button class="material-symbols-outlined text-slate-600 hover:text-red-500 transition-colors">delete_forever</button>
</td>
</tr>
<tr class="hover:bg-white/5 transition-colors group">
<td class="px-8 py-5 font-bold text-white">10K - Competitive</td>
<td class="px-6 py-5"><input class="bg-transparent border-none p-0 focus:ring-0 text-slate-300 font-mono" type="text" value="IDR 275,000"/></td>
<td class="px-6 py-5"><input class="bg-transparent border-none p-0 focus:ring-0 text-slate-300 font-mono" type="text" value="IDR 400,000"/></td>
<td class="px-6 py-5"><input class="bg-transparent border-none p-0 focus:ring-0 text-accent-neon font-mono" type="text" value="IDR 199,000"/></td>
<td class="px-8 py-5 text-right">
<button class="material-symbols-outlined text-slate-600 hover:text-red-500 transition-colors">delete_forever</button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="glass-panel rounded-2xl overflow-hidden shadow-2xl">
<div class="p-6 border-b border-border-dark bg-surface-dark/50">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-accent-neon/10 flex items-center justify-center text-accent-neon">
<span class="material-symbols-outlined">confirmation_number</span>
</div>
<h3 class="font-display font-bold text-white text-base">ms_slot <span class="text-slate-500 font-normal ml-2">// Capacity Logic</span></h3>
</div>
</div>
<div class="p-8 space-y-10">
<div class="grid grid-cols-2 gap-12">
<div class="flex flex-col gap-5">
<div class="flex justify-between items-end">
<label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">5K CATEGORY SLOTS</label>
<span class="text-accent-neon font-display font-extrabold text-2xl tracking-tighter">800</span>
</div>
<input class="accent-accent-neon h-1.5 bg-border-dark rounded-full appearance-none cursor-pointer" type="range"/>
<div class="flex justify-between text-[9px] text-slate-600 font-mono tracking-[0.2em]">
<span>MIN_VAL: 50</span>
<span>MAX_VAL: 2500</span>
</div>
</div>
<div class="flex flex-col gap-5">
<div class="flex justify-between items-end">
<label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">10K CATEGORY SLOTS</label>
<span class="text-accent-neon font-display font-extrabold text-2xl tracking-tighter">1200</span>
</div>
<input class="accent-accent-neon h-1.5 bg-border-dark rounded-full appearance-none cursor-pointer" type="range"/>
<div class="flex justify-between text-[9px] text-slate-600 font-mono tracking-[0.2em]">
<span>MIN_VAL: 50</span>
<span>MAX_VAL: 2500</span>
</div>
</div>
</div>
<div class="pt-10 border-t border-border-dark grid grid-cols-3 gap-8">
<label class="flex items-center justify-between p-4 rounded-xl bg-background-dark/50 border border-border-dark hover:border-accent-neon/30 transition-all cursor-pointer group">
<span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-white">Auto Waitlist</span>
<input checked="" class="w-5 h-5 rounded-md bg-background-dark border-border-dark text-accent-neon focus:ring-accent-neon focus:ring-offset-background-dark" type="checkbox"/>
</label>
<label class="flex items-center justify-between p-4 rounded-xl bg-background-dark/50 border border-border-dark hover:border-accent-neon/30 transition-all cursor-pointer group">
<span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-white">BIB Logic</span>
<input class="w-5 h-5 rounded-md bg-background-dark border-border-dark text-accent-neon focus:ring-accent-neon focus:ring-offset-background-dark" type="checkbox"/>
</label>
<label class="flex items-center justify-between p-4 rounded-xl bg-background-dark/50 border border-border-dark hover:border-accent-neon/30 transition-all cursor-pointer group">
<span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-white">ID Validation</span>
<input checked="" class="w-5 h-5 rounded-md bg-background-dark border-border-dark text-accent-neon focus:ring-accent-neon focus:ring-offset-background-dark" type="checkbox"/>
</label>
</div>
</div>
</div>
</div>
<div class="space-y-10">
<div class="glass-panel rounded-2xl overflow-hidden flex flex-col h-[480px] shadow-2xl">
<div class="p-6 border-b border-border-dark flex justify-between items-center bg-surface-dark/50">
<h3 class="font-display font-bold text-white text-sm uppercase tracking-widest">Venue Geo-Mapping</h3>
<span class="material-symbols-outlined text-accent-neon animate-pulse">location_on</span>
</div>
<div class="flex-1 bg-background-dark relative overflow-hidden">
<div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_50%_50%,#00ff80_0%,transparent_70%)] pointer-events-none"></div>
<div class="w-full h-full bg-center bg-cover grayscale opacity-60 mix-blend-screen" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDIk9QsET6S4yY0Lp-QZoeT32bWcXZs2tq3LFCftk4bT78q2SeXJg40QhRVTJ7KUvXRvFlrQkpnHnSZueknu-tjc_0rcG3QsoEfECiT4Qdsv3WDVDXOC24Ds7C0GJ2Z9kZ2hZy9UpuJd1qxdkUF8Hvigw18tJQsbCpL5F_maEvrNVwPXXowpR1hTBk8I9X-zNY6ZXp73Bi6qxBhnIfPpt3Tp5LQ9dV3Q8_VJGvXIP7ilxVIPfluHslEPm6l1CAPp6feQmzdGVdQS9w')"></div>
<div class="absolute inset-0 flex items-center justify-center">
<div class="relative">
<div class="w-12 h-12 bg-accent-neon/20 rounded-full animate-ping absolute -top-3 -left-3"></div>
<div class="w-6 h-6 bg-accent-neon rounded-full relative flex items-center justify-center border-4 border-background-dark shadow-[0_0_15px_rgba(0,255,128,0.6)]">
<div class="w-1.5 h-1.5 bg-background-dark rounded-full"></div>
</div>
<div class="absolute top-8 left-1/2 -translate-x-1/2 whitespace-nowrap px-4 py-2 bg-background-dark/95 border border-accent-neon/50 text-[10px] font-black text-white rounded-lg shadow-2xl backdrop-blur-md">
                                            SURABAYA TOWN SQ. <br/>
<span class="text-accent-neon/70 font-mono uppercase">Node_Main_01</span>
</div>
</div>
</div>
<div class="absolute bottom-6 left-6 right-6 flex gap-3">
<input class="flex-1 text-[11px] bg-background-dark/90 border-border-dark rounded-xl p-3 text-white focus:ring-accent-neon focus:border-accent-neon backdrop-blur-md placeholder:text-slate-600" placeholder="Resolve location address..." type="text"/>
<button class="p-3 bg-accent-neon text-background-dark rounded-xl material-symbols-outlined text-xl shadow-lg">gps_fixed</button>
</div>
</div>
<div class="p-5 bg-surface-dark/80 border-t border-border-dark">
<div class="flex justify-between items-center">
<div class="flex flex-col">
<p class="text-[9px] text-slate-500 font-black uppercase tracking-[0.2em]">Coordinates</p>
<p class="text-xs font-mono text-accent-neon">7.2575° S, 112.7521° E</p>
</div>
<div class="h-8 w-px bg-border-dark"></div>
<div class="flex flex-col text-right">
<p class="text-[9px] text-slate-500 font-black uppercase tracking-[0.2em]">Accuracy</p>
<p class="text-xs font-mono text-white">High (99.8%)</p>
</div>
</div>
</div>
</div>
<div class="bg-accent-neon p-8 rounded-2xl text-background-dark shadow-[0_0_40px_rgba(0,255,128,0.15)] relative overflow-hidden group">
<div class="absolute -right-4 -top-4 opacity-10 group-hover:rotate-12 transition-transform duration-500">
<span class="material-symbols-outlined text-9xl">verified_user</span>
</div>
<h3 class="font-display font-black text-2xl mb-5 leading-none uppercase tracking-tighter italic">VALIDATION READY</h3>
<ul class="space-y-4 mb-8">
<li class="flex items-center gap-3 text-xs font-extrabold border-b border-background-dark/10 pb-3">
<span class="material-symbols-outlined text-lg">check_circle</span>
<span>MS_EVENT METADATA VERIFIED</span>
</li>
<li class="flex items-center gap-3 text-xs font-extrabold border-b border-background-dark/10 pb-3">
<span class="material-symbols-outlined text-lg">check_circle</span>
<span>PRICING LOGIC SYNCHRONIZED</span>
</li>
<li class="flex items-center gap-3 text-xs font-extrabold opacity-60">
<span class="material-symbols-outlined text-lg">info</span>
<span>WAIVER_DOC_ID: MISSING</span>
</li>
</ul>
<div class="flex items-center gap-4 bg-background-dark/5 p-4 rounded-xl border border-background-dark/10">
<div class="size-12 rounded-full border-4 border-background-dark/20 flex items-center justify-center font-display font-black text-sm">
                                    92%
                                </div>
<p class="text-[10px] leading-relaxed font-bold uppercase tracking-tight">System configuration health is optimal for public deployment.</p>
</div>
</div>
<div class="glass-panel rounded-2xl p-6 shadow-xl">
<div class="flex items-center justify-between mb-6">
<h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.25em]">Audit Trail</h3>
<span class="w-1.5 h-1.5 rounded-full bg-slate-700"></span>
</div>
<div class="space-y-5">
<div class="flex gap-4 border-l-2 border-accent-neon pl-5 py-0.5 relative">
<div class="absolute -left-[5px] top-1 w-2 h-2 rounded-full bg-accent-neon shadow-[0_0_8px_#00ff80]"></div>
<div class="flex flex-col">
<p class="text-[11px] text-white font-bold leading-none tracking-tight">Record Update: ms_biayakategori</p>
<p class="text-[9px] text-slate-500 mt-2 font-mono uppercase">Today, 14:22 • SuperAdmin</p>
</div>
</div>
<div class="flex gap-4 border-l-2 border-border-dark pl-5 py-0.5 relative">
<div class="absolute -left-[5px] top-1 w-2 h-2 rounded-full bg-border-dark"></div>
<div class="flex flex-col">
<p class="text-[11px] text-slate-400 font-semibold leading-none tracking-tight">System Initialization: ms_event</p>
<p class="text-[9px] text-slate-600 mt-2 font-mono uppercase">Yesterday, 09:15 • System_Kernel</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<footer class="h-8 shrink-0 bg-background-dark/50"></footer>
</main>
</div>

</body></html>