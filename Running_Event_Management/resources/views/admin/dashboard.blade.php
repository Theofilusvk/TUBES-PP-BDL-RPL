@extends('layouts.admin')

@section('title', 'Admin Dashboard | Pelari Kalcer')

@section('content')
<header class="h-20 flex items-center justify-between px-10 border-b border-slate-200 dark:border-border-dark bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md sticky top-0 z-10">
    <div class="flex items-center gap-2">
        
    </div>
    <div class="flex items-center gap-6">
        <div class="flex items-center gap-4">
            @include('admin.partials.notification-button')

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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="{{ route('admin.users') }}" class="p-6 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark flex flex-col justify-between group hover:border-primary hover:shadow-[0_0_20px_rgba(0,255,128,0.05)] transition-all duration-300 cursor-pointer block">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">groups</span>
                    <span class="text-xs font-bold text-primary px-2 py-1 bg-primary/10 rounded-sm">ROLE : USER</span>
                </div>
                <p class="text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-1">Total Participants</p>
                <p class="text-3xl font-bold tracking-tighter text-slate-900 dark:text-white">{{ number_format($totalParticipants ?? 0) }}</p>
            </div>
        </a>
        <a href="{{ route('admin.users') }}" class="p-6 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark flex flex-col justify-between group hover:border-primary hover:shadow-[0_0_20px_rgba(0,255,128,0.05)] transition-all duration-300 cursor-pointer block">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">admin_panel_settings</span>
                    <span class="text-xs font-bold text-primary px-2 py-1 bg-primary/10 rounded-sm">ROLE : ADMIN</span>
                </div>
                <p class="text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-1">Total Admins</p>
                <p class="text-3xl font-bold tracking-tighter text-slate-900 dark:text-white">{{ number_format($totalAdmins ?? 0) }}</p>
            </div>
        </a>
        <a href="{{ route('admin.users') }}" class="p-6 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark flex flex-col justify-between group hover:border-primary hover:shadow-[0_0_20px_rgba(0,255,128,0.05)] transition-all duration-300 cursor-pointer block">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">badge</span>
                    <span class="text-xs font-bold text-primary px-2 py-1 bg-primary/10 rounded-sm">ALL USERS</span>
                </div>
                <p class="text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-1">Total Accounts</p>
                <p class="text-3xl font-bold tracking-tighter text-slate-900 dark:text-white">{{ number_format($totalAccounts ?? 0) }}</p>
            </div>
        </a>

    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 p-8 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark hover:border-primary/50 transition-colors">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-lg font-bold uppercase tracking-widest text-slate-900 dark:text-white">Registration Analytics</h3>
                <div class="flex gap-2">
                    <a href="?range=7D" class="text-[10px] font-bold px-3 py-1 border border-slate-200 dark:border-gray-700 {{ $range == '7D' ? 'bg-primary text-gray-900 shadow-[0_0_10px_rgba(0,255,128,0.4)]' : 'bg-gray-100 dark:bg-gray-800 text-slate-400 hover:text-primary hover:border-primary' }} transition-colors rounded-sm">7D</a>
                    <a href="?range=30D" class="text-[10px] font-bold px-3 py-1 border border-slate-200 dark:border-gray-700 {{ $range == '30D' ? 'bg-primary text-gray-900 shadow-[0_0_10px_rgba(0,255,128,0.4)]' : 'bg-gray-100 dark:bg-gray-800 text-slate-400 hover:text-primary hover:border-primary' }} transition-colors rounded-sm">30D</a>
                    <a href="?range=1Y" class="text-[10px] font-bold px-3 py-1 border border-slate-200 dark:border-gray-700 {{ $range == '1Y' ? 'bg-primary text-gray-900 shadow-[0_0_10px_rgba(0,255,128,0.4)]' : 'bg-gray-100 dark:bg-gray-800 text-slate-400 hover:text-primary hover:border-primary' }} transition-colors rounded-sm">1Y</a>
                </div>
            </div>
            <div class="aspect-[16/7] relative border-l border-b border-slate-200 dark:border-gray-700 flex items-end justify-between px-2 pb-2 gap-2">
                @if(isset($chartData) && count($chartData) > 0)
                    @foreach($chartData as $data)
                    <div class="relative w-full bg-primary/20 hover:bg-primary/40 transition-all border-t-2 border-primary group cursor-pointer" style="height: {{ max($data['height'], 5) }}%">
                        <!-- Tooltip -->
                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 opacity-0 group-hover:opacity-100 transition-opacity z-10 pointer-events-none">
                            <div class="bg-gray-900 text-white text-[10px] px-3 py-2 rounded-lg shadow-xl whitespace-nowrap text-center border border-gray-700">
                                <div class="font-bold text-primary text-lg leading-none mb-1">{{ $data['value'] }}</div>
                                <div class="text-gray-400 uppercase tracking-wider text-[9px]">{{ $data['formatted_date'] }}</div>
                            </div>
                            <!-- Arrow -->
                            <div class="w-2 h-2 bg-gray-900 border-r border-b border-gray-700 transform rotate-45 absolute left-1/2 -translate-x-1/2 -bottom-1"></div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="absolute inset-0 flex items-center justify-center text-slate-500 text-xs uppercase tracking-widest">No data available for this period</div>
                @endif
            </div>
        </div>
        <div class="p-8 bg-white dark:bg-surface-dark border border-slate-200 dark:border-border-dark hover:border-primary/50 transition-colors">
            <h3 class="text-lg font-bold uppercase tracking-widest text-slate-900 dark:text-white mb-6">Recent Triggers</h3>
            <div class="space-y-6">
                @forelse($recentLogs as $log)
                <div class="flex gap-4 items-start group">
                    <div class="mt-1 w-2 h-2 rounded-full shadow-[0_0_5px_currentColor] {{ str_contains(strtolower($log['message']), 'error') ? 'bg-red-500 text-red-500' : 'bg-primary text-primary' }}"></div>
                    <div>
                        <p class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider group-hover:text-primary transition-colors">
                            {{ $log['type'] }}
                        </p>
                        <p class="text-[10px] text-slate-500">
                            {{ $log['time'] }} • {{ $log['status'] }}
                            <span class="block text-slate-400 normal-case mt-0.5">{{ Str::limit($log['message'], 50) }}</span>
                        </p>
                    </div>
                </div>
                @empty
                <div class="text-center text-slate-500 text-xs py-4 uppercase tracking-widest">No recent triggers found</div>
                @endforelse
            </div>
            <a href="{{ route('admin.notifications') }}" class="block text-center mt-8 w-full py-3 border border-slate-200 dark:border-border-dark text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:bg-primary hover:text-gray-900 hover:border-primary transition-all duration-300">
                View All Triggers
            </a>
        </div>
    </div>
    <div class="flex flex-wrap justify-between items-center pt-10 border-t border-slate-200 dark:border-border-dark opacity-50">
        <p class="text-[10px] uppercase tracking-[0.4em] font-bold">Admin Central V2.4.0-Stable</p>
        <div class="flex gap-8">
            
        </div>
    </div>
</div>
@endsection
