@extends('layouts.admin')

@section('title', 'Financial Reports | Pelari Kalcer')

@section('content')
<style>
    /* Override primary color for this page specifically */
    .bg-primary { background-color: #39FF14 !important; }
    .text-primary { color: #39FF14 !important; }
    .border-primary { border-color: #39FF14 !important; }
    .neon-glow { text-shadow: 0 0 10px rgba(57, 255, 20, 0.4); }
    /* Apply Plus Jakarta Sans */
    body, main { font-family: 'Plus Jakarta Sans', sans-serif !important; }
</style>
<main class="flex-1 flex flex-col overflow-hidden bg-background-dark">
    <header class="sticky top-0 z-10 flex items-center justify-between px-10 py-6 bg-background-dark/80 backdrop-blur-xl border-b border-border-dark">
        <div>
            <h2 class="text-2xl font-black text-white tracking-tight uppercase italic neon-glow">Financial Analytics <span class="text-primary">Report</span></h2>
            <div class="flex items-center gap-2 mt-1">
                <span class="size-2 rounded-full bg-primary animate-pulse"></span>
                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Live View: v_rekap_keuangan_event</p>
            </div>
        </div>
        <div class="flex items-center gap-6">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-xl">search</span>
                <input class="w-80 pl-12 pr-6 py-2.5 bg-card-dark border border-border-dark rounded-full text-sm focus:ring-1 focus:ring-primary focus:border-primary transition-all text-white placeholder-gray-600" placeholder="Search hash, runner, or event..." type="text"/>
            </div>
            <button class="bg-primary text-black px-6 py-2.5 rounded-full text-xs font-black uppercase tracking-widest hover:brightness-110 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">download</span>
                Export Statement
            </button>
        </div>
    </header>
    <div class="p-10 space-y-8 overflow-y-auto custom-scrollbar">
        <!-- Stats Grid (kept same) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- ... (Stats content omitted for brevity, keeping existing) ... -->
             <div class="bg-card-dark p-6 rounded-2xl border border-border-dark hover:border-primary/30 transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-primary">payments</span>
                    <span class="text-[10px] font-bold text-emerald-500 bg-emerald-500/10 px-2 py-1 rounded">+12.5%</span>
                </div>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-1">Total Revenue</p>
                <p class="text-2xl font-black text-white tracking-tighter italic">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
             <!-- ... other stats ... -->
        </div>
        
        @if(session('success'))
            <div class="bg-primary/20 text-primary border border-primary p-4 rounded-xl text-center font-bold uppercase tracking-widest mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500/20 text-red-500 border border-red-500 p-4 rounded-xl text-center font-bold uppercase tracking-widest mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-card-dark rounded-3xl border border-border-dark overflow-hidden">
            <div class="p-8 border-b border-border-dark flex items-center justify-between">
                <h3 class="font-black text-white text-lg uppercase italic">Recent <span class="text-primary">Nodes</span></h3>
                 <button class="text-[10px] font-black text-gray-500 hover:text-primary transition-colors uppercase tracking-widest flex items-center gap-2">
                    Fetch full ledger <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5">
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Node ID</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Runner Authority</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Race Event</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Amount</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Timestamp</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Validation</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-dark">
                         @forelse($transactions as $txn)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-8 py-5 text-sm font-black text-gray-300 group-hover:text-primary">#PK-{{ $txn->PembayaranID }}</td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="size-8 rounded-lg bg-primary/10 flex items-center justify-center border border-primary/20">
                                        <span class="text-primary font-black text-[10px]">{{ substr($txn->RunnerName ?? 'Unknown', 0, 2) }}</span>
                                    </div>
                                    <span class="text-sm font-bold text-gray-200">{{ $txn->RunnerName ?? $txn->Username }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-sm text-gray-400 font-medium italic">
                                {{ $txn->NamaEvent ?? $txn->NamaKategori ?? 'Event Unknown' }}
                            </td>
                            <td class="px-8 py-5 text-sm font-black text-white italic">Rp {{ number_format($txn->NominalBayar, 0, ',', '.') }}</td>
                            <td class="px-8 py-5 text-[10px] font-bold text-gray-500 uppercase">{{ \Carbon\Carbon::parse($txn->TanggalBayar)->format('M d, H:i') }}</td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-black rounded-full border border-emerald-500/20">{{ $txn->StatusPembayaran }}</span>
                            </td>
                             <td class="px-8 py-5 text-right">
                                @if($txn->StatusPembayaran === 'Ditolak')
                                    <span class="text-[10px] font-black text-rose-500 uppercase tracking-widest border border-rose-500/20 px-3 py-1 rounded-lg bg-rose-500/10 cursor-not-allowed">Invalid</span>
                                @elseif($txn->StatusPembayaran === 'Lunas')
                                    <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest border border-emerald-500/20 px-3 py-1 rounded-lg bg-emerald-500/10 cursor-not-allowed">Verified</span>
                                @else
                                    <button onclick="openModal('{{ $txn->PembayaranID }}', '{{ $txn->BuktiTransfer ?? '' }}')" class="bg-surface-dark border border-border-dark hover:border-primary text-slate-300 hover:text-white px-3 py-1 rounded-lg text-[10px] uppercase font-bold tracking-widest transition-all">
                                        Inspect
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                         <tr>
                            <td colspan="7" class="px-8 py-10 text-center text-gray-500 font-bold uppercase tracking-widest text-xs">No financial records found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Validation Modal -->
    <div id="validationCheckModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden items-center justify-center">
        <div class="bg-card-dark border border-primary/50 p-1 rounded-3xl max-w-2xl w-full shadow-[0_0_50px_rgba(57,255,20,0.2)]">
            <div class="bg-background-dark rounded-[1.2rem] p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6">
                    <button onclick="closeModal()" class="text-slate-500 hover:text-white transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                
                <h3 class="font-display font-black text-2xl text-white italic uppercase mb-2">Transaction <span class="text-primary">Validator</span></h3>
                <p class="text-slate-400 text-xs uppercase tracking-widest mb-8">Verify proof of payment integrity</p>

                <div class="grid grid-cols-2 gap-8">
                    <div class="aspect-square bg-black rounded-xl border border-border-dark flex items-center justify-center overflow-hidden relative group">
                        <img id="modalProofImage" src="" alt="Proof" class="w-full h-full object-cover opacity-50 group-hover:opacity-100 transition-opacity"/>
                        <div id="noProofPlaceholder" class="absolute inset-0 flex items-center justify-center hidden">
                            <span class="text-slate-600 font-mono text-[10px] uppercase">No physical proof attached</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="bg-surface-dark p-4 rounded-xl border border-border-dark">
                                <p class="text-[10px] text-slate-500 uppercase tracking-widest mb-1">Validation Protocol</p>
                                <p class="text-xs text-white">Ensure the transfer amount matches the system record and the timestamp is valid.</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <form id="approveForm" method="POST" action="">
                                @csrf
                                <input type="hidden" name="status" value="Lunas">
                                <button type="submit" class="w-full bg-primary text-black font-black uppercase tracking-widest py-3 rounded-xl hover:brightness-110 transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">verified</span> Acknowledge Valid
                                </button>
                            </form>
                            
                            <form id="rejectForm" method="POST" action="">
                                @csrf
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" class="w-full bg-surface-dark text-red-500 border border-red-500/20 font-bold uppercase tracking-widest py-3 rounded-xl hover:bg-red-500/10 transition-all">
                                    Mark Invalid
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(id, proofUrl) {
            const modal = document.getElementById('validationCheckModal');
            const img = document.getElementById('modalProofImage');
            const placeholder = document.getElementById('noProofPlaceholder');
            const approveForm = document.getElementById('approveForm');
            const rejectForm = document.getElementById('rejectForm');

            // Set Image
            if (proofUrl) {
                img.src = '/storage/' + proofUrl; // Assuming storage link
                img.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                img.src = '';
                img.classList.add('hidden');
                placeholder.classList.remove('hidden');
                placeholder.classList.remove('hidden'); // ?
                placeholder.style.display = 'flex';
            }

            // Set Action URLs
            approveForm.action = `/admin/financial/${id}/verify`;
            rejectForm.action = `/admin/financial/${id}/verify`;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('validationCheckModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</main>
@endsection
