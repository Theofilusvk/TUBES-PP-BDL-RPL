<!DOCTYPE html>
<html class="dark" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin User Management Control - Pelari Kalcer</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#00ff80",
                        "accent-cyan": "#00f0ff",
                        "secondary": "#FF00FF",
                        "background-dark": "#05070a",
                        "card-dark": "#0d1117",
                        "border-dark": "#1f2937",
                        "sidebar-dark": "#080a0f"
                    },
                    fontFamily: {
                        "display": ["Space Grotesk", "sans-serif"]
                    }
                },
            },
        }
    </script>
<style type="text/tailwindcss">
        @layer base {
            body {
                @apply bg-background-dark text-slate-100 font-display antialiased;
            }
        }
        .neon-glow-primary {
            box-shadow: 0 0 15px rgba(0, 255, 128, 0.15);
        }
        .neon-text-primary {
            text-shadow: 0 0 8px rgba(0, 255, 128, 0.4);
        }
        .neon-text-cyan {
            text-shadow: 0 0 8px rgba(0, 240, 255, 0.4);
        }
        .active-nav-indicator {
            position: relative;
        }
        .active-nav-indicator::before {
            content: '';
            position: absolute;
            left: -1rem;
            top: 20%;
            bottom: 20%;
            width: 4px;
            background: #00ff80;
            border-radius: 0 4px 4px 0;
            box-shadow: 0 0 10px #00ff80;
        }
        ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #05070a;
        }
        ::-webkit-scrollbar-thumb {
            background: #1f2937;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #00ff80;
        }
    </style>
</head>
<body class="min-h-screen">
<div class="flex h-screen overflow-hidden">
<aside class="w-64 bg-sidebar-dark border-r border-border-dark flex flex-col shrink-0">
<div class="p-8 flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-primary/10 border border-primary/30 flex items-center justify-center neon-glow-primary">
<span class="material-symbols-outlined text-primary text-2xl font-bold">bolt</span>
</div>
<div>
<h1 class="text-sm font-black tracking-tighter text-white leading-none">PELARI KALCER</h1>
<span class="text-[9px] uppercase tracking-[0.2em] text-primary/80 font-bold">Admin Central</span>
</div>
</div>
<nav class="flex-1 px-4 space-y-1">
<a class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-primary transition-all rounded-lg group" href="#">
<span class="material-symbols-outlined text-[22px] group-hover:scale-110 transition-transform">dashboard</span>
<span class="text-sm font-medium tracking-wide">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 bg-primary/5 text-primary active-nav-indicator rounded-lg group" href="#">
<span class="material-symbols-outlined text-[22px] fill-1">group</span>
<span class="text-sm font-bold tracking-wide">User Management</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-primary transition-all rounded-lg group" href="#">
<span class="material-symbols-outlined text-[22px] group-hover:scale-110 transition-transform">settings_input_component</span>
<span class="text-sm font-medium tracking-wide">Event Configuration</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-primary transition-all rounded-lg group" href="#">
<span class="material-symbols-outlined text-[22px] group-hover:scale-110 transition-transform">payments</span>
<span class="text-sm font-medium tracking-wide">Financial Reports</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-primary transition-all rounded-lg group" href="#">
<span class="material-symbols-outlined text-[22px] group-hover:scale-110 transition-transform">database</span>
<span class="text-sm font-medium tracking-wide">Database Triggers</span>
</a>
</nav>
<div class="p-6 mt-auto border-t border-border-dark bg-black/20">
<div class="flex items-center gap-3">
<div class="w-9 h-9 rounded-lg bg-cover bg-center border border-border-dark" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD7LK_iQwL0EfaCOSCY2vUk5IAVhk6GPEVOxe_LF1iM5f1DDIrK52WTuMEUCUX7B-Zs1ynZX7uy-O1p8uQ4eWQA9r-splPDSrBJr9SamcS7eKaOq-S0Bty3Ql0NcVD-2FTp9DRJwZLuEQJE_VbA9TsdiJKe7C4fWCcBHlzKp5mFHFPX9ubfU0iSgTavv2KcvoXUANxXH3JDwWEqKeEeiyFAJLs_n_2Mze3NVYi5BpLDYpZBByA_HRkvSBpKGKBmGMDT92P__UlfHlA')"></div>
<div class="flex-1 min-w-0">
<p class="text-[11px] font-bold text-white truncate">Bagus Utama</p>
<p class="text-[9px] text-primary uppercase tracking-tighter">Super Admin</p>
</div>
<button class="text-slate-500 hover:text-secondary transition-colors">
<span class="material-symbols-outlined text-lg">logout</span>
</button>
</div>
</div>
</aside>
<main class="flex-1 flex flex-col min-w-0 overflow-y-auto bg-[radial-gradient(circle_at_top_right,_#0d1117_0%,_#05070a_100%)]">
<header class="p-10 pb-6">
<div class="flex flex-wrap items-end justify-between gap-6">
<div class="space-y-2">
<div class="flex items-center gap-2 text-accent-cyan">
<span class="h-[2px] w-6 bg-accent-cyan rounded-full"></span>
<span class="text-[10px] font-bold uppercase tracking-[0.3em] neon-text-cyan">Access Control Unit</span>
</div>
<h2 class="text-3xl font-black text-white tracking-tight uppercase">User Management</h2>
<p class="text-slate-400 text-sm max-w-xl leading-relaxed">
                            System-wide operative management. Execute role assignments, account verification, and security protocols for the Pelari Kalcer network.
                        </p>
