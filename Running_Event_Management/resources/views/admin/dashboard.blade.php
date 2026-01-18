@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="p-10 space-y-10">
    <!-- Header Section -->
    <div class="flex flex-col gap-2">
        <h2 class="text-4xl font-bold tracking-tighter text-slate-900 dark:text-white uppercase leading-none">
            Dashboard Overview<span class="text-primary drop-shadow-[0_0_8px_rgba(0,255,128,0.5)]">.</span>
        </h2>
        <p class="text-slate-500 dark:text-slate-400 tracking-wide">Real-time system monitoring and performance metrics across the Kalcer ecosystem.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Users -->
        <div class="p-6 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark flex flex-col justify-between group hover:border-primary hover:shadow-[0_0_20px_rgba(0,255,128,0.05)] transition-all duration-300">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">groups</span>
                    <span class="text-xs font-bold text-primary px-2 py-1 bg-primary/10 rounded-sm">+12%</span>
                </div>
                <p class="text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-1">Total Active Users</p>
                <p class="text-3xl font-bold tracking-tighter text-slate-900 dark:text-white">{{ number_format($totalUsers ?? 0) }}</p>
            </div>
        </div>

        <!-- Events -->
        <div class="p-6 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark flex flex-col justify-between group hover:border-primary hover:shadow-[0_0_20px_rgba(0,255,128,0.05)] transition-all duration-300">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">stadium</span>
                    <span class="text-xs font-bold text-primary px-2 py-1 bg-primary/10 rounded-sm">LIVE</span>
                </div>
                <p class="text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-1">Ongoing Events</p>
                <p class="text-3xl font-bold tracking-tighter text-slate-900 dark:text-white">{{ $activeEvents ?? 0 }} Active Races</p>
            </div>
        </div>

        <!-- Revenue (Mocked for now) -->
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

        <!-- Health -->
        <div class="p-6 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark flex flex-col justify-between group hover:border-primary hover:shadow-[0_0_20px_rgba(0,255,128,0.05)] transition-all duration-300">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">dynamic_form</span>
                    <span class="text-xs font-bold text-primary px-2 py-1 bg-primary/10 rounded-sm">99.9%</span>
                </div>
                <p class="text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-1">System Health</p>
                <p class="text-3xl font-bold tracking-tighter text-primary drop-shadow-[0_0_5px_rgba(0,255,128,0.5)]">{{ $systemStatus ?? 'UNKNOWN' }}</p>
            </div>
        </div>
    </div>
    
    <!-- More sections (Charts, etc.) from original dashboard can be added here -->
    
</div>
@endsection
