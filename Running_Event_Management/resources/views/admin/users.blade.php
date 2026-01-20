@extends('layouts.admin')

@section('title', 'User Management | Pelari Kalcer')

@section('content')
<header class="p-10 pb-6">
    <div class="flex flex-wrap items-end justify-between gap-6">
        <div class="space-y-2">
            <div class="flex items-center gap-2 text-accent-cyan">
                <span class="h-[2px] w-6 bg-accent-cyan rounded-full"></span>
                <span class="text-[10px] font-bold uppercase tracking-[0.3em] neon-text-cyan">Access Control Unit</span>
            </div>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight uppercase">User Management</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm max-w-xl leading-relaxed">
                System-wide operative management. Execute role assignments, account verification, and security protocols for the Pelari Kalcer network.
            </p>
        </div>
        <div class="flex items-center gap-4">
             <a href="{{ route('admin.notifications') }}" class="px-6 py-2.5 bg-surface-dark text-slate-300 border border-border-dark rounded-xl text-sm font-bold hover:text-white hover:border-primary transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">notifications</span>
                NOTIFICATION FEATURES
            </a>

        </div>
    </div>
</header>
<section class="px-10 py-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Stats Cards -->
         <div class="p-5 bg-white dark:bg-card-dark border border-slate-200 dark:border-border-dark rounded-sm relative overflow-hidden group hover:border-primary/30 transition-colors">
            <div class="absolute top-0 right-0 p-2 opacity-10 group-hover:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-4xl">groups</span>
            </div>
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Total Participants</span>
            <div class="flex items-baseline gap-2 mt-1">
                <span class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter">{{ $totalParticipants ?? 0 }}</span>
            </div>
        </div>
        <div class="p-5 bg-white dark:bg-card-dark border border-slate-200 dark:border-border-dark rounded-sm relative overflow-hidden group hover:border-primary/30 transition-colors">
            <div class="absolute top-0 right-0 p-2 opacity-10 group-hover:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-4xl">admin_panel_settings</span>
            </div>
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Total Admins</span>
            <div class="flex items-baseline gap-2 mt-1">
                <span class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter">{{ $totalAdmins ?? 0 }}</span>
            </div>
        </div>
        <div class="p-5 bg-white dark:bg-card-dark border border-slate-200 dark:border-border-dark rounded-sm relative overflow-hidden group hover:border-accent-cyan/30 transition-colors">
            <div class="absolute top-0 right-0 p-2 opacity-10 group-hover:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-4xl">badge</span>
            </div>
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Total Accounts</span>
            <div class="flex items-baseline gap-2 mt-1">
                <span class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter">{{ $totalAccounts ?? 0 }}</span>
            </div>
        </div>
        <!-- Add other stats as needed -->
    </div>
</section>
<section class="px-10 py-6 space-y-4">
    <div class="flex flex-wrap items-center justify-between gap-6">
        <div class="flex items-center gap-1 bg-slate-100 dark:bg-black/40 p-1.5 rounded-sm border border-slate-200 dark:border-border-dark">
            <a href="{{ route('admin.users', ['filter' => 'all', 'search' => request('search')]) }}" class="px-4 py-1.5 text-[10px] font-black tracking-widest rounded-sm transition-colors {{ request('filter', 'all') == 'all' ? 'bg-primary text-black' : 'text-slate-500 hover:text-slate-900 dark:hover:text-white' }}">ALL</a>
            <a href="{{ route('admin.users', ['filter' => 'admin', 'search' => request('search')]) }}" class="px-4 py-1.5 text-[10px] font-black tracking-widest rounded-sm transition-colors {{ request('filter') == 'admin' ? 'bg-primary text-black' : 'text-slate-500 hover:text-slate-900 dark:hover:text-white' }}">ADMIN</a>
            <a href="{{ route('admin.users', ['filter' => 'participant', 'search' => request('search')]) }}" class="px-4 py-1.5 text-[10px] font-black tracking-widest rounded-sm transition-colors {{ request('filter') == 'participant' ? 'bg-primary text-black' : 'text-slate-500 hover:text-slate-900 dark:hover:text-white' }}">PARTICIPANT</a>
        </div>
        <form action="{{ route('admin.users') }}" method="GET" class="relative flex-1 max-w-md">
            <input type="hidden" name="filter" value="{{ request('filter', 'all') }}">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-lg">search</span>
            <input name="search" value="{{ request('search') }}" class="w-full h-10 pl-11 pr-4 bg-white dark:bg-card-dark border border-slate-200 dark:border-border-dark rounded-sm text-xs focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-slate-600 outline-none transition-all" placeholder="SEARCH SYSTEM DATABASE..." type="text"/>
        </form>
    </div>
</section>
<section class="px-10 pb-10 flex-1">
    <div class="bg-white dark:bg-card-dark border border-slate-200 dark:border-border-dark rounded-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-black/50 border-b border-slate-200 dark:border-border-dark">
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Identity</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Account</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Communication</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Database Key</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Authority</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-border-dark">
                @foreach($users as $user)
                <tr class="hover:bg-primary/5 transition-colors group">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 rounded-sm bg-cover bg-center border border-slate-200 dark:border-border-dark group-hover:border-primary/50 transition-colors" style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($user->NamaLengkap) }}&background=random')"></div>
                             <p class="text-[13px] font-bold text-slate-900 dark:text-white uppercase tracking-tight">{{ $user->NamaLengkap }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                         <p class="text-[11px] font-mono font-bold text-slate-400 group-hover:text-primary transition-colors">@ {{ $user->Username }}</p>
                    </td>
                    <td class="px-6 py-5">
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">{{ $user->Email }}</p>
                    </td>
                    <td class="px-6 py-5">
                        @if($user->PeranID == 1)
                            <span class="text-[10px] font-mono font-black text-primary border border-primary/50 bg-primary/10 px-2 py-1 rounded shadow-[0_0_10px_rgba(0,255,128,0.2)]">ADM-{{ str_pad($user->PenggunaID, 3, '0', STR_PAD_LEFT) }}</span>
                        @else
                            <span class="text-[10px] font-mono text-slate-500 border border-slate-700/50 bg-slate-800/10 px-2 py-0.5 rounded">USR-{{ str_pad($user->PenggunaID, 4, '0', STR_PAD_LEFT) }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-5">
                        <!-- Determine role label based on PeranID or relationship -->
                        @php
                            $roleName = $user->PeranID == 1 ? 'SUPER ADMIN' : 'PARTICIPANT';
                            $roleClass = $user->PeranID == 1 
                                ? 'border-primary/30 text-primary bg-primary/5 shadow-[0_0_8px_rgba(0,255,128,0.3)]' 
                                : 'border-slate-700 text-slate-500 bg-slate-800/20';
                        @endphp
                        <span class="px-2 py-0.5 text-[9px] font-black border {{ $roleClass }} rounded-sm uppercase tracking-tighter">{{ $roleName }}</span>
                    </td>
                    <!-- System Status can be implied or kept if needed, removing to fit 6 cols comfortably or keeping as part of row class/status dot -->
                    <td class="px-6 py-5 text-right">
                        @if(auth()->id() !== $user->PenggunaID && auth()->user()->PeranID == 1)
                        <div class="flex items-center gap-1 justify-end">
                            <button class="p-2 text-slate-500 hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-lg">mail</span>
                            </button>
                            <a href="{{ route('admin.users.show', $user->PenggunaID) }}" class="p-2 text-slate-500 hover:text-primary transition-colors flex items-center gap-1">
                                <span class="material-symbols-outlined text-lg">settings_account_box</span>
                                <span class="text-[10px] font-bold uppercase tracking-widest hidden group-hover:inline-block">Manage</span>
                            </a>
                        </div>
                        @elseif(auth()->id() === $user->PenggunaID)
                         <span class="text-[9px] font-bold text-slate-600 uppercase tracking-widest">CURRENT SESSION</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-8">
        {{ $users->links() }}
    </div>
</section>
@endsection
