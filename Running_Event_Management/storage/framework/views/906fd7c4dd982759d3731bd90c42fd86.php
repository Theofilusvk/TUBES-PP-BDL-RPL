

<?php $__env->startSection('title', 'Database Triggers | Pelari Kalcer'); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* Override colors/fonts for Triggers page */
    .bg-primary { background-color: #00ff66 !important; }
    .text-primary { color: #00ff66 !important; }
    .border-primary { border-color: #00ff66 !important; }
    /* Fonts */
    body, main { font-family: 'Plus Jakarta Sans', sans-serif !important; }
    .terminal-text { font-family: 'JetBrains Mono', monospace !important; }
</style>
<main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-background-dark">
    <header class="h-16 flex items-center justify-between px-8 border-b border-border-dark bg-black/50 backdrop-blur-md z-10">
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
            <div class="relative">
                <form method="GET" action="<?php echo e(route('admin.triggers')); ?>">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-sm">search</span>
                    <input name="search" value="<?php echo e(request('search')); ?>" class="w-64 h-8 bg-card-dark border border-border-dark rounded text-[10px] pl-9 focus:ring-1 focus:ring-primary focus:border-primary text-slate-300 placeholder:text-slate-600 uppercase tracking-widest font-bold" placeholder="Query Object Logs..." type="text"/>
                </form>
            </div>
            <button class="size-8 flex items-center justify-center rounded bg-card-dark border border-border-dark text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-lg">sync</span>
            </button>
        </div>
    </header>
    <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
        <div class="grid grid-cols-4 gap-4 mb-8">
            <div class="bg-card-dark p-4 border border-border-dark rounded-sm">
                <div class="flex justify-between items-start mb-2">
                    <p class="text-slate-500 text-[9px] font-black uppercase tracking-[0.2em]">Active Triggers</p>
                    <span class="material-symbols-outlined text-primary text-sm">bolt</span>
                </div>
                <h3 class="text-2xl font-black text-white terminal-text">05</h3>
                <p class="text-[9px] text-primary/60 font-bold uppercase mt-1 tracking-tighter">Status: Nominal</p>
            </div>
            <!-- More stats can be added here -->
        </div>
        
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-4 bg-primary shadow-[0_0_8px_rgba(0,255,102,0.6)]"></div>
                    <h2 class="text-white text-xs font-black uppercase tracking-[0.25em]">Schema Objects Matrix</h2>
                </div>
            </div>
            <div class="bg-card-dark border border-border-dark overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/40 border-b border-border-dark">
                            <th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Object Identifier</th>
                            <th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Classification</th>
                            <th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Status</th>
                            <th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Latency</th>
                            <th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500">Last Exec</th>
                            <th class="px-6 py-3 text-[9px] font-black uppercase tracking-widest text-slate-500 text-center">Protocol</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-dark">
                    <tbody class="divide-y divide-border-dark">
                         <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-6 py-4">
                                <p class="text-xs font-bold text-white terminal-text"><?php echo e($log->DetailAktivitas); ?></p>
                                <p class="text-[9px] text-slate-500 mt-0.5 uppercase tracking-tighter font-mono">User: <?php echo e($log->Username); ?></p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-[9px] font-black text-primary border border-primary/30 px-2 py-0.5 uppercase"><?php echo e($log->TipeAktivitas); ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="size-1.5 bg-primary rounded-full shadow-[0_0_5px_#00ff66]"></span>
                                    <span class="text-[10px] font-bold text-slate-300 uppercase">Logged</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-[10px] terminal-text text-slate-500">0.02s</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-[10px] text-slate-500 uppercase font-medium"><?php echo e(\Carbon\Carbon::parse($log->WaktuLog)->diffForHumans()); ?></span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button class="material-symbols-outlined text-slate-600 hover:text-primary transition-colors">history</button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500 text-xs uppercase tracking-widest font-bold">No system logs found</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Kuliah\Semester 3\Rekayasa Perangkat Lunak\TUBES-PP-BDL-RPL\Running_Event_Management\resources\views/admin/triggers.blade.php ENDPATH**/ ?>