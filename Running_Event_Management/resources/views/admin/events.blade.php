@extends('layouts.admin')

@section('title', 'Event Configuration')

@section('content')
<div class="flex flex-col h-full bg-[radial-gradient(circle_at_top_right,_#1a1f26_0%,_#0a0a0a_100%)]">
    <header class="p-10 pb-6 border-b border-white/5">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight uppercase">Event Configuration</h2>
                <p class="text-slate-400 text-sm mt-1">Manage races, categories, and schedules.</p>
            </div>
            <button class="bg-primary text-black px-6 py-2.5 rounded-sm text-xs font-black uppercase tracking-widest hover:brightness-110 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">add</span>
                Create Event
            </button>
        </div>
    </header>

    <div class="p-10 flex-1 overflow-auto">
        <div class="grid grid-cols-1 gap-6">
            @forelse($events as $event)
            <div class="bg-card-dark border border-border-dark p-6 rounded-sm flex flex-col md:flex-row gap-6 relative group hover:border-primary/50 transition-all">
                <div class="absolute top-0 left-0 w-1 h-full bg-slate-800 group-hover:bg-primary transition-colors"></div>
                
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="px-2 py-0.5 text-[9px] font-black uppercase tracking-widest bg-primary/10 text-primary border border-primary/20 rounded-sm">
                            {{ $event->status_event ?? 'DRAFT' }}
                        </span>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $event->tanggal_mulai ?? 'TBA' }}</span>
                    </div>
                    <h3 class="text-xl font-black text-white uppercase tracking-tight mb-2">{{ $event->nama_event }}</h3>
                    <p class="text-sm text-slate-400 line-clamp-2">{{ $event->deskripsi_event }}</p>
                    
                    <div class="mt-4 flex items-center gap-4 text-xs font-bold text-slate-500 uppercase tracking-widest">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">location_on</span> {{ $event->lokasi_event }}</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">event</span> {{ $event->tanggal_selesai ?? 'TBA' }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-4 border-t md:border-t-0 md:border-l border-border-dark pt-4 md:pt-0 md:pl-6">
                    <button class="p-2 text-slate-400 hover:text-primary transition-colors border border-transparent hover:border-primary/30 rounded-full">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    <button class="p-2 text-slate-400 hover:text-white transition-colors border border-transparent hover:border-white/30 rounded-full">
                        <span class="material-symbols-outlined">settings</span>
                    </button>
                </div>
            </div>
            @empty
            <div class="text-center py-20 border border-dashed border-border-dark rounded-sm">
                <span class="material-symbols-outlined text-4xl text-slate-600 mb-4">event_busy</span>
                <p class="text-slate-500 font-bold uppercase tracking-widest">No events configured.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-6">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection
