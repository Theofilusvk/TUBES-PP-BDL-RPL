

<?php $__env->startSection('title', 'Edit Event | ' . $event->NamaEvent); ?>

<?php $__env->startSection('content'); ?>
<main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-background-dark">
    <!-- Header -->
    <header class="h-24 border-b border-border-dark flex items-center justify-between px-10 bg-background-dark/80 backdrop-blur-xl z-10 shrink-0">
        <div class="flex items-center gap-6">
            <a href="<?php echo e(route('admin.events.show', $event->EventID)); ?>" class="w-10 h-10 rounded-xl bg-surface-dark border border-border-dark flex items-center justify-center text-slate-400 hover:text-white hover:border-primary transition-all group">
                <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
            </a>
            <div>
                <h2 class="text-2xl font-display font-bold text-white tracking-tight">Edit Event Configuration</h2>
                <div class="flex items-center gap-3 mt-1">
                    <span class="text-[10px] font-mono text-slate-500 uppercase tracking-widest bg-surface-dark px-2 py-0.5 rounded border border-border-dark">ID: #<?php echo e($event->EventID); ?></span>
                     <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Editing Metadata</span>
                </div>
            </div>
        </div>
        
        <div class="flex items-center gap-4">
            <button type="submit" form="edit-event-form" class="px-6 py-2.5 bg-primary text-background-dark rounded-xl text-sm font-extrabold hover:brightness-110 transition-all flex items-center gap-2 shadow-[0_0_20px_rgba(0,255,128,0.2)]">
                <span class="material-symbols-outlined text-xl">save</span>
                SAVE CHANGES
            </button>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto custom-scrollbar p-10">
        <div class="max-w-4xl mx-auto">
            <?php if(session('error')): ?>
                <div class="mb-6 bg-red-500/20 text-red-500 border border-red-500 p-4 rounded-xl text-center font-bold uppercase tracking-widest">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <form id="edit-event-form" action="<?php echo e(route('admin.events.update', $event->EventID)); ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <!-- General Info -->
                <section class="bg-card-dark rounded-2xl border border-border-dark p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1 h-6 bg-primary rounded-full"></div>
                        <h3 class="text-white font-display font-bold uppercase tracking-[0.15em] text-sm">General Information</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Event Name</label>
                            <input type="text" name="NamaEvent" value="<?php echo e(old('NamaEvent', $event->NamaEvent)); ?>" required class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white font-bold focus:ring-1 focus:ring-primary focus:border-primary transition-all placeholder:text-slate-600">
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Description</label>
                            <textarea name="DeskripsiEvent" rows="5" class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white font-medium focus:ring-1 focus:ring-primary focus:border-primary transition-all placeholder:text-slate-600 resize-none"><?php echo e(old('DeskripsiEvent', $event->DeskripsiEvent)); ?></textarea>
                        </div>

                         <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Location / Terrain</label>
                            <input type="text" name="Location" value="<?php echo e(old('Location', $event->LokasiEvent)); ?>" required class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white font-bold focus:ring-1 focus:ring-primary focus:border-primary transition-all placeholder:text-slate-600">
                        </div>
                    </div>
                </section>

                <!-- Configuration -->
                <section class="bg-card-dark rounded-2xl border border-border-dark p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1 h-6 bg-accent-cyan rounded-full"></div>
                        <h3 class="text-white font-display font-bold uppercase tracking-[0.15em] text-sm">System Configuration</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Detailed Status</label>
                            <select name="StatusEvent" class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-3 text-white font-bold focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all appearance-none cursor-pointer">
                                <option value="Buka" <?php echo e($event->StatusEvent == 'Buka' ? 'selected' : ''); ?>>Open (Buka)</option>
                                <option value="Tutup" <?php echo e($event->StatusEvent == 'Tutup' ? 'selected' : ''); ?>>Closed (Tutup)</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Current Banner</label>
                            <div class="flex items-center gap-4">
                                <?php if($event->GambarEvent): ?>
                                    <div class="w-16 h-16 rounded-lg overflow-hidden border border-border-dark shrink-0">
                                        <img src="<?php echo e(asset($event->GambarEvent)); ?>" class="w-full h-full object-cover">
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="GambarEvent" accept="image/*" class="w-full bg-surface-dark border border-border-dark rounded-xl px-4 py-2.5 text-sm text-slate-400 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-all cursor-pointer">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                        <div class="flex gap-3">
                            <span class="material-symbols-outlined text-blue-400">info</span>
                            <div>
                                <h4 class="text-sm font-bold text-blue-400 uppercase">Note on Categories</h4>
                                <p class="text-xs text-slate-400 mt-1">
                                    Editing race categories, distances, and pricing requires accessing the <strong>Slot Management Module</strong>, which is separate from this metadata editor to ensure data integrity for registered participants.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Kuliah\Semester 3\Rekayasa Perangkat Lunak\TUBES-PP-BDL-RPL\Running_Event_Management\resources\views/admin/events/edit.blade.php ENDPATH**/ ?>