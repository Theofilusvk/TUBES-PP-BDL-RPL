@extends('layouts.admin')

@section('title', 'Financial Reports')

@section('content')
<div class="flex flex-col h-full bg-background-dark">
    <header class="sticky top-0 z-10 flex items-center justify-between px-10 py-6 bg-background-dark/80 backdrop-blur-xl border-b border-border-dark">
        <div>
            <h2 class="text-2xl font-black text-white tracking-tight uppercase italic neon-glow">Financial Analytics <span class="text-accent-neon">Report</span></h2>
            <div class="flex items-center gap-2 mt-1">
                <span class="size-2 rounded-full bg-accent-neon animate-pulse"></span>
                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Live Connect</p>
            </div>
        </div>
        <div class="flex items-center gap-6">
            <button class="bg-accent-neon text-black px-6 py-2.5 rounded-full text-xs font-black uppercase tracking-widest hover:brightness-110 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">download</span>
                Export Statement
            </button>
        </div>
    </header>

    <div class="p-10 space-y-8 flex-1 overflow-auto">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-card-dark p-6 rounded-2xl border border-border-dark hover:border-accent-neon/30 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-accent-neon">payments</span>
                </div>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-1">Total Revenue</p>
                <p class="text-2xl font-black text-white tracking-tighter italic">Rp {{ number_format($totalRevenue) }}</p>
            </div>
            <div class="bg-card-dark p-6 rounded-2xl border border-border-dark hover:border-accent-neon/30 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-accent-neon">account_balance_wallet</span>
                </div>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-1">Net Profit (Est.)</p>
                <p class="text-2xl font-black text-white tracking-tighter italic">Rp {{ number_format($netProfit) }}</p>
            </div>
            <div class="bg-card-dark p-6 rounded-2xl border border-border-dark hover:border-accent-neon/30 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-accent-neon">pending_actions</span>
                </div>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-1">Pending Amount</p>
                <p class="text-2xl font-black text-white tracking-tighter italic">Rp {{ number_format($pendingAmount) }}</p>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="bg-card-dark rounded-3xl border border-border-dark overflow-hidden">
            <div class="p-8 border-b border-border-dark flex items-center justify-between">
                <h3 class="font-black text-white text-lg uppercase italic">Recent <span class="text-accent-neon">Transactions</span></h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5">
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">ID</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Amount</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Date</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-500">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-dark">
                        @forelse($transactions as $tx)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="px-8 py-5 text-sm font-black text-gray-300">#{{ substr($tx->pembayaran_id, 0, 8) }}</td>
                            <td class="px-8 py-5 text-sm font-black text-white italic">Rp {{ number_format($tx->nominal_bayar) }}</td>
                            <td class="px-8 py-5 text-[10px] font-bold text-gray-500">{{ $tx->tanggal_bayar }}</td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-white/5 text-white text-[10px] font-black rounded-full border border-white/10">{{ $tx->status_pembayaran }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-5 text-center text-gray-500">No transactions recorded.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
