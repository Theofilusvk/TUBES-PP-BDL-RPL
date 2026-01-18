<!DOCTYPE html>
<html class="dark" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin Database Triggers &amp; Logs - Pelari Kalcer</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;family=JetBrains+Mono:wght@400;500&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#00ff66", // Updated to neon green used in Admin User Management
                        "background-dark": "#0a0a0a",
                        "card-dark": "#121212",
                        "border-dark": "#1f1f1f",
                    },
                    fontFamily: {
                        "sans": ["Plus Jakarta Sans", "sans-serif"],
                        "mono": ["JetBrains Mono", "monospace"]
                    }
                },
            },
        }
    </script>
<style type="text/tailwindcss">
        @layer base {
            body {
                @apply bg-background-dark text-slate-200;
            }
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .active-nav-bg {
            background: linear-gradient(90deg, rgba(0, 255, 102, 0.1) 0%, rgba(0, 255, 102, 0) 100%);
            border-left: 2px solid #00ff66;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            @apply bg-background-dark;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            @apply bg-border-dark rounded-full;
        }
        .terminal-text {
            font-family: 'JetBrains Mono', monospace;
        }
        .neon-glow {
            text-shadow: 0 0 10px rgba(0, 255, 102, 0.4);
        }
    </style>
</head>
<body class="font-sans selection:bg-primary selection:text-black">
<div class="flex h-screen overflow-hidden">
<aside class="w-64 flex-shrink-0 bg-black border-r border-border-dark flex flex-col">
<div class="p-6 flex items-center gap-3">
<div class="size-8 bg-primary rounded flex items-center justify-center">
<span class="material-symbols-outlined text-black font-bold">bolt</span>
</div>
<div>
<h1 class="text-white text-sm font-extrabold tracking-tighter uppercase leading-none">Pelari Kalcer</h1>
<p class="text-[10px] text-slate-500 font-medium tracking-[0.2em] uppercase mt-1">Admin Central</p>
</div>
</div>
<nav class="flex-1 px-4 mt-4 flex flex-col gap-1">
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-all" href="#">
<span class="material-symbols-outlined text-xl">grid_view</span>
<span class="text-xs font-bold uppercase tracking-wider">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-all" href="#">
<span class="material-symbols-outlined text-xl">group</span>
<span class="text-xs font-bold uppercase tracking-wider">User Management</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-all" href="#">
<span class="material-symbols-outlined text-xl">settings_input_component</span>
<span class="text-xs font-bold uppercase tracking-wider">Event Configuration</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-all" href="#">
<span class="material-symbols-outlined text-xl">account_balance_wallet</span>
<span class="text-xs font-bold uppercase tracking-wider">Financial Reports</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-primary active-nav-bg rounded-lg shadow-sm" href="#">
<span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1">terminal</span>
<span class="text-xs font-bold uppercase tracking-wider">Database Triggers</span>
</a>
</nav>
<div class="p-4 border-t border-border-dark bg-card-dark/30">
<div class="flex items-center gap-3 p-2">
<img alt="Admin avatar" class="size-8 rounded border border-border-dark" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDcAjqGcqJbvMEQp3R7BxbLzBNr9MA1nChpVRUwPFKkExftzDbVDghimvRExk70P8dVEkNkoZ3j0Gp3F4JnlQxDsV5BCys06wmql-xQhwh9Q1BQOXE2AeTEzRUe-gpU4feb7PLY7Ac_KEx-nRlmcSn2Ea_nEmTZIvzyWnFsVckSigycUY9CegBthw6TfS7Xe0xGxrkfP4fxIizDn4lVT7jQ3NcpT0nttpVvBsUJHeMQeHVHa4-UaXaJN2jz2A2lrJlmWDlpVQUutSA"/>
<div class="flex flex-col">
<p class="text-[10px] font-bold text-white uppercase">System Core</p>
<p class="text-[9px] text-primary/70 font-mono tracking-tighter uppercase">Root Protocol v2</p>
</div>
</div>
</div>
</aside>
<main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-background-dark">
<header class="h-16 flex items-center justify-between px-8 border-b border-border-dark bg-black/50 backdrop-blur-md z-10">
<div class="flex items-center gap-6">
<h2 class="text-white text-sm font-black uppercase tracking-widest flex items-center gap-2">
<span class="text-primary material-symbols-outlined">analytics</span>
                    DB Engine Monitor
                </h2>
<div class="h-4 w-[1px] bg-border-dark"></div>
<div class="flex items-center gap-2">
<span class="flex h-2 w-2 rounded-full bg-primary animate-pulse shadow-[0_0_8px_#00ff66]"></span>
<span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Real-time Stream Active</span>
</div>
</div>
<div class="flex items-center gap-3">
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-sm">search</span>
<input class="w-64 h-8 bg-card-dark border border-border-dark rounded text-[10px] pl-9 focus:ring-1 focus:ring-primary focus:border-primary text-slate-300 placeholder:text-slate-600 uppercase tracking-widest font-bold" placeholder="Query Object Logs..." type="text"/>
</div>
<button class="size-8 flex items-center justify-center rounded bg-card-dark border border-border-dark text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined text-lg">sync</span>
</button>
</div>
</header>
<div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
<div class="grid grid-cols-4 gap-4 mb-8">
<div class="bg-card-dark p-4 border border-border-dark rounded-sm">
<div class="flex justify-between items-start mb-2">
<p class="text-slate-500 text-[9px] font-black uppercase tracking-[0.2em]">Active Triggers</p>
<span class="material-symbols-outlined text-primary text-sm">bolt</span>
</div>
<h3 class="text-2xl font-black text-white terminal-text">05</h3>
<p class="text-[9px] text-primary/60 font-bold uppercase mt-1 tracking-tighter">Status: Nominal</p>
</div>
<div class="bg-card-dark p-4 border border-border-dark rounded-sm">
<div class="flex justify-between items-start mb-2">
<p class="text-slate-500 text-[9px] font-black uppercase tracking-[0.2em]">Procedures</p>
<span class="material-symbols-outlined text-primary text-sm">terminal</span>
</div>
<h3 class="text-2xl font-black text-white terminal-text">07</h3>
<p class="text-[9px] text-primary/60 font-bold uppercase mt-1 tracking-tighter">Status: Deployed</p>
</div>
<div class="bg-card-dark p-4 border border-border-dark rounded-sm">
<div class="flex justify-between items-start mb-2">
<p class="text-slate-500 text-[9px] font-black uppercase tracking-[0.2em]">Mean Latency</p>
<span class="material-symbols-outlined text-primary text-sm">speed</span>
</div>
<h3 class="text-2xl font-black text-white terminal-text">12<span class="text-xs">ms</span></h3>
<p class="text-[9px] text-primary font-bold uppercase mt-1 tracking-tighter">-2ms Stability Gain</p>
</div>
<div class="bg-card-dark p-4 border border-border-dark rounded-sm">
<div class="flex justify-between items-start mb-2">
<p class="text-slate-500 text-[9px] font-black uppercase tracking-[0.2em]">Service Uptime</p>
<span class="material-symbols-outlined text-primary text-sm">lan</span>
</div>
<h3 class="text-2xl font-black text-white terminal-text">99.9<span class="text-xs">8%</span></h3>
<p class="text-[9px] text-primary/60 font-bold uppercase mt-1 tracking-tighter">Node: Jakarta-01</p>
</div>
</div>
<div class="mb-8">
<div class="flex items-center justify-between mb-4">
<div class="flex items-center gap-3">
<div class="w-1 h-4 bg-primary shadow-[0_0_8px_rgba(0,255,102,0.6)]"></div>
<h2 class="text-white text-xs font-black uppercase tracking-[0.25em]">Schema Objects Matrix</h2>
</div>
<button class="text-[9px] font-black text-black bg-primary px-4 py-1.5 uppercase tracking-widest hover:brightness-110 transition-all shadow-[0_0_15px_rgba(0,255,102,0.2)]">Dump Schema</button>
</div>
<div class="bg-card-dark border border-border-dark overflow-hidden">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-black/40 border-b border-border-dark">
<th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Object Identifier</th>
<th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Classification</th>
<th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Status</th>
<th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Latency</th>
<th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Last Exec</th>
<th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500 text-center">Protocol</th>
</tr>
</thead>
<tbody class="divide-y divide-border-dark">
<tr class="hover:bg-white/[0.02] transition-colors group">
<td class="px-6 py-4">
<p class="text-xs font-bold text-white terminal-text">trg_update_race_slots</p>
<p class="text-[9px] text-slate-500 mt-0.5 uppercase tracking-tighter font-mono">Hook: registrations.INSERT</p>
</td>
<td class="px-6 py-4">
<span class="text-[9px] font-black text-primary border border-primary/30 px-2 py-0.5 uppercase">Trigger</span>
</td>
<td class="px-6 py-4">
<div class="flex items-center gap-1.5">
<span class="size-1.5 bg-primary rounded-full shadow-[0_0_5px_#00ff66]"></span>
<span class="text-[10px] font-bold text-slate-300 uppercase">Active</span>
</div>
</td>
<td class="px-6 py-4">
<span class="text-[10px] terminal-text text-slate-500">0.004s</span>
</td>
<td class="px-6 py-4">
<span class="text-[10px] text-slate-500 uppercase font-medium">2m ago</span>
</td>
<td class="px-6 py-4 text-center">
<button class="material-symbols-outlined text-slate-600 hover:text-primary transition-colors">settings_backup_restore</button>
</td>
</tr>
<tr class="hover:bg-white/[0.02] transition-colors group">
<td class="px-6 py-4">
<p class="text-xs font-bold text-white terminal-text">sp_generate_bib_numbers</p>
<p class="text-[9px] text-slate-500 mt-0.5 uppercase tracking-tighter font-mono">Scope: registry_global</p>
</td>
<td class="px-6 py-4">
<span class="text-[9px] font-black text-slate-400 border border-border-dark px-2 py-0.5 uppercase bg-white/5">Stored Proc</span>
</td>
<td class="px-6 py-4">
<div class="flex items-center gap-1.5">
<span class="size-1.5 bg-primary rounded-full shadow-[0_0_5px_#00ff66]"></span>
<span class="text-[10px] font-bold text-slate-300 uppercase">Active</span>
</div>
</td>
<td class="px-6 py-4">
<span class="text-[10px] terminal-text text-slate-500">0.842s</span>
</td>
<td class="px-6 py-4">
<span class="text-[10px] text-slate-500 uppercase font-medium">15m ago</span>
</td>
<td class="px-6 py-4 text-center">
<button class="material-symbols-outlined text-slate-600 hover:text-primary transition-colors">settings_backup_restore</button>
</td>
</tr>
<tr class="hover:bg-white/[0.02] transition-colors group opacity-50">
<td class="px-6 py-4">
<p class="text-xs font-bold text-white terminal-text">sp_archive_old_races</p>
<p class="text-[9px] text-slate-500 mt-0.5 uppercase tracking-tighter font-mono">Scope: events_history</p>
</td>
<td class="px-6 py-4">
<span class="text-[9px] font-black text-slate-400 border border-border-dark px-2 py-0.5 uppercase bg-white/5">Stored Proc</span>
</td>
<td class="px-6 py-4">
<div class="flex items-center gap-1.5">
<span class="size-1.5 bg-slate-700 rounded-full"></span>
<span class="text-[10px] font-bold text-slate-500 uppercase">Offline</span>
</div>
</td>
<td class="px-6 py-4">
<span class="text-[10px] terminal-text text-slate-600">N/A</span>
</td>
<td class="px-6 py-4">
<span class="text-[10px] text-slate-600 uppercase font-medium">24h ago</span>
</td>
<td class="px-6 py-4 text-center">
<button class="material-symbols-outlined text-slate-700 hover:text-primary transition-colors">play_arrow</button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div>
<div class="flex items-center justify-between mb-4">
<div class="flex items-center gap-3">
<div class="w-1 h-4 bg-primary shadow-[0_0_8px_rgba(0,255,102,0.6)]"></div>
<h2 class="text-white text-xs font-black uppercase tracking-[0.25em]">v_audit_system :: Raw Stream</h2>
</div>
<div class="flex items-center gap-2">
<div class="flex border border-border-dark bg-card-dark p-1 rounded">
<button class="px-3 py-1 text-[9px] font-black uppercase text-primary bg-primary/10 rounded-sm">All</button>
<button class="px-3 py-1 text-[9px] font-black uppercase text-slate-500 hover:text-white transition-colors">Security</button>
<button class="px-3 py-1 text-[9px] font-black uppercase text-slate-500 hover:text-white transition-colors">Queries</button>
</div>
</div>
</div>
<div class="bg-black border border-border-dark rounded-sm overflow-hidden">
<div class="max-h-[400px] overflow-y-auto custom-scrollbar">
<table class="w-full text-left border-collapse table-fixed">
<thead class="sticky top-0 z-10">
<tr class="bg-card-dark border-b border-border-dark">
<th class="w-1/4 px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Timestamp</th>
<th class="w-1/6 px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Action</th>
<th class="w-1/4 px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Target</th>
<th class="w-1/6 px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Operator</th>
<th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Status</th>
</tr>
</thead>
<tbody class="terminal-text divide-y divide-border-dark/30">
<tr class="hover:bg-primary/[0.03] transition-colors group">
<td class="px-6 py-3 text-[10px] text-slate-500 font-mono">2023-11-24 14:00:05.123</td>
<td class="px-6 py-3 text-[10px] font-bold text-primary group-hover:neon-glow uppercase">UPDATE_TRIGGER</td>
<td class="px-6 py-3 text-[10px] text-slate-300">trg_update_race_slots</td>
<td class="px-6 py-3 text-[10px] text-slate-500">admin_super</td>
<td class="px-6 py-3"><span class="text-[9px] font-black text-primary border border-primary/20 bg-primary/5 px-2 py-0.5">OK</span></td>
</tr>
<tr class="hover:bg-primary/[0.03] transition-colors group">
<td class="px-6 py-3 text-[10px] text-slate-500 font-mono">2023-11-24 13:45:12.842</td>
<td class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase">EXEC_PROC</td>
<td class="px-6 py-3 text-[10px] text-slate-300">sp_generate_bib_numbers</td>
<td class="px-6 py-3 text-[10px] text-slate-500">system_worker_01</td>
<td class="px-6 py-3"><span class="text-[9px] font-black text-primary border border-primary/20 bg-primary/5 px-2 py-0.5">OK</span></td>
</tr>
<tr class="hover:bg-red-500/[0.05] transition-colors group">
<td class="px-6 py-3 text-[10px] text-slate-600 font-mono">2023-11-24 11:58:34.991</td>
<td class="px-6 py-3 text-[10px] font-bold text-red-500 uppercase">ACCESS_DENY</td>
<td class="px-6 py-3 text-[10px] text-slate-400">sys_config_table</td>
<td class="px-6 py-3 text-[10px] text-red-400">root_breach_8.8.8.8</td>
<td class="px-6 py-3"><span class="text-[9px] font-black text-red-500 border border-red-500/20 bg-red-500/5 px-2 py-0.5">CRIT</span></td>
</tr>
<tr class="hover:bg-primary/[0.03] transition-colors group">
<td class="px-6 py-3 text-[10px] text-slate-500 font-mono">2023-11-24 11:30:15.000</td>
<td class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase">DISABLE_OBJ</td>
<td class="px-6 py-3 text-[10px] text-slate-300">sp_archive_old_races</td>
<td class="px-6 py-3 text-[10px] text-slate-500">admin_super</td>
<td class="px-6 py-3"><span class="text-[9px] font-black text-primary border border-primary/20 bg-primary/5 px-2 py-0.5">OK</span></td>
</tr>
</tbody>
</table>
</div>
<div class="px-6 py-3 bg-card-dark border-t border-border-dark flex items-center justify-between">
<p class="text-[9px] font-black text-slate-600 uppercase tracking-widest">Buffer: 124,502 Active Logs</p>
<div class="flex gap-1">
<button class="size-6 flex items-center justify-center border border-border-dark text-slate-600 hover:text-white"><span class="material-symbols-outlined text-xs">chevron_left</span></button>
<button class="size-6 flex items-center justify-center bg-primary text-black text-[9px] font-bold">01</button>
<button class="size-6 flex items-center justify-center border border-border-dark text-slate-600 hover:text-white text-[9px] font-bold">02</button>
<button class="size-6 flex items-center justify-center border border-border-dark text-slate-600 hover:text-white"><span class="material-symbols-outlined text-xs">chevron_right</span></button>
</div>
</div>
</div>
</div>
</div>
<footer class="h-8 bg-black border-t border-border-dark px-8 flex items-center justify-between">
<div class="flex items-center gap-6 text-[9px] text-slate-600 font-mono uppercase font-bold tracking-widest">
<span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[12px] text-primary">database</span> host: jkt-db-master-01</span>
<span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[12px] text-primary">lan</span> node: 172.16.0.45</span>
</div>
<div class="text-[9px] text-slate-600 font-black uppercase tracking-widest">
                Pelari Kalcer © 2024 / Core Admin Console
            </div>
</footer>
</main>
</div>

</body></html>