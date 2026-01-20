

<?php $__env->startSection('title', 'Notification Center | Pelari Kalcer'); ?>

<?php $__env->startSection('content'); ?>
<header class="p-10 pb-6">
    <div class="flex flex-wrap items-end justify-between gap-6">
        <div class="space-y-2">
            <div class="flex items-center gap-2 text-accent-cyan">
                <span class="h-[2px] w-6 bg-accent-cyan rounded-full"></span>
                <span class="text-[10px] font-bold uppercase tracking-[0.3em] neon-text-cyan">Communication Grid</span>
            </div>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight uppercase">Notification Center</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm max-w-xl leading-relaxed">
                Broadcast updates, alerts, and system messages to all registered participants in the Pelari Kalcer network.
            </p>
        </div>
        <div>
             <a href="<?php echo e(route('admin.users')); ?>" class="px-6 py-2.5 bg-surface-dark text-slate-300 border border-border-dark rounded-xl text-sm font-bold hover:text-white hover:border-primary transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                BACK TO USERS
            </a>
        </div>
    </div>
</header>
<section class="px-10 py-4 grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Broadcast Form -->
    <div class="lg:col-span-1">
        <div class="bg-card-dark border border-border-dark rounded-xl p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
            
            <h3 class="text-xl font-display font-bold text-white uppercase tracking-tight mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">campaign</span>
                Broadcast Message
            </h3>

            <?php if(session('success')): ?>
                <div class="mb-4 bg-emerald-500/20 text-emerald-500 border border-emerald-500/50 p-3 rounded-lg text-xs font-bold uppercase tracking-widest text-center">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
             <?php if(session('error')): ?>
                <div class="mb-4 bg-red-500/20 text-red-500 border border-red-500/50 p-3 rounded-lg text-xs font-bold uppercase tracking-widest text-center">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.notifications.broadcast')); ?>" method="POST" class="space-y-5">
                <?php echo csrf_field(); ?>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Target Channel</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="TipeNotifikasi" value="System" checked class="peer sr-only">
                            <div class="text-center py-2 rounded border border-border-dark bg-surface-dark text-slate-400 peer-checked:bg-primary peer-checked:text-black peer-checked:font-bold transition-all text-xs uppercase tracking-wider">
                                System
                            </div>
                        </label>
                         <label class="cursor-pointer">
                            <input type="radio" name="TipeNotifikasi" value="Email" class="peer sr-only">
                            <div class="text-center py-2 rounded border border-border-dark bg-surface-dark text-slate-400 peer-checked:bg-primary peer-checked:text-black peer-checked:font-bold transition-all text-xs uppercase tracking-wider">
                                Email
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="TipeNotifikasi" value="Web" class="peer sr-only">
                            <div class="text-center py-2 rounded border border-border-dark bg-surface-dark text-slate-400 peer-checked:bg-primary peer-checked:text-black peer-checked:font-bold transition-all text-xs uppercase tracking-wider">
                                Web
                            </div>
                        </label>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Link Event (Optional)</label>
                    <div class="relative">
                        <select name="EventID" class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white font-bold focus:ring-1 focus:ring-primary focus:border-primary transition-all appearance-none text-sm">
                            <option value="">-- No Linked Event --</option>
                            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($event->EventID); ?>"><?php echo e($event->NamaEvent); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none">expand_more</span>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Subject / Title</label>
                    <input type="text" name="JudulNotifikasi" placeholder="e.g. Important Race Update" class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white font-bold focus:ring-1 focus:ring-primary focus:border-primary transition-all placeholder:text-slate-600 text-sm" required />
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Message Content</label>
                    <textarea name="IsiNotifikasi" rows="6" placeholder="Type your message here..." class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white font-bold focus:ring-1 focus:ring-primary focus:border-primary transition-all placeholder:text-slate-600 text-sm custom-scrollbar resize-none" required></textarea>
                </div>

                <button type="submit" class="w-full py-3 bg-primary text-background-dark rounded-xl font-extrabold uppercase tracking-wide hover:brightness-110 transition-all shadow-[0_0_20px_rgba(0,255,128,0.2)] flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">send</span>
                    Send Broadcast
                </button>
                <p class="text-[10px] text-slate-500 text-center">This will be sent to all active participants immediately.</p>
            </form>
        </div>
    </div>

    <!-- History Table -->
    <div class="lg:col-span-2 space-y-4">
        <h3 class="text-xl font-display font-bold text-white uppercase tracking-tight flex items-center gap-2">
            <span class="material-symbols-outlined text-slate-400">history</span>
            Transmission Logs
        </h3>
        
        <div class="bg-card-dark border border-border-dark rounded-xl overflow-hidden">
             <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 border-b border-border-dark">
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Date</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Subject</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Channel</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Recipients</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-dark">
                    <?php $__empty_1 = true; $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4">
                            <span class="text-xs font-mono font-bold text-slate-400"><?php echo e(\Carbon\Carbon::parse($log->SentTime ?? $log->WaktuLog ?? now())->format('d M H:i')); ?></span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-white"><?php echo e($log->JudulNotifikasi); ?></p>
                            <p class="text-[10px] text-slate-500 line-clamp-1"><?php echo e(Str::limit($log->IsiNotifikasi, 50)); ?></p>
                        </td>
                         <td class="px-6 py-4">
                            <span class="text-[10px] font-bold text-slate-300 bg-surface-dark border border-border-dark px-2 py-1 rounded uppercase tracking-wider"><?php echo e($log->TipeNotifikasi); ?></span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-500 text-sm">check_circle</span>
                                <span class="text-xs font-bold text-emerald-500"><?php echo e($log->RecipientCount); ?> Sent</span>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-500 font-bold uppercase tracking-widest text-xs">No notifications sent yet.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
             <?php if($history->hasPages()): ?>
                <div class="p-4 border-t border-border-dark">
                    <?php echo e($history->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Kuliah\Semester 3\Rekayasa Perangkat Lunak\TUBES-PP-BDL-RPL\Running_Event_Management\resources\views/admin/notifications/index.blade.php ENDPATH**/ ?>