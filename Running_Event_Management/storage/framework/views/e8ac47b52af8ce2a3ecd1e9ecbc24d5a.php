

<?php $__env->startSection('title', 'Events Hub'); ?>
<?php $__env->startSection('header_title', 'Events Hub'); ?>

<?php $__env->startSection('content'); ?>
<div x-data="eventModal" x-init="checkAutoOpen(<?php echo json_encode($events->firstWhere('EventID', request('event_id')), 512) ?>)" class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl lg:text-4xl font-display font-bold uppercase italic text-gray-900 dark:text-white">
                Events <span class="text-primary">Master Hub</span>
            </h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400 max-w-2xl">
                Manage your race portfolio. Create new events, track registrations, and coordinate race pack distributions all in one place.
            </p>
        </div>
    </div>

    <div class="border-b border-gray-200 dark:border-gray-700">
        <?php
            $isUpcoming = $filter === 'upcoming';
            $isPast = $filter === 'past';
            $isMyEvents = $filter === 'my_events';
        ?>
        <nav aria-label="Tabs" class="-mb-px flex space-x-8 overflow-x-auto no-scrollbar">
            <a class="<?php echo e($isUpcoming ? 'border-accent text-accent font-bold' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 font-medium'); ?> whitespace-nowrap py-4 px-1 border-b-2 text-sm flex items-center gap-2" 
               href="<?php echo e(route('dashboard.events', ['filter' => 'upcoming'])); ?>">
                <span class="material-icons text-lg">calendar_month</span>
                Upcoming Events
                <?php if($isUpcoming): ?>
                <span class="bg-accent/10 text-accent py-0.5 px-2.5 rounded-full text-xs ml-2"><?php echo e($events->count()); ?></span>
                <?php endif; ?>
            </a>
            <a class="<?php echo e($isPast ? 'border-accent text-accent font-bold' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 font-medium'); ?> whitespace-nowrap py-4 px-1 border-b-2 text-sm flex items-center gap-2" 
               href="<?php echo e(route('dashboard.events', ['filter' => 'past'])); ?>">
                <span class="material-icons text-lg">history</span>
                Past Events
                <?php if($isPast): ?>
                <span class="bg-accent/10 text-accent py-0.5 px-2.5 rounded-full text-xs ml-2"><?php echo e($events->count()); ?></span>
                <?php endif; ?>
            </a>
            <a class="<?php echo e($isMyEvents ? 'border-accent text-accent font-bold' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 font-medium'); ?> whitespace-nowrap py-4 px-1 border-b-2 text-sm flex items-center gap-2" 
               href="<?php echo e(route('dashboard.events', ['filter' => 'my_events'])); ?>">
                <span class="material-icons text-lg">collections_bookmark</span>
                My Events
                <?php if($isMyEvents): ?>
                <span class="bg-accent/10 text-accent py-0.5 px-2.5 rounded-full text-xs ml-2"><?php echo e($events->count()); ?></span>
                <?php endif; ?>
            </a>
        </nav>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $earliestSlot = null;
                $allSlots = collect();
                
                foreach($event->categories as $cat) {
                     foreach($cat->slots as $slot) {
                         $allSlots->push($slot);
                         if ($slot->TanggalMulai && (!$earliestSlot || $slot->TanggalMulai < $earliestSlot->TanggalMulai)) {
                             $earliestSlot = $slot;
                         }
                     }
                }
                $date = $earliestSlot ? $earliestSlot->TanggalMulai : null;
                $location = $earliestSlot ? $earliestSlot->LokasiEvent : 'Location TBA';
                $quota = $allSlots->sum('KuotaTotal');
                
                // Format: 5K • 10K
                $distances = $event->categories->pluck('Jarak')->unique()->implode(' • ');
                 if(!$distances) $distances = "Multi-Category";
            ?>
            
            <div class="group bg-white dark:bg-card-dark rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-xl hover:border-primary/50 dark:hover:border-primary/50 transition-all duration-300">
                <div class="relative h-48 overflow-hidden">
                     <img alt="<?php echo e($event->NamaEvent); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="<?php echo e($event->GambarEvent ?? 'https://placehold.co/600x400?text=No+Image'); ?>"/>
                     <div class="absolute top-4 left-4 flex gap-2">
                          <span class="bg-primary/90 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide"><?php echo e($event->categories->first()->NamaKategori ?? 'Event'); ?></span>
                     </div>
                     <?php if($date && $date->diffInDays(now()) < 30 && $date->isFuture()): ?>
                         <div class="absolute bottom-4 right-4 bg-black/60 backdrop-blur-md text-white px-3 py-1.5 rounded-lg border border-white/10 flex items-center gap-2">
                              <span class="material-icons text-yellow-400 text-sm">timer</span>
                              <span class="text-xs font-mono font-bold"><?php echo e($date->diffInDays(now())); ?> DAYS LEFT</span>
                         </div>
                     <?php endif; ?>
                </div>
                
                <div class="p-6">
                     <div class="flex justify-between items-start mb-4">
                          <div>
                               <h3 class="text-xl font-display font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors line-clamp-1" title="<?php echo e($event->NamaEvent); ?>"><?php echo e($event->NamaEvent); ?></h3>
                               <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm mt-1">
                                    <span class="material-icons text-sm mr-1">location_on</span>
                                    <span class="line-clamp-1"><?php echo e($location); ?></span>
                               </div>
                          </div>
                          <div class="text-center bg-gray-100 dark:bg-gray-800 rounded-lg p-2 min-w-[60px]">
                               <div class="text-xs text-gray-500 uppercase font-bold"><?php echo e($date ? $date->format('M') : 'TBA'); ?></div>
                               <div class="text-xl font-bold text-gray-900 dark:text-white"><?php echo e($date ? $date->format('d') : '--'); ?></div>
                          </div>
                     </div>
                     
                     <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2" title="<?php echo e($event->DeskripsiEvent); ?>">
                         <?php echo e($event->DeskripsiEvent); ?>

                     </p>
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex flex-col gap-1 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center gap-2">
                                <span class="material-icons text-base">calendar_today</span>
                                <span><?php echo e($date ? $date->format('d M Y, H:i') : 'TBA'); ?></span>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-gray-400">
                                <span class="material-icons text-sm">straighten</span>
                                <span><?php echo e($distances); ?></span>
                                <span class="mx-1 text-gray-600">|</span>
                                <span class="text-primary font-bold"><?php echo e(number_format($quota)); ?> Seats</span>
                            </div>
                        </div>
                        
                        <?php if($event->userRegistration && ($event->userRegistration->StatusPendaftaran == 'Pendaftaran Ditolak' || ($event->userRegistration->payment && $event->userRegistration->payment->StatusPembayaran == 'Ditolak'))): ?>
                            <button @click="openRegistrationModal(<?php echo \Illuminate\Support\Js::from($event)->toHtml() ?>)" 
                                class="px-4 py-2 rounded-lg text-sm font-bold text-white transition-all transform hover:-translate-y-0.5 shadow-lg shadow-red-500/20 bg-red-500 hover:bg-red-600">
                                Fix Registration
                            </button>
                        <?php elseif($event->userRegistration && in_array($event->userRegistration->StatusPendaftaran, ['Terverifikasi', 'Selesai'])): ?>
                            <button @click="openRegistrationModal(<?php echo \Illuminate\Support\Js::from($event)->toHtml() ?>)" 
                                class="px-4 py-2 rounded-lg text-sm font-bold text-white transition-all transform hover:-translate-y-0.5 shadow-lg shadow-green-500/20 bg-green-600 hover:bg-green-700">
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">confirmation_number</span> Ticket Confirmed</span>
                            </button>
                        <?php elseif($event->userRegistration): ?>
                            <button @click="openRegistrationModal(<?php echo \Illuminate\Support\Js::from($event)->toHtml() ?>)" 
                                class="px-4 py-2 rounded-lg text-sm font-bold text-white transition-all transform hover:-translate-y-0.5 shadow-lg shadow-yellow-500/20 bg-yellow-500 hover:bg-yellow-600">
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">hourglass_top</span> Check Status</span>
                            </button>
                        <?php elseif($event->StatusEvent == 'Buka'): ?>
                            <button @click="openRegistrationModal(<?php echo \Illuminate\Support\Js::from($event)->toHtml() ?>)" 
                                class="px-4 py-2 rounded-lg text-sm font-bold text-white transition-all transform hover:-translate-y-0.5 shadow-lg shadow-blue-500/20 bg-primary hover:bg-blue-600">
                                Register Now
                            </button>
                        <?php else: ?>
                            <button disabled class="px-4 py-2 rounded-lg text-sm font-bold text-gray-400 bg-gray-200 dark:bg-gray-700 cursor-not-allowed">
                                Event Closed
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Registration Modal -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="showModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl w-full border border-gray-700">
                
                <template x-if="activeEvent">
                    <div>
                         <!-- Modal Header with Image -->
                         <div class="relative h-64 sm:h-80">
                             <img :src="activeEvent.GambarEvent || 'https://placehold.co/800x400'" class="w-full h-full object-cover" alt="Event Banner">
                             <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
                             <button @click="showModal = false" class="absolute top-4 right-4 bg-black/30 hover:bg-black/50 text-white rounded-full p-2 backdrop-blur-md transition-colors">
                                 <span class="material-icons">close</span>
                             </button>
                             <div class="absolute bottom-6 left-6 right-6 text-white">
                                 <div class="flex gap-2 mb-3">
                                     <span class="bg-accent px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Open Registration</span>
                                 </div>
                                 <h2 class="text-3xl sm:text-4xl font-display font-bold mb-2" x-text="activeEvent.NamaEvent"></h2>
                                 <div class="flex items-center gap-4 text-sm sm:text-base text-gray-200">
                                     <span class="flex items-center gap-1"><span class="material-icons text-sm text-primary">location_on</span> <span x-text="activeEvent.categories?.[0]?.slots?.[0]?.LokasiEvent || 'Location TBA'"></span></span>
                                     <span class="flex items-center gap-1"><span class="material-icons text-sm text-primary">calendar_today</span> <span x-text="formatDate(activeEvent.categories?.[0]?.slots?.[0]?.TanggalMulai)"></span></span>
                                 </div>
                             </div>
                         </div>

                         <div class="grid grid-cols-1 lg:grid-cols-3">
                             <!-- Details Sidebar -->
                             <div class="lg:col-span-1 bg-gray-50 dark:bg-gray-900/50 p-6 space-y-6 border-r border-gray-200 dark:border-gray-700">
                                 <div>
                                     <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                         <span class="material-icons text-primary">map</span> Route & Location
                                     </h3>
                                     <div class="space-y-3">
                                         <!-- Trail Image Mockup -->
                                         <div class="rounded-lg overflow-hidden relative group cursor-pointer h-32">
                                             <img src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&q=80&w=400" class="w-full h-full object-cover" alt="Trail Map">
                                             <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                 <span class="text-white text-xs font-bold">View Trail Map</span>
                                             </div>
                                         </div>
                                         <div class="grid grid-cols-2 gap-2">
                                             <div class="rounded-lg overflow-hidden h-20">
                                                  <img src="https://images.unsplash.com/photo-1552674605-46f538316d43?auto=format&fit=crop&q=80&w=200" class="w-full h-full object-cover" alt="Start Line">
                                             </div>
                                             <div class="rounded-lg overflow-hidden h-20">
                                                  <img src="https://images.unsplash.com/photo-1533561052604-c3beb6d55760?auto=format&fit=crop&q=80&w=200" class="w-full h-full object-cover" alt="Finish Line">
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                                 <div>
                                     <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                         <span class="material-icons text-primary">info</span> Event Info
                                     </h3>
                                     <div class="space-y-3 text-sm">
                                         <div class="flex justify-between">
                                             <span class="text-gray-500">Total Participants</span>
                                             <span class="font-bold text-gray-900 dark:text-gray-200">2,500+</span>
                                         </div>
                                         <div class="flex justify-between">
                                             <span class="text-gray-500">Surface</span>
                                             <span class="font-bold text-gray-900 dark:text-gray-200">Road / Asphalt</span>
                                         </div>
                                          <div class="flex justify-between">
                                             <span class="text-gray-500">Weather Est.</span>
                                             <span class="font-bold text-gray-900 dark:text-gray-200">24°C Cloudy</span>
                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <!-- Registration Form -->
                             <div class="lg:col-span-2 p-6 sm:p-8">
                                 <div class="mb-8">
                                     <h3 class="font-bold text-xl text-gray-900 dark:text-white mb-2">About Event</h3>
                                     <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed" x-text="activeEvent.DeskripsiEvent"></p>
                                 </div>

                                         <div x-show="!activeEvent.userRegistration || activeEvent.userRegistration.StatusPendaftaran == 'Pendaftaran Ditolak' || (activeEvent.userRegistration.payment && activeEvent.userRegistration.payment.StatusPembayaran == 'Ditolak')">
                                             
                                             <!-- Rejection Message -->
                                             <div x-show="activeEvent.userRegistration && (activeEvent.userRegistration.StatusPendaftaran == 'Pendaftaran Ditolak' || (activeEvent.userRegistration.payment && activeEvent.userRegistration.payment.StatusPembayaran == 'Ditolak'))" class="mb-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                                                <div class="flex items-center gap-3 text-red-700 dark:text-red-400">
                                                    <span class="material-icons">error_outline</span>
                                                    <div class="font-bold">Registration Rejected</div>
                                                </div>
                                                <p class="text-xs text-red-600 dark:text-red-300 mt-1 pl-9">
                                                    Your payment proof was rejected. Please upload a valid receipt to continue.
                                                </p>
                                             </div>

                                             <form action="<?php echo e(route('dashboard.events')); ?>" method="POST" enctype="multipart/form-data">
                                                 <?php echo csrf_field(); ?>
                                                 <!-- Hidden inputs for re-submission logic if needed, or just standard form -->
                                                 <div class="space-y-6">
                                                     <div>
                                                         <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3 uppercase tracking-wider">Select Category</label>
                                                         <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                             <template x-for="cat in activeEvent.categories" :key="cat.KategoriID">
                                                                 <label class="relative block cursor-pointer group">
                                                                     <input type="radio" name="category_id" :value="cat.KategoriID" class="peer sr-only" required :checked="activeEvent.userRegistration && activeEvent.userRegistration.KategoriID == cat.KategoriID">
                                                                     <div class="p-4 rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-blue-400 dark:hover:border-blue-500 peer-checked:border-primary peer-checked:bg-blue-50/50 dark:peer-checked:bg-blue-900/20 transition-all h-full">
                                                                         <div class="flex justify-between items-start mb-2">
                                                                             <span class="text-2xl font-black text-gray-800 dark:text-white" x-text="cat.NamaKategori"></span>
                                                                             <span class="material-icons text-primary opacity-0 peer-checked:opacity-100 transition-opacity">check_circle</span>
                                                                         </div>
                                                                         <div class="text-lg font-bold text-primary" x-text="'Rp ' + (cat.Harga ? Number(cat.Harga).toLocaleString('id-ID') : 'Free')"></div>
                                                                         <div class="text-xs text-gray-500 mt-2" x-text="(cat.Jarak || '5') + 'km • Road • Chip Timing'"></div>
                                                                     </div>
                                                                 </label>
                                                             </template>
                                                         </div>
                                                     </div>
                 
                                                     <div>
                                                         <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3 uppercase tracking-wider">Payment & Confirmation</label>
                                                         
                                                         <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 mb-4 border border-blue-100 dark:border-blue-800">
                                                            <div class="flex flex-col sm:flex-row gap-4 items-center">
                                                                <div class="bg-white p-2 rounded-lg shrink-0">
                                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=SeaBank-1234567890" alt="QR Payment" class="w-20 h-20">
                                                                </div>
                                                                <div class="text-sm text-center sm:text-left">
                                                                    <p class="font-bold text-gray-900 dark:text-white mb-1">Transfer to SeaBank</p>
                                                                    <p class="font-mono text-lg text-primary font-bold tracking-wider select-all">9012 3456 7890</p>
                                                                    <p class="text-gray-500 text-xs mt-1">Ref: EVENT-<span x-text="activeEvent.EventID"></span></p>
                                                                </div>
                                                            </div>
                                                         </div>
                 
                                                         <label class="block text-xs font-medium text-gray-500 mb-2">Upload Payment Proof <span class="text-red-500">*</span></label>
                                                         <div class="relative rounded-xl border-3 border-dashed border-gray-300 dark:border-gray-600 p-8 flex flex-col items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors cursor-pointer group hover:border-primary" :class="{'border-primary bg-blue-50/50 dark:bg-blue-900/20': hasFile}">
                                                             <span class="material-icons text-gray-400 text-5xl mb-3 group-hover:text-primary transition-colors transform group-hover:scale-110 duration-300" :class="{'text-primary': hasFile}">cloud_upload</span>
                                                             <span class="text-base font-bold text-gray-900 dark:text-white" x-text="fileName || 'Drop your receipt here'"></span>
                                                             <span class="text-sm text-gray-500 dark:text-gray-400 mt-1" x-show="!hasFile">or click to browse files</span>
                                                             <div class="mt-2 text-xs text-center text-gray-400" x-show="!hasFile">
                                                                 Supported: JPG, PNG, PDF (Max 2MB)
                                                             </div>
                                                             <input type="file" name="payment_proof" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" @change="handleFileSelect($event)" required>
                                                         </div>
                                                     </div>
                 
                                                     <div class="pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                                                         <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Cancel</button>
                                                         <button type="submit" 
                                                            :disabled="!hasFile"
                                                            class="px-8 py-2.5 rounded-lg text-sm font-bold text-white transition-all transform"
                                                            :class="hasFile ? 'bg-primary hover:bg-blue-600 shadow-lg shadow-blue-500/30 hover:-translate-y-0.5' : 'bg-gray-300 dark:bg-gray-700 cursor-not-allowed opacity-70'">
                                                             Confirm Registration
                                                         </button>
                                                     </div>
                                                 </div>
                                             </form>
                                         </div>

                                         <!-- STATUS: PENDING / ACCEPTED -->
                                         <div x-show="activeEvent.userRegistration && activeEvent.userRegistration.StatusPendaftaran != 'Pendaftaran Ditolak' && (!activeEvent.userRegistration.payment || activeEvent.userRegistration.payment.StatusPembayaran != 'Ditolak')" class="space-y-6">
                                            
                                            <!-- Accepted State -->
                                            <div x-show="['Terverifikasi', 'Selesai'].includes(activeEvent.userRegistration.StatusPendaftaran)" class="bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-2xl p-6 text-center">
                                                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 dark:bg-green-800 rounded-full mb-4">
                                                    <span class="material-icons text-3xl text-green-600 dark:text-green-300">check_circle</span>
                                                </div>
                                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Registration Confirmed!</h3>
                                                <p class="text-gray-500 dark:text-gray-400 mb-6 font-medium">See you at the starting line!</p>
                                                
                                                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm inline-block min-w-[200px] border border-gray-100 dark:border-gray-700">
                                                    <div class="text-xs text-gray-500 uppercase tracking-widest mb-1">BIB Number</div>
                                                    <div class="text-4xl font-black text-primary font-mono tracking-wider" x-text="activeEvent.userRegistration.NomorBIB"></div>
                                                </div>
                                            </div>

                                            <!-- Pending/Payment Check State -->
                                            <div x-show="!['Terverifikasi', 'Selesai'].includes(activeEvent.userRegistration.StatusPendaftaran)" class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-100 dark:border-yellow-800 rounded-2xl p-6">
                                                <div class="flex items-center gap-4 mb-6">
                                                    <div class="p-3 bg-yellow-100 dark:bg-yellow-800/50 rounded-full shrink-0">
                                                        <span class="material-icons text-yellow-600 dark:text-yellow-400">hourglass_top</span>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-bold text-gray-900 dark:text-white text-lg">Payment Under Review</h4>
                                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">We are verifying your payment proof. This process usually takes 24 hours.</p>
                                                    </div>
                                                </div>

                                                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-100 dark:border-gray-700">
                                                    <div class="text-xs font-bold text-gray-500 mb-3 uppercase tracking-wider">Submitted Proof</div>
                                                    <div class="relative aspect-video rounded-lg overflow-hidden bg-gray-100">
                                                        <template x-if="activeEvent.userRegistration.payment && activeEvent.userRegistration.payment.BuktiPembayaran">
                                                            <img :src="'/' + activeEvent.userRegistration.payment.BuktiPembayaran" class="w-full h-full object-cover">
                                                        </template>
                                                        <template x-if="!activeEvent.userRegistration.payment || !activeEvent.userRegistration.payment.BuktiPembayaran">
                                                            <div class="flex items-center justify-center h-full text-gray-400">No Image Available</div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end">
                                                <button @click="showModal = false" class="px-6 py-2.5 rounded-lg text-sm font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 transition-colors">Close</button>
                                            </div>
                                         </div>
                             </div>
                         </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('eventModal', () => ({
            showModal: false,
            activeEvent: null,
            hasFile: false,
            fileName: null,
            
            init() {
                // Pre-load if needed
            },

            checkAutoOpen(event) {
                if (event) {
                    this.openRegistrationModal(event);
                }
            },

            openRegistrationModal(event) {
                this.activeEvent = event;
                this.showModal = true;
                this.hasFile = false; // Reset state
                this.fileName = null;
            },
            
            handleFileSelect(event) {
                const file = event.target.files[0];
                if (file) {
                    this.hasFile = true;
                    this.fileName = file.name;
                } else {
                    this.hasFile = false;
                    this.fileName = null;
                }
            },

            formatDate(dateString) {
                if(!dateString) return 'Date TBA';
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                return new Date(dateString).toLocaleDateString('en-US', options);
            }
        }))
    })
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Kuliah\Semester 3\Rekayasa Perangkat Lunak\TUBES-PP-BDL-RPL\Running_Event_Management\resources\views/dashboard/events/index.blade.php ENDPATH**/ ?>