</div>
<button class="flex items-center gap-2 px-6 h-12 bg-primary text-black font-black rounded-sm hover:brightness-110 transition-all neon-glow-primary active:scale-95 text-xs tracking-widest uppercase">
<span class="material-symbols-outlined text-lg">person_add</span>
<span>Deploy New User</span>
</button>
</div>
</header>
<section class="px-10 py-4">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
<div class="p-5 bg-card-dark border border-border-dark rounded-sm relative overflow-hidden group hover:border-primary/30 transition-colors">
<div class="absolute top-0 right-0 p-2 opacity-10 group-hover:opacity-20 transition-opacity">
<span class="material-symbols-outlined text-4xl">groups</span>
</div>
<span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Total Registry</span>
<div class="flex items-baseline gap-2 mt-1">
<span class="text-2xl font-black text-white tracking-tighter">12,480</span>
<span class="text-[10px] font-bold text-primary">+12%</span>
</div>
</div>
<div class="p-5 bg-card-dark border border-border-dark rounded-sm relative overflow-hidden group hover:border-accent-cyan/30 transition-colors">
<div class="absolute top-0 right-0 p-2 opacity-10 group-hover:opacity-20 transition-opacity">
<span class="material-symbols-outlined text-4xl">sensors</span>
</div>
<span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Active Sessions</span>
<div class="flex items-baseline gap-2 mt-1">
<span class="text-2xl font-black text-white tracking-tighter">342</span>
<span class="text-[10px] font-bold text-accent-cyan neon-text-cyan animate-pulse">LIVE</span>
</div>
</div>
<div class="p-5 bg-card-dark border border-border-dark rounded-sm relative overflow-hidden group hover:border-secondary/30 transition-colors">
<div class="absolute top-0 right-0 p-2 opacity-10 group-hover:opacity-20 transition-opacity">
<span class="material-symbols-outlined text-4xl">verified_user</span>
</div>
<span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Pending Sync</span>
<div class="flex items-baseline gap-2 mt-1">
<span class="text-2xl font-black text-white tracking-tighter">18</span>
<span class="text-[10px] font-bold text-secondary tracking-tighter uppercase">Queue</span>
</div>
</div>
<div class="p-5 bg-card-dark border border-border-dark rounded-sm relative overflow-hidden group hover:border-red-500/30 transition-colors">
<div class="absolute top-0 right-0 p-2 opacity-10 group-hover:opacity-20 transition-opacity">
<span class="material-symbols-outlined text-4xl">gpp_maybe</span>
</div>
<span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Security Flags</span>
<div class="flex items-baseline gap-2 mt-1">
<span class="text-2xl font-black text-white tracking-tighter">24</span>
<span class="text-[10px] font-bold text-red-500 tracking-tighter uppercase">Restricted</span>
</div>
</div>
</div>
</section>
<section class="px-10 py-6 space-y-4">
<div class="flex flex-wrap items-center justify-between gap-6">
<div class="flex items-center gap-1 bg-black/40 p-1.5 rounded-sm border border-border-dark">
<button class="px-4 py-1.5 text-[10px] font-black tracking-widest bg-primary text-black rounded-sm">ALL</button>
<button class="px-4 py-1.5 text-[10px] font-black tracking-widest text-slate-500 hover:text-white transition-colors">ADMIN</button>
<button class="px-4 py-1.5 text-[10px] font-black tracking-widest text-slate-500 hover:text-white transition-colors">PANITIA</button>
<button class="px-4 py-1.5 text-[10px] font-black tracking-widest text-slate-500 hover:text-white transition-colors">PETUGAS</button>
<button class="px-4 py-1.5 text-[10px] font-black tracking-widest text-slate-500 hover:text-white transition-colors">PESERTA</button>
</div>
<div class="relative flex-1 max-w-md">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-lg">search</span>
<input class="w-full h-10 pl-11 pr-4 bg-card-dark border border-border-dark rounded-sm text-xs focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-slate-600 outline-none transition-all" placeholder="SEARCH SYSTEM DATABASE..." type="text"/>
</div>
</div>
</section>
<section class="px-10 pb-10 flex-1">
<div class="bg-card-dark border border-border-dark rounded-sm overflow-hidden">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-black/50 border-b border-border-dark">
<th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Operative Identity</th>
<th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Communication</th>
<th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Authority Level</th>
<th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Last Sync</th>
<th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">System Status</th>
<th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500 text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-border-dark">
<tr class="hover:bg-primary/5 transition-colors group">
<td class="px-6 py-5">
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-sm bg-cover bg-center border border-border-dark group-hover:border-primary/50 transition-colors" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBzr0aPUvzxhu1QaSf3rcaHF8U6t2WPFaxm2Nr0WyLKBqLt8_x33MLAqJJPE-v-IGeYKiHTzN3O2tMIlBhgYcfrBthtFPAAIq2VGcGrKJV1OFkPspeWG5naNZDoXCtYHi_TwCZKA462oeuAKjizjwL_a41luMU4VMXmwnOVAC1FOnxyENfiXv26_xxeGZsBhxWHl2EkSiTWRDP_ljJeAKP741DzlQ421a-OiXmWwOA5wPFeBaHPxLBDzgri2cKcU-iNfOTqaLxQXsI')"></div>
<div>
<p class="text-[13px] font-bold text-white uppercase tracking-tight">Rizky Ramadhan</p>
<p class="text-[9px] font-mono text-primary/60 tracking-tighter">UID: PK_294X8</p>
</div>
</div>
</td>
<td class="px-6 py-5">
<p class="text-[12px] text-slate-300">rizky.r@pelarikalcer.id</p>
<p class="text-[9px] text-slate-500">+62 812 3456 7890</p>
</td>
<td class="px-6 py-5">
<span class="px-2 py-0.5 text-[9px] font-black border border-primary/30 text-primary bg-primary/5 rounded-sm uppercase tracking-tighter">Admin</span>
</td>
<td class="px-6 py-5">
<p class="text-[11px] text-slate-400">2 min ago</p>
<p class="text-[9px] text-slate-600 font-mono">IP: 182.1.22.4</p>
</td>
<td class="px-6 py-5">
<div class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-primary neon-glow-primary"></span>
<span class="text-[10px] font-black text-primary neon-text-primary uppercase tracking-widest">Active</span>
</div>
</td>
<td class="px-6 py-5 text-right">
<div class="flex items-center justify-end gap-3 opacity-20 group-hover:opacity-100 transition-opacity">
<button class="text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined text-xl">edit_square</span>
</button>
<button class="text-slate-400 hover:text-secondary transition-colors">
<span class="material-symbols-outlined text-xl">block</span>
</button>
</div>
</td>
</tr>
<tr class="hover:bg-primary/5 transition-colors group">
<td class="px-6 py-5">
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-sm bg-cover bg-center border border-border-dark group-hover:border-primary/50 transition-colors" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDBxze254_Bw-QxYU2nbl75Foqirij0xzzk-PlV1B77RaiOMDtuiVp1eRcxKJYkL5CMcbX6Vev0z028O4v2RHFkwtkm9wBhhcXccYsb44wX1HgwnimOMWhGqvi1ezwAM0lRljAJKbm5R-y_2S9W_cNUQUcJYDKHlZ588lEJ_uNazVaujdtTokcWSeynTaXgeas3ZJN456tx0altzlJPFDa3yxmxh2_8wPU-70WZUVatztsECCSwXHHtWu_hwEitK1bzH4zT5x9ulMc')"></div>
<div>
<p class="text-[13px] font-bold text-white uppercase tracking-tight">Siti Aisyah</p>
<p class="text-[9px] font-mono text-primary/60 tracking-tighter">UID: PK_103W4</p>
</div>
</div>
</td>
<td class="px-6 py-5">
<p class="text-[12px] text-slate-300">aisy@kalcer.id</p>
<p class="text-[9px] text-slate-500">+62 813 9876 5432</p>
</td>
<td class="px-6 py-5">
<span class="px-2 py-0.5 text-[9px] font-black border border-slate-700 text-slate-500 bg-slate-800/20 rounded-sm uppercase tracking-tighter">Panitia</span>
</td>
<td class="px-6 py-5">
<p class="text-[11px] text-slate-400">14 hrs ago</p>
<p class="text-[9px] text-slate-600 font-mono">IP: 10.1.2.98</p>
</td>
<td class="px-6 py-5">
<div class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-primary neon-glow-primary"></span>
<span class="text-[10px] font-black text-primary uppercase tracking-widest">Active</span>
</div>
</td>
<td class="px-6 py-5 text-right">
<div class="flex items-center justify-end gap-3 opacity-20 group-hover:opacity-100 transition-opacity">
<button class="text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined text-xl">edit_square</span>
</button>
<button class="text-slate-400 hover:text-secondary transition-colors">
<span class="material-symbols-outlined text-xl">block</span>
</button>
</div>
</td>
</tr>
<tr class="hover:bg-primary/5 transition-colors group">
<td class="px-6 py-5">
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-sm bg-cover bg-center border border-border-dark group-hover:border-secondary/50 transition-colors" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAZHoz21fPD99MlL83QUUYQRCO_dq6-9TEQHl5ZtHLhLpybYFPq8t_kPIRWhPEavf3cnU302akQxG1H09_0BjPdB8LrGHBVl-icQoIFKtcMzLtm5RyBA_2uFX6TxVRR1cEOOMko-P6cdCyJ-lJrWsShfXHJsbVQbuXIPMZg63aB18uySfA6c4s0vRxcyVE-YBtsSQ_vgu-VyRTocekb7ykFF4yTNvluXs879zVDWuuEY_is8JZK02ZJZ-NLk8omHAHkWETprZHETd4')"></div>
<div>
<p class="text-[13px] font-bold text-white uppercase tracking-tight">Ahmad Dhani</p>
<p class="text-[9px] font-mono text-primary/60 tracking-tighter">UID: PK_882S9</p>
</div>
</div>
</td>
<td class="px-6 py-5">
<p class="text-[12px] text-slate-300">dhani.petugas@gmail.com</p>
<p class="text-[9px] text-slate-500">+62 822 1122 3344</p>
</td>
<td class="px-6 py-5">
<span class="px-2 py-0.5 text-[9px] font-black border border-slate-700 text-slate-500 bg-slate-800/20 rounded-sm uppercase tracking-tighter">Petugas</span>
</td>
<td class="px-6 py-5">
<p class="text-[11px] text-slate-400">6 days ago</p>
<p class="text-[9px] text-slate-600 font-mono">IP: 192.168.1.1</p>
</td>
<td class="px-6 py-5">
<div class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
<span class="text-[10px] font-black text-secondary uppercase tracking-widest">Suspended</span>
</div>
</td>
<td class="px-6 py-5 text-right">
<div class="flex items-center justify-end gap-3 opacity-20 group-hover:opacity-100 transition-opacity">
<button class="text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined text-xl">settings_backup_restore</span>
</button>
<button class="text-slate-400 hover:text-secondary transition-colors">
<span class="material-symbols-outlined text-xl">delete</span>
</button>
</div>
</td>
</tr>
<tr class="hover:bg-primary/5 transition-colors group">
<td class="px-6 py-5">
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-sm bg-cover bg-center border border-border-dark group-hover:border-primary/50 transition-colors" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC8gcduvur61v6B-hmqsae-dNLh4KHvkZSYwyUvPpRP-bXO2obbY4XP24BccO17t0Ox7ZYfOqw8uJk6wchKTHR1JBLmZmlAp-G6dJ6vkV2TA88SDbkLEgRUHLi0ipT8tHdnUdhAUkJE807i0_gOSel8siKhtumfyGjm1csI5-eA0uqOmfRVHtI4ZaOwUCC29yqu2Ajqy1pj0_BgGI7PWLCqCSJmgoTP5WAYJg2iKiIuH_6Wu2R-iXuz5dro0DHgVfyvKLlPGuIAneY')"></div>
<div>
<p class="text-[13px] font-bold text-white uppercase tracking-tight">Eka Pratama</p>
<p class="text-[9px] font-mono text-primary/60 tracking-tighter">UID: PK_551A2</p>
</div>
</div>
</td>
<td class="px-6 py-5">
<p class="text-[12px] text-slate-300">eka.runner@mail.id</p>
<p class="text-[9px] text-slate-500">+62 811 0000 1111</p>
</td>
<td class="px-6 py-5">
<span class="px-2 py-0.5 text-[9px] font-black border border-slate-700 text-slate-500 bg-slate-800/20 rounded-sm uppercase tracking-tighter">Peserta</span>
</td>
<td class="px-6 py-5">
<p class="text-[11px] text-slate-400">Just now</p>
<p class="text-[9px] text-slate-600 font-mono">IP: 103.11.22.41</p>
</td>
<td class="px-6 py-5">
<div class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-primary neon-glow-primary"></span>
<span class="text-[10px] font-black text-primary uppercase tracking-widest">Active</span>
</div>
</td>
<td class="px-6 py-5 text-right">
<div class="flex items-center justify-end gap-3 opacity-20 group-hover:opacity-100 transition-opacity">
<button class="text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined text-xl">edit_square</span>
</button>
<button class="text-slate-400 hover:text-secondary transition-colors">
<span class="material-symbols-outlined text-xl">block</span>
</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="flex items-center justify-between mt-8">
<p class="text-[10px] text-slate-500 tracking-widest uppercase font-bold">Showing <span class="text-primary">1-10</span> of 12,480 registry entries</p>
<div class="flex items-center gap-1.5">
<button class="w-8 h-8 flex items-center justify-center rounded-sm border border-border-dark hover:border-primary transition-colors disabled:opacity-20" disabled="">
<span class="material-symbols-outlined text-base">chevron_left</span>
</button>
<button class="w-8 h-8 flex items-center justify-center rounded-sm border border-primary bg-primary/10 text-primary text-[10px] font-black">01</button>
<button class="w-8 h-8 flex items-center justify-center rounded-sm border border-border-dark hover:border-primary text-[10px] font-bold transition-colors">02</button>
<button class="w-8 h-8 flex items-center justify-center rounded-sm border border-border-dark hover:border-primary text-[10px] font-bold transition-colors">03</button>
<span class="px-2 text-slate-600 text-xs">...</span>
<button class="w-8 h-8 flex items-center justify-center rounded-sm border border-border-dark hover:border-primary text-[10px] font-bold transition-colors">1248</button>
<button class="w-8 h-8 flex items-center justify-center rounded-sm border border-border-dark hover:border-primary transition-colors">
<span class="material-symbols-outlined text-base">chevron_right</span>
</button>
</div>
</div>
</section>
</main>
</div>

</body></html>