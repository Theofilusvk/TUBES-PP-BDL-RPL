

<?php $__env->startSection('title', 'Event Details | ' . $event->NamaEvent); ?>

<?php $__env->startSection('content'); ?>
<main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-background-dark">
    <!-- Header -->
    <header class="h-24 border-b border-border-dark flex items-center justify-between px-10 bg-background-dark/80 backdrop-blur-xl z-10 shrink-0">
        <div class="flex items-center gap-6">
            <a href="<?php echo e(route('admin.events')); ?>" class="w-10 h-10 rounded-xl bg-surface-dark border border-border-dark flex items-center justify-center text-slate-400 hover:text-white hover:border-primary transition-all group">
                <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
            </a>
            <div>
                <h2 class="text-2xl font-display font-bold text-white tracking-tight"><?php echo e($event->NamaEvent); ?></h2>
                <div class="flex items-center gap-3 mt-1">
                    <span class="text-[10px] font-mono text-slate-500 uppercase tracking-widest bg-surface-dark px-2 py-0.5 rounded border border-border-dark">ID: #<?php echo e($event->EventID); ?></span>
                    <?php
                        $statusColors = [
                            'Upcoming' => 'text-blue-400 bg-blue-400/10 border-blue-400/30',
                            'Ongoing' => 'text-primary bg-primary/10 border-primary/30',
                            'Closed' => 'text-red-400 bg-red-400/10 border-red-400/30'
                        ];
                        $statusClass = $statusColors[$event->StatusEvent] ?? 'text-slate-400 bg-slate-400/10 border-slate-400/30';
                    ?>
                    <span class="text-[10px] font-bold tracking-widest uppercase px-2 py-1 rounded border <?php echo e($statusClass); ?>"><?php echo e($event->StatusEvent); ?></span>
                </div>
            </div>
        </div>
        
        <div class="flex items-center gap-4">
             <form action="<?php echo e(route('admin.events.destroy', $event->EventID)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone and will remove all related data (Categories, Slots, Prices).');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="px-6 py-2.5 bg-red-500/10 text-red-500 border border-red-500/20 rounded-xl text-sm font-extrabold hover:bg-red-500 hover:text-white transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-xl">delete</span>
                    DELETE
                </button>
            </form>
             <a href="<?php echo e(route('admin.events.edit', $event->EventID)); ?>" class="px-6 py-2.5 bg-primary text-background-dark rounded-xl text-sm font-extrabold hover:brightness-110 transition-all flex items-center gap-2 shadow-[0_0_20px_rgba(0,255,128,0.2)]">
                <span class="material-symbols-outlined text-xl">edit_document</span>
                EDIT EVENT
            </a>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto custom-scrollbar p-10 space-y-10">
        <!-- Overview & Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Details Card -->
            <div class="lg:col-span-2 space-y-8">
                 <div class="bg-card-dark rounded-2xl border border-border-dark p-8 overflow-hidden relative group">
                    <?php if($event->GambarEvent): ?>
                        <img src="<?php echo e(asset($event->GambarEvent)); ?>" alt="Event Banner" class="w-full h-48 object-cover rounded-xl mb-6 border border-border-dark/50">
                    <?php endif; ?>
                    
                    <h3 class="text-lg font-display font-bold text-white mb-4 uppercase tracking-wide">Event Description</h3>
                    <p class="text-slate-400 leading-relaxed text-sm">
                        <?php echo e($event->DeskripsiEvent); ?>

                    </p>

                    <div class="mt-8 grid grid-cols-2 gap-6">
                        <div>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Location</span>
                            <span class="text-white font-medium"><?php echo e($event->LokasiEvent ?? 'N/A'); ?></span>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Start Date</span>
                             <!-- Assuming first category date or event date -->
                             <?php
                                $startDate = $event->categories->first()->slots->first()->TanggalMulai ?? null;
                             ?>
                            <span class="text-white font-medium"><?php echo e($startDate ? \Carbon\Carbon::parse($startDate)->format('d M Y, H:i') : 'TBA'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Categories List -->
                <div class="space-y-4">
                     <h3 class="text-lg font-display font-bold text-white uppercase tracking-wide">Race Categories</h3>
                     <?php $__currentLoopData = $event->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-surface-dark/40 border border-border-dark rounded-xl p-6 hover:bg-surface-dark/60 transition-colors">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="text-primary font-bold text-lg"><?php echo e($category->NamaKategori); ?></h4>
                                    <span class="text-xs text-slate-500 font-mono"><?php echo e($category->Jarak); ?></span>
                                </div>
                                <span class="text-white font-bold bg-white/5 px-3 py-1 rounded-lg">IDR <?php echo e(number_format($category->Harga, 0, ',', '.')); ?></span>
                            </div>
                            
                            <!-- Slots for this category -->
                             <?php $__currentLoopData = $category->slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="mt-4 bg-black/20 p-4 rounded-lg border border-white/5">
                                    <div class="flex justify-between items-end mb-2">
                                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Quota Usage</span>
                                        <span class="text-xs font-bold text-white"><?php echo e($slot->KuotaTotal - $slot->KuotaTersisa); ?> / <?php echo e($slot->KuotaTotal); ?> Runners</span>
                                    </div>
                                    <?php
                                        $percent = $slot->KuotaTotal > 0 ? round((($slot->KuotaTotal - $slot->KuotaTersisa) / $slot->KuotaTotal) * 100) : 0;
                                    ?>
                                    <div class="w-full bg-border-dark h-1.5 rounded-full overflow-hidden">
                                        <div class="<?php echo e($percent >= 100 ? 'bg-red-500' : 'bg-primary'); ?> h-full" style="width: <?php echo e($percent); ?>%"></div>
                                    </div>
                                </div>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Participant Results Management -->
                <div class="mt-8 space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-display font-bold text-white uppercase tracking-wide">Participant Results Management</h3>
                        <span class="text-xs text-slate-500 font-mono"><?php echo e(count($participants)); ?> Registered</span>
                    </div>

                    <?php if(session('success')): ?>
                        <div class="bg-primary/10 border border-primary/30 text-primary px-4 py-3 rounded-lg text-sm">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="bg-red-500/10 border border-red-500/30 text-red-500 px-4 py-3 rounded-lg text-sm">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="bg-card-dark border border-border-dark rounded-xl overflow-hidden">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-surface-dark/60 border-b border-border-dark">
                                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">BIB</th>
                                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Participant Name</th>
                                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Category</th>
                                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Finish Time</th>
                                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Rank</th>
                                    <th class="px-6 py-4 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border-dark">
                                <?php $__empty_1 = true; $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-surface-dark/30 transition-colors group">
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-mono font-bold text-primary bg-primary/10 px-2 py-1 rounded border border-primary/30"><?php echo e($participant->NomorBIB ?? 'N/A'); ?></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-medium text-white"><?php echo e($participant->NamaLengkap); ?></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs text-slate-400"><?php echo e($participant->NamaKategori); ?></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="<?php echo e(route('admin.events.results.update')); ?>" method="POST" class="flex items-center gap-2">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="PendaftaranID" value="<?php echo e($participant->PendaftaranID); ?>">
                                            <input 
                                                type="text" 
                                                name="WaktuFinish" 
                                                value="<?php echo e($participant->WaktuFinish); ?>"
                                                placeholder="HH:MM:SS"
                                                class="w-28 px-3 py-1.5 bg-surface-dark border border-border-dark rounded text-xs text-white placeholder:text-slate-600 focus:border-primary focus:ring-1 focus:ring-primary outline-none"
                                            >
                                    </td>
                                    <td class="px-6 py-4">
                                            <input 
                                                type="number" 
                                                name="PeringkatUmum" 
                                                value="<?php echo e($participant->PeringkatUmum); ?>"
                                                placeholder="Rank"
                                                min="1"
                                                class="w-20 px-3 py-1.5 bg-surface-dark border border-border-dark rounded text-xs text-white placeholder:text-slate-600 focus:border-primary focus:ring-1 focus:ring-primary outline-none"
                                            >
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                            <button type="submit" class="px-4 py-1.5 bg-primary/10 text-primary border border-primary/30 rounded text-xs font-bold hover:bg-primary hover:text-black transition-all">
                                                SAVE
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                        <span class="material-symbols-outlined text-4xl mb-2 opacity-20">person_off</span>
                                        <p class="text-sm">No participants registered for this event yet.</p>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar Stats -->
            <div class="space-y-6">
                 <div class="bg-primary/10 border border-primary/20 rounded-2xl p-6">
                    <h4 class="text-primary font-bold uppercase tracking-widest text-xs mb-4">Total Registration</h4>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-display font-black text-white"><?php echo e($event->registered); ?></span>
                        <span class="text-slate-500 font-medium">/ <?php echo e($event->totalQuota); ?> capacity</span>
                    </div>
                    
                    <div class="mt-4 w-full bg-black/20 h-2 rounded-full overflow-hidden">
                        <div class="<?php echo e($event->percentage >= 100 ? 'bg-red-500' : 'bg-primary'); ?> h-full transition-all duration-1000" style="width: <?php echo e($event->percentage); ?>%"></div>
                    </div>
                    <div class="mt-2 text-right text-xs font-bold text-primary"><?php echo e($event->percentage); ?>% Fill Rate</div>
                 </div>

                 <!-- Financial Estimate -->
                  <div class="bg-surface-dark border border-border-dark rounded-2xl p-6">
                    <h4 class="text-slate-400 font-bold uppercase tracking-widest text-xs mb-4">Estimated Revenue</h4>
                     <?php
                        $revenue = 0;
                        foreach($event->categories as $cat) {
                            foreach($cat->slots as $slot) {
                                $joined = $slot->KuotaTotal - $slot->KuotaTersisa;
                                $revenue += $joined * $cat->Harga;
                            }
                        }
                     ?>
                    <div class="text-3xl font-display font-black text-emerald-400">
                        IDR <?php echo e(number_format($revenue, 0, ',', '.')); ?>

                    </div>
                    <p class="text-xs text-slate-500 mt-2">Based on current registrations</p>
                 </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Kuliah\Semester 3\Rekayasa Perangkat Lunak\TUBES-PP-BDL-RPL\Running_Event_Management\resources\views/admin/events/show.blade.php ENDPATH**/ ?>