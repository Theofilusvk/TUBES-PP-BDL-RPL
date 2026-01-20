<div class="relative" x-data="{ open: false, unreadCount: {{ $adminUnreadCount ?? 0 }} }">
    <button @click="open = !open" @click.outside="open = false" class="p-2 text-slate-500 hover:text-primary transition-colors relative">
        <span class="material-symbols-outlined">notifications</span>
        <span x-show="unreadCount > 0" class="absolute top-2 right-2 w-1.5 h-1.5 bg-primary rounded-full shadow-[0_0_5px_#00ff80]"></span>
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-2 w-80 bg-white dark:bg-card-dark border border-slate-200 dark:border-border-dark rounded-xl shadow-2xl z-50 overflow-hidden origin-top-right"
         style="display: none;">
         
        <div class="p-4 border-b border-slate-200 dark:border-border-dark flex items-center justify-between bg-slate-50/50 dark:bg-black/20">
            <h4 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">Notifications</h4>
            <button @click="markAllRead()" x-show="unreadCount > 0" class="text-[10px] font-bold text-primary hover:text-primary/80 transition-colors">Mark all read</button>
        </div>
        
        <div class="max-h-80 overflow-y-auto" id="admin-notification-list">
            @forelse($unreadNotifications as $notif)
            <div id="notif-{{ $notif->KirimID }}" class="block p-4 border-b border-slate-200 dark:border-border-dark hover:bg-slate-50 dark:hover:bg-white/[0.02] transition-colors group relative">
                @if($notif->EventID)
                <a href="{{ route('admin.events') }}" class="absolute inset-0 z-0"></a>
                @endif
                
                @if($notif->NamaEvent)
                    <div class="absolute top-2 right-2 px-1.5 py-0.5 rounded bg-primary/10 border border-primary/20 text-[8px] font-bold text-primary uppercase tracking-widest z-10">
                        Event Linked
                    </div>
                @endif
                <div class="flex gap-3 relative z-10 pointer-events-none">
                    <div class="mt-1 w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-black transition-colors shrink-0">
                        <span class="material-symbols-outlined text-sm">
                            {{ $notif->TipeNotifikasi == 'Web' ? 'language' : ($notif->TipeNotifikasi == 'Email' ? 'mail' : 'campaign') }}
                        </span>
                    </div>
                    <div class="flex-1 pointer-events-auto">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-bold text-slate-900 dark:text-white mb-0.5 pr-4">{{ $notif->JudulNotifikasi }}</p>
                            <button onclick="markAsRead('{{ $notif->KirimID }}')" class="text-[10px] font-bold text-primary hover:underline whitespace-nowrap ml-2">Mark Read</button>
                        </div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 leading-relaxed">{{ Str::limit($notif->IsiNotifikasi, 60) }}</p>
                        @if($notif->NamaEvent)
                            <p class="text-[10px] font-bold text-accent-cyan mt-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[10px]">event</span>
                                {{ $notif->NamaEvent }}
                            </p>
                        @endif
                        <p class="text-[10px] text-slate-400 mt-2 font-mono">{{ \Carbon\Carbon::parse($notif->WaktuKirim ?? now())->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <span class="material-symbols-outlined text-slate-300 text-4xl mb-2">notifications_off</span>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">No New Notifications</p>
            </div>
            @endforelse
        </div>
        <div class="p-3 bg-slate-50 dark:bg-black/20 text-center border-t border-slate-200 dark:border-border-dark">
            <a href="{{ route('admin.notifications') }}" class="text-[10px] font-bold text-slate-500 hover:text-primary uppercase tracking-widest transition-colors">View All History</a>
        </div>
    </div>
</div>

<script>
    function markAsRead(id) {
        const el = document.getElementById(`notif-${id}`);
        if(el) {
            el.style.opacity = '0.5';
            el.style.pointerEvents = 'none';
        }

        fetch(`/notifications/${id}/read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            if(res.ok) {
                if(el) el.remove();
                // Update Badge Count (Simple decrement)
                // In a full app, we'd bind this to Alpine data, but mixed mode needs care.
                // Reloading or emitting event is cleaner.
                window.location.reload(); 
            }
        });
    }

    function markAllRead() {
        if(!confirm('Mark all as read?')) return;
        
        fetch(`/notifications/read-all`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            if(res.ok) window.location.reload();
        });
    }
</script>
