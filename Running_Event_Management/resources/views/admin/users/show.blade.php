@extends('layouts.admin')

@section('title', 'User Profile | Pelari Kalcer')

@section('content')
<main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-background-dark">
    <!-- Header -->
    <header class="h-24 border-b border-border-dark flex items-center justify-between px-10 bg-background-dark/80 backdrop-blur-xl z-10 shrink-0">
        <div class="flex items-center gap-6">
            <a href="{{ route('admin.users') }}" class="w-10 h-10 rounded-xl bg-surface-dark border border-border-dark flex items-center justify-center text-slate-400 hover:text-white hover:border-primary transition-all group">
                <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
            </a>
            <div>
                <h2 class="text-2xl font-display font-bold text-white tracking-tight">User Profile</h2>
                <div class="flex items-center gap-3 mt-1">
                    <span class="text-[10px] font-mono text-slate-500 uppercase tracking-widest bg-surface-dark px-2 py-0.5 rounded border border-border-dark">ID: #{{ $user->PenggunaID }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                        Member since {{ \Carbon\Carbon::parse($user->created_at ?? now())->format('M Y') }}
                    </span>
                </div>
            </div>
        </div>
        
        <form action="{{ route('admin.users.destroy', $user->PenggunaID) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-6 py-2.5 bg-red-500/10 text-red-500 border border-red-500/20 rounded-xl text-sm font-extrabold hover:bg-red-500 hover:text-white transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">delete_forever</span>
                DELETE ACCOUNT
            </button>
        </form>
    </header>

    <div class="flex-1 overflow-y-auto custom-scrollbar p-10 space-y-10">
        
        @if(session('success'))
            <div class="bg-primary/20 text-primary border border-primary p-4 rounded-xl text-center font-bold uppercase tracking-widest">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500/20 text-red-500 border border-red-500 p-4 rounded-xl text-center font-bold uppercase tracking-widest">
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-500/20 text-red-500 border border-red-500 p-4 rounded-xl text-center font-bold uppercase tracking-widest">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Profile Edit Section -->
        <section class="max-w-4xl">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1 h-6 bg-primary rounded-full"></div>
                <h3 class="text-white font-display font-bold uppercase tracking-[0.15em] text-sm">Personal Data Configuration</h3>
            </div>
            
            <div class="bg-card-dark rounded-2xl border border-border-dark p-8">
                <form action="{{ route('admin.users.update', $user->PenggunaID) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Full Name</label>
                            <input type="text" name="NamaLengkap" value="{{ old('NamaLengkap', $user->NamaLengkap) }}" class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white font-bold focus:ring-1 focus:ring-primary focus:border-primary transition-all placeholder:text-slate-600" />
                        </div>
                        
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Email Address</label>
                            <input type="email" name="Email" value="{{ old('Email', $user->Email) }}" class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white font-bold focus:ring-1 focus:ring-primary focus:border-primary transition-all placeholder:text-slate-600" />
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Username</label>
                            <input type="text" name="Username" value="{{ old('Username', $user->Username) }}" class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white font-bold focus:ring-1 focus:ring-primary focus:border-primary transition-all placeholder:text-slate-600" />
                        </div>
                        
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Role ID (Internal)</label>
                            <input type="text" value="{{ $user->PeranID }}" disabled class="w-full bg-surface-dark/50 border border-border-dark rounded-xl px-4 py-3 text-slate-500 font-bold cursor-not-allowed" />
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-border-dark/50">
                        <button type="submit" class="px-8 py-3 bg-primary text-background-dark rounded-xl font-extrabold uppercase tracking-wide hover:brightness-110 transition-all shadow-[0_0_20px_rgba(0,255,128,0.2)]">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Race History Section -->
        <section>
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1 h-6 bg-accent-cyan rounded-full"></div>
                <h3 class="text-white font-display font-bold uppercase tracking-[0.15em] text-sm">Race Performance History</h3>
            </div>
            
            <div class="bg-card-dark rounded-2xl border border-border-dark overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5">
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-500">Event Name</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-500">Date</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-500">Category</th>
                             <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-500">Status</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-500 text-right">Finish Time</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-500 text-right">Pace (Avg)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-dark">
                        @forelse($raceHistory as $race)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-8 py-5">
                                <span class="text-sm font-bold text-white group-hover:text-primary transition-colors">{{ $race->NamaEvent }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-xs font-medium text-slate-400">{{ \Carbon\Carbon::parse($race->TanggalMulai)->format('d M Y') }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-[10px] font-black bg-surface-dark border border-border-dark px-2 py-1 rounded text-slate-300 uppercase tracking-tighter">{{ $race->NamaKategori }} ({{ $race->Jarak }})</span>
                            </td>
                             <td class="px-8 py-5">
                                @if($race->WaktuFinish)
                                    <span class="text-[10px] font-bold text-emerald-500 bg-emerald-500/10 px-2 py-1 rounded border border-emerald-500/20 uppercase">Completed</span>
                                @else
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-500/10 px-2 py-1 rounded border border-slate-500/20 uppercase">{{ $race->StatusPendaftaran ?? 'Registered' }}</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right">
                                <span class="text-sm font-mono font-bold text-white">{{ $race->WaktuFinish ?? '--:--:--' }}</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <span class="text-sm font-mono font-bold text-accent-cyan">{{ $race->Pace }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-10 text-center text-slate-500 font-bold uppercase tracking-widest text-xs">No race history found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>
@endsection
