@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="flex flex-col h-full bg-[radial-gradient(circle_at_top_right,_#0d1117_0%,_#05070a_100%)]">
    <header class="p-10 pb-6 border-b border-white/5">
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
            
            <!-- Add User Button -->
            <button class="flex items-center gap-2 px-6 h-12 bg-primary text-black font-black rounded-sm hover:brightness-110 transition-all neon-glow-primary active:scale-95 text-xs tracking-widest uppercase">
                <span class="material-symbols-outlined text-lg">person_add</span>
                <span>Deploy New User</span>
            </button>
        </div>
    </header>

    <!-- Content Table -->
    <section class="px-10 py-6 flex-1 overflow-auto">
        <div class="bg-card-dark border border-border-dark rounded-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/50 border-b border-border-dark">
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Operative Identity</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Communication</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Authority Level</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-dark">
                    @forelse($users as $user)
                    <tr class="hover:bg-primary/5 transition-colors group">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-sm bg-cover bg-center border border-border-dark bg-slate-800 flex items-center justify-center text-slate-400 font-bold">
                                    {{ substr($user->NamaLengkap, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-[13px] font-bold text-white uppercase tracking-tight">{{ $user->NamaLengkap }}</p>
                                    <p class="text-[9px] font-mono text-primary/60 tracking-tighter">UID: PK_{{ $user->PenggunaID }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-[12px] text-slate-300">{{ $user->Email }}</p>
                            <p class="text-[9px] text-slate-500 font-mono">{{ $user->Username }}</p>
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-2 py-0.5 text-[9px] font-black border border-slate-700 text-slate-500 bg-slate-800/20 rounded-sm uppercase tracking-tighter">
                                {{ $user->PeranID == 1 ? 'Admin' : 'Participant' }}
                            </span>
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
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-500 text-sm">No operatives found in the registry.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </section>
</div>
@endsection
