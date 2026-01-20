@extends('layouts.admin')

@section('title', 'Event Configuration | Pelari Kalcer')

@section('content')
<main class="flex-1 flex flex-col overflow-hidden bg-[#0d1117]">
    <header class="h-24 border-b border-border-dark flex items-center justify-between px-10 bg-background-dark/80 backdrop-blur-xl z-10 shrink-0">
        <div class="flex items-center gap-6">
            <div>
                <h2 class="text-2xl font-display font-bold text-white tracking-tight">Admin Event Configuration Setup</h2>
                <div class="flex items-center gap-3 mt-1">
                    <span class="text-[10px] font-mono text-slate-500 uppercase tracking-widest bg-surface-dark px-2 py-0.5 rounded border border-border-dark">Table: ms_event</span>
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                        <span class="text-[10px] font-bold text-primary tracking-widest">LIVE SYSTEM</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <form method="GET" action="{{ route('admin.events') }}" class="flex items-center gap-3">
                <!-- Sort -->
                <select name="sort" onchange="this.form.submit()" class="bg-surface-dark border border-border-dark rounded-xl px-3 py-2.5 text-xs font-bold text-slate-400 focus:text-white outline-none cursor-pointer appearance-none text-center min-w-[120px]">
                    <option value="created_desc" {{ request('sort') == 'created_desc' ? 'selected' : '' }}>Newest First</option>
                    <option value="created_asc" {{ request('sort') == 'created_asc' ? 'selected' : '' }}>Oldest First</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                    <option value="revenue_desc" {{ request('sort') == 'revenue_desc' ? 'selected' : '' }}>Revenue (High)</option>
                    <option value="capacity_desc" {{ request('sort') == 'capacity_desc' ? 'selected' : '' }}>Capacity (High)</option>
                </select>

                <!-- Filter: Category Dropdown -->
                <div class="relative group">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-500 text-lg z-10">filter_alt</span>
                    <select name="category" onchange="this.form.submit()" class="bg-surface-dark border border-border-dark rounded-xl pl-10 pr-8 py-2.5 text-xs font-bold focus:ring-1 focus:ring-primary focus:border-primary w-40 transition-all text-white outline-none cursor-pointer appearance-none">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    <!-- Custom Arrow -->
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-500 text-sm pointer-events-none">expand_more</span>
                </div>

                <!-- Search -->
                <div class="relative group">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-500 text-lg group-focus-within:text-primary transition-colors">search</span>
                    <input name="search" value="{{ request('search') }}" class="bg-surface-dark border border-border-dark rounded-xl pl-12 pr-6 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:border-primary w-64 transition-all text-white placeholder:text-slate-600" placeholder="Query event master data..." type="text"/>
                </div>
            </form>

            <form action="{{ route('admin.events.commit') }}" method="POST">
                @csrf
                <button type="submit" class="px-6 py-2.5 bg-primary text-background-dark rounded-xl text-sm font-extrabold hover:brightness-110 transition-all flex items-center gap-2 shadow-[0_0_20px_rgba(0,255,128,0.2)]">
                    <span class="material-symbols-outlined text-xl">save</span>
                    COMMIT CHANGES
                </button>
            </form>
        </div>
    </header>
    <div class="flex-1 overflow-y-auto custom-scrollbar p-10 space-y-10" x-data="{ showCreateModal: false, showSecondCategory: false }">
        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/20 text-green-500 p-4 rounded-xl font-bold uppercase text-xs tracking-widest text-center mb-6">
                {{ session('success') }}
            </div>
        @endif

        <section>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <span class="w-1 h-6 bg-primary rounded-full"></span>
                    <h3 class="text-white font-display font-bold uppercase tracking-[0.15em] text-sm">Active Event Templates</h3>
                </div>
                <button class="text-[10px] font-bold text-slate-500 hover:text-primary uppercase tracking-widest transition-colors flex items-center gap-1">
                    View All Master Records <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                 @foreach($events as $event)
                <a href="{{ route('admin.events.show', $event->EventID) }}" class="glass-panel p-6 rounded-2xl border-t-2 border-t-primary group hover:bg-surface-dark/80 transition-all bg-surface-dark/40 border border-border-dark block">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary border border-primary/20">
                            <span class="material-symbols-outlined text-2xl">sprint</span>
                        </div>
                        <span class="text-[10px] font-black bg-primary text-background-dark px-2.5 py-1 rounded-full uppercase tracking-tighter">{{ $event->StatusEvent ?? 'Unknown' }}</span>
                    </div>
                    <h4 class="text-white font-bold text-xl leading-tight mb-2">{{ $event->NamaEvent }}</h4>
                    <p class="text-slate-500 text-xs mb-6 font-medium">{{ Str::limit($event->DeskripsiEvent ?? 'No Description', 80) }}</p>
                    <div class="space-y-3">
                        <div class="flex justify-between text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            <span>REGISTRATION ({{ $event->registered }}/{{ $event->totalQuota }})</span>
                            <span class="{{ $event->percentage >= 100 ? 'text-red-500' : 'text-primary' }}">{{ $event->percentage }}% Capacity</span>
                        </div>
                        <div class="w-full bg-border-dark/50 h-1.5 rounded-full overflow-hidden">
                            <div class="{{ $event->percentage >= 100 ? 'bg-red-500' : 'bg-primary' }} h-full shadow-[0_0_10px_rgba(0,255,128,0.5)]" style="width: {{ $event->percentage }}%"></div>
                        </div>
                    </div>
                </a>
                @endforeach
                
                <div @click="showCreateModal = true" class="glass-panel p-6 rounded-2xl border-2 border-dashed border-border-dark hover:border-primary/50 bg-transparent flex flex-col items-center justify-center text-center group cursor-pointer transition-all">
                    <div class="w-14 h-14 rounded-full border border-border-dark flex items-center justify-center mb-4 group-hover:bg-primary/10 group-hover:border-primary transition-all">
                        <span class="material-symbols-outlined text-slate-500 group-hover:text-primary text-3xl">add_circle</span>
                    </div>
                    <p class="text-sm font-bold text-slate-400 group-hover:text-white transition-colors">Initialize New Config</p>
                    <p class="text-[10px] font-mono text-slate-600 mt-2 tracking-widest uppercase">ms_template_v2.sys</p>
                </div>
            </div>
        </section>
        
        <!-- Additional configuration sections omitted for brevity in this migration step, can be added as needed -->
         <div class="bg-primary p-8 rounded-2xl text-background-dark shadow-[0_0_40px_rgba(0,255,128,0.15)] relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-10 group-hover:rotate-12 transition-transform duration-500">
                <span class="material-symbols-outlined text-9xl">verified_user</span>
            </div>
            <h3 class="font-display font-black text-2xl mb-5 leading-none uppercase tracking-tighter italic">VALIDATION READY</h3>
            <ul class="space-y-4 mb-8">
                <li class="flex items-center gap-3 text-xs font-extrabold border-b border-background-dark/10 pb-3">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    <span>MS_EVENT METADATA VERIFIED</span>
                </li>
                <li class="flex items-center gap-3 text-xs font-extrabold border-b border-background-dark/10 pb-3">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    <span>PRICING LOGIC SYNCHRONIZED</span>
                </li>
            </ul>
            <div class="flex items-center gap-4 bg-background-dark/5 p-4 rounded-xl border border-background-dark/10">
                <div class="size-12 rounded-full border-4 border-background-dark/20 flex items-center justify-center font-display font-black text-sm">
                    92%
                </div>
                <p class="text-[10px] leading-relaxed font-bold uppercase tracking-tight">System configuration health is optimal for public deployment.</p>
            </div>
        </div>
        <!-- Create Modal -->
        <div x-show="showCreateModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            
            <div class="bg-[#161b22] border border-border-dark w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden" @click.away="showCreateModal = false">
                <div class="px-6 py-4 border-b border-border-dark flex justify-between items-center bg-surface-dark/50">
                    <h3 class="text-white font-display font-bold text-lg">Initialize New Config</h3>
                    <button @click="showCreateModal = false" class="text-slate-400 hover:text-white transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Event Name</label>
                            <input type="text" name="NamaEvent" required class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-slate-600 outline-none transition-all" placeholder="e.g. Jakarta Marathon 2026">
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Description</label>
                            <textarea name="DeskripsiEvent" rows="3" class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-slate-600 outline-none transition-all resize-none" placeholder="Event details, location info, and general description..."></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Location / Terrain</label>
                                <input type="text" name="Location" required class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-slate-600 outline-none transition-all" placeholder="e.g. Monas (Road)">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Start Date & Time</label>
                                <input type="datetime-local" name="StartDate" required class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all" style="color-scheme: dark;">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Primary Category</label>
                                <input type="text" name="CategoryName" required class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-slate-600 outline-none transition-all" placeholder="e.g. 5K Open">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Distance</label>
                                <select name="Distance" class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all appearance-none">
                                    <option value="5K">5K</option>
                                    <option value="10K">10K</option>
                                    <option value="21K">21K (Half)</option>
                                    <option value="42K">42K (Full)</option>
                                </select>
                            </div>
                        </div>

                         <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Fee (IDR)</label>
                                <input type="number" name="Price" required class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-slate-600 outline-none transition-all" placeholder="150000">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Max Participants</label>
                                <input type="number" name="Quota" required class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-slate-600 outline-none transition-all" placeholder="500">
                            </div>
                        </div>

                        <!-- Secondary Category Option -->
                        <div class="border-t border-border-dark pt-4">
                            <label class="inline-flex items-center cursor-pointer mb-4">
                                <input type="checkbox" class="form-checkbox bg-[#0d1117] border-border-dark text-primary rounded focus:ring-0 focus:ring-offset-0" x-model="showSecondCategory">
                                <span class="ml-2 text-xs font-bold text-slate-400 uppercase tracking-widest">Add Secondary Category (Optional)</span>
                            </label>

                            <div x-show="showSecondCategory" x-transition class="space-y-4 bg-[#0d1117]/50 p-4 rounded-xl border border-dashed border-border-dark">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Category Name</label>
                                        <input type="text" name="CategoryName2" class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-slate-600 outline-none transition-all" placeholder="e.g. 10K Race">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Distance</label>
                                        <input type="text" name="Distance2" class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-slate-600 outline-none transition-all" placeholder="e.g. 10K">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Fee (IDR)</label>
                                        <input type="number" name="Price2" class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-slate-600 outline-none transition-all" placeholder="200000">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Max Participants</label>
                                        <input type="number" name="Quota2" class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-slate-600 outline-none transition-all" placeholder="300">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Status</label>
                                <select name="StatusEvent" class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-3 text-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all appearance-none">
                                    <option value="Buka">Open (Buka)</option>
                                    <option value="Tutup">Closed (Tutup)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Event Banner</label>
                                <input type="file" name="GambarEvent" accept="image/*" class="w-full bg-[#0d1117] border border-border-dark rounded-xl px-4 py-2.5 text-sm text-slate-400 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-border-dark flex justify-end gap-3">
                        <button type="button" @click="showCreateModal = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-400 hover:text-white hover:bg-surface-dark transition-all">Cancel</button>
                        <button type="submit" class="px-6 py-2.5 bg-primary text-background-dark rounded-xl text-sm font-extrabold hover:brightness-110 transition-all shadow-[0_0_15px_rgba(0,255,128,0.2)]">
                            Initialize Config
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
