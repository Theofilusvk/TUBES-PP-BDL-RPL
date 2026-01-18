@extends('layouts.admin')

@section('title', 'Database Triggers')

@section('content')
<div class="flex flex-col h-full bg-background-dark">
    <header class="flex items-center justify-between px-8 py-4 border-b border-border-dark bg-black/50 backdrop-blur-md z-10">
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
             <button class="size-8 flex items-center justify-center rounded bg-card-dark border border-border-dark text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-lg">sync</span>
            </button>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-8 custom-scrollbar space-y-8">
        <!-- DB Objects Status -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-4 bg-primary shadow-[0_0_8px_rgba(0,255,102,0.6)]"></div>
                    <h2 class="text-white text-xs font-black uppercase tracking-[0.25em]">Schema Objects Matrix</h2>
                </div>
            </div>
            
            <div class="bg-card-dark border border-border-dark overflow-hidden rounded-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/40 border-b border-border-dark">
                            <th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Object Identifier</th>
                            <th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Classification</th>
                            <th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Status</th>
                            <th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Latency</th>
                            <th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Last Exec</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-dark">
                        @foreach($dbObjects as $obj)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-6 py-4">
                                <p class="text-xs font-bold text-white terminal-text">{{ $obj['name'] }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-[9px] font-black text-primary border border-primary/30 px-2 py-0.5 uppercase">{{ $obj['type'] }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="size-1.5 bg-primary rounded-full shadow-[0_0_5px_#00ff66]"></span>
                                    <span class="text-[10px] font-bold text-slate-300 uppercase">{{ $obj['status'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4"><span class="terminal-text text-[10px] text-slate-500">{{ $obj['latency'] }}</span></td>
                            <td class="px-6 py-4"><span class="text-[10px] text-slate-500 uppercase font-medium">{{ $obj['last_exec'] }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- System Logs -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-4 bg-primary shadow-[0_0_8px_rgba(0,255,102,0.6)]"></div>
                    <h2 class="text-white text-xs font-black uppercase tracking-[0.25em]">v_audit_system :: Raw Stream</h2>
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
                            </tr>
                        </thead>
                        <tbody class="terminal-text divide-y divide-border-dark/30">
                            @forelse($logs as $log)
                            <tr class="hover:bg-primary/[0.03] transition-colors group">
                                <td class="px-6 py-3 text-[10px] text-slate-500 font-mono">{{ $log->waktu_aktivitas }}</td>
                                <td class="px-6 py-3 text-[10px] font-bold text-primary group-hover:neon-glow uppercase">{{ $log->tipe_aktivitas }}</td>
                                <td class="px-6 py-3 text-[10px] text-slate-300">{{ Str::limit($log->detail_aktivitas, 30) }}</td>
                                <td class="px-6 py-3 text-[10px] text-slate-500">{{ $log->Username ?? 'System' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-slate-500 text-[10px]">No logs captured in buffer.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
