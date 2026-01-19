@extends('layouts.dashboard')

@section('title', 'Leaderboards')
@section('header_title', 'Leaderboards')

@section('content')
<div class="max-w-7xl mx-auto space-y-8 relative">
    <div class="relative">
        <div class="text-center mb-8">
            <span class="inline-block py-1 px-3 rounded-full bg-accent/10 text-accent text-xs font-bold uppercase tracking-wider mb-2">Top Performers</span>
            <h3 class="text-3xl font-display font-bold text-gray-800 dark:text-gray-100">This Month's Champions</h3>
        </div>

        <div class="flex flex-col md:flex-row items-end justify-center gap-6 md:gap-8 pb-4">
            
                @if($topRunners->count() >= 2)
                @php 
                    $runner2 = $topRunners->get(1); 
                    $citySlug2 = \Illuminate\Support\Str::slug($runner2->Kota);
                    $cityIcons = [
                        'jakarta' => 'monas.png', 
                        'bandung' => 'gedung_sate.png', 
                        'surabaya' => 'sura_baya.png', 
                        'bali' => 'pura_bali.png'
                    ];
                    $iconFile2 = $cityIcons[$citySlug2] ?? null;
                @endphp
                <div class="order-2 md:order-1 w-full md:w-72 bg-white dark:bg-gray-800 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] dark:shadow-none border border-gray-100 dark:border-gray-700 relative flex flex-col items-center p-6 pb-8 transform hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="absolute -top-5">
                        <div class="w-10 h-10 rounded-full bg-slate-200 border-4 border-white dark:border-gray-800 flex items-center justify-center font-display font-bold text-slate-600 shadow-md text-xl">2</div>
                    </div>
                    <div class="w-20 h-20 rounded-full p-1 bg-gradient-to-tr from-slate-300 to-slate-100 mb-3 mt-4 group-hover:scale-105 transition-transform">
                        <img alt="Runner" class="w-full h-full rounded-full object-cover border-2 border-white dark:border-gray-800" src="{{ $runner2->Gambar ?? 'https://ui-avatars.com/api/?name='.urlencode($runner2->NamaLengkap).'&background=random' }}"/>
                    </div>
                    <div class="text-center w-full">
                        <div class="font-bold text-lg text-gray-900 dark:text-white truncate">{{ $runner2->NamaLengkap }}</div>
                        <div class="text-xs text-gray-500 mb-4 flex items-center justify-center gap-1.5">
                            @if($iconFile2)
                                <img src="{{ asset('assets/cities/'.$iconFile2) }}" class="w-5 h-5 object-contain" alt="{{ $runner2->Kota }}" title="{{ $runner2->Kota }}">
                            @else
                                <span class="material-icons text-[14px] text-blue-500">place</span> 
                            @endif
                            {{ $runner2->Kota ?? 'Independent' }}
                        </div>
                        <div class="w-full h-px bg-gray-100 dark:bg-gray-700 mb-4"></div>
                        <div class="flex justify-between items-center px-4">
                            <div class="text-xs text-gray-400 uppercase">{{ $isSpeedRank ? 'Time' : 'Distance' }}</div>
                            <div class="text-2xl font-display font-bold text-gray-700 dark:text-gray-200">
                                @if($isSpeedRank)
                                    {{ $runner2->WaktuFinish }}
                                @else
                                    {{ number_format($runner2->TotalDist, 0) }} <span class="text-xs font-sans font-medium text-gray-400">KM</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Rank 1 (Center) --}}
            @if($topRunners->count() >= 1)
                @php 
                    $runner1 = $topRunners->get(0); 
                    $citySlug1 = \Illuminate\Support\Str::slug($runner1->Kota);
                    // array defined above or re-define if strictly needed per scope, but let's redefine to be safe in blade loop scope
                        $cityIcons = [
                        'jakarta' => 'monas.png', 
                        'bandung' => 'gedung_sate.png', 
                        'surabaya' => 'sura_baya.png', 
                        'bali' => 'pura_bali.png'
                    ];
                    $iconFile1 = $cityIcons[$citySlug1] ?? null;
                @endphp
                <div class="order-1 md:order-2 w-full md:w-80 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-2xl shadow-[0_20px_40px_rgba(0,0,0,0.1)] border-4 border-yellow-400/50 relative flex flex-col items-center p-6 pb-10 z-10 transform scale-105 hover:-translate-y-3 transition-transform duration-300">
                    <div class="absolute -top-8">
                        <span class="material-icons text-6xl text-yellow-400 drop-shadow-lg">emoji_events</span>
                    </div>
                    <div class="w-28 h-28 rounded-full p-1.5 bg-gradient-to-tr from-yellow-400 via-yellow-200 to-yellow-500 mb-3 mt-8 shadow-lg">
                        <img alt="Runner" class="w-full h-full rounded-full object-cover border-4 border-white dark:border-gray-800" src="{{ $runner1->Gambar ?? 'https://ui-avatars.com/api/?name='.urlencode($runner1->NamaLengkap).'&background=random' }}"/>
                    </div>
                    <div class="text-center w-full">
                        <div class="font-bold text-2xl mb-1 text-gray-900 dark:text-white">{{ $runner1->NamaLengkap }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 font-bold mb-4 flex items-center justify-center gap-1.5 uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 bg-yellow-400 rounded-full animate-pulse"></span>
                            @if($iconFile1)
                                <img src="{{ asset('assets/cities/'.$iconFile1) }}" class="w-5 h-5 object-contain" alt="{{ $runner1->Kota }}" title="{{ $runner1->Kota }}">
                            @endif
                            {{ $runner1->Kota ?? 'Independent' }}
                        </div>
                        <div class="w-full h-px bg-gray-100 dark:bg-gray-700 mb-4"></div>
                        <div class="flex justify-between items-end px-2">
                            <div class="text-xs text-gray-400 uppercase mb-1">{{ $isSpeedRank ? 'Finish Time' : 'Total Distance' }}</div>
                            <div class="text-4xl font-display font-bold text-gray-800 dark:text-white">
                                @if($isSpeedRank)
                                    {{ $runner1->WaktuFinish }}
                                @else
                                    {{ number_format($runner1->TotalDist, 0) }} <span class="text-sm font-sans font-medium text-gray-400">KM</span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4 inline-block bg-yellow-100 dark:bg-yellow-900/30 border border-yellow-400/50 text-yellow-700 dark:text-yellow-400 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                            Leader
                        </div>
                    </div>
                </div>
            @endif

            {{-- Rank 3 (Right) --}}
            @if($topRunners->count() >= 3)
                @php 
                    $runner3 = $topRunners->get(2); 
                    $citySlug3 = \Illuminate\Support\Str::slug($runner3->Kota);
                    $iconFile3 = $cityIcons[$citySlug3] ?? null;
                @endphp
                <div class="order-3 md:order-3 w-full md:w-72 bg-white dark:bg-gray-800 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] dark:shadow-none border border-gray-100 dark:border-gray-700 relative flex flex-col items-center p-6 pb-8 transform hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="absolute -top-5">
                        <div class="w-10 h-10 rounded-full bg-orange-200 border-4 border-white dark:border-gray-800 flex items-center justify-center font-display font-bold text-orange-700 shadow-md text-xl">3</div>
                    </div>
                    <div class="w-20 h-20 rounded-full p-1 bg-gradient-to-tr from-orange-300 to-orange-100 mb-3 mt-4 group-hover:scale-105 transition-transform">
                        <img alt="Runner" class="w-full h-full rounded-full object-cover border-2 border-white dark:border-gray-800" src="{{ $runner3->Gambar ?? 'https://ui-avatars.com/api/?name='.urlencode($runner3->NamaLengkap).'&background=random' }}"/>
                    </div>
                    <div class="text-center w-full">
                        <div class="font-bold text-lg text-gray-900 dark:text-white truncate">{{ $runner3->NamaLengkap }}</div>
                        <div class="text-xs text-gray-500 mb-4 flex items-center justify-center gap-1.5">
                            @if($iconFile3)
                                <img src="{{ asset('assets/cities/'.$iconFile3) }}" class="w-5 h-5 object-contain" alt="{{ $runner3->Kota }}" title="{{ $runner3->Kota }}">
                            @else
                                <span class="material-icons text-[14px] text-orange-500">place</span> 
                            @endif
                            {{ $runner3->Kota ?? 'Independent' }}
                        </div>
                        <div class="w-full h-px bg-gray-100 dark:bg-gray-700 mb-4"></div>
                        <div class="flex justify-between items-center px-4">
                            <div class="text-xs text-gray-400 uppercase">{{ $isSpeedRank ? 'Time' : 'Distance' }}</div>
                            <div class="text-2xl font-display font-bold text-gray-700 dark:text-gray-200">
                                @if($isSpeedRank)
                                    {{ $runner3->WaktuFinish }}
                                @else
                                    {{ number_format($runner3->TotalDist, 0) }} <span class="text-xs font-sans font-medium text-gray-400">KM</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 flex flex-col xl:flex-row gap-4 justify-between items-center sticky top-0 z-20">
        <div class="flex flex-wrap items-center gap-3 w-full xl:w-auto">
            <div class="flex items-center gap-2 text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide mr-2">
                <span class="material-icons text-lg">filter_list</span> Filters
            </div>
            <select class="form-select pl-3 pr-10 py-2 text-sm rounded-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:ring-primary focus:border-primary shadow-sm">
                <option>All Time</option>
                <option selected="">Monthly</option>
                <option>Yearly</option>
            </select>
            <select class="form-select pl-3 pr-10 py-2 text-sm rounded-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:ring-primary focus:border-primary shadow-sm">
                <option>All Cities</option>
                <option>Jakarta</option>
                <option>Bandung</option>
                <option>Surabaya</option>
                <option>Bali</option>
            </select>
            <select class="form-select pl-3 pr-10 py-2 text-sm rounded-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:ring-primary focus:border-primary shadow-sm" onchange="window.location.href='?category='+this.value">
                <option value="All" {{ $category == 'All' ? 'selected' : '' }}>All Categories (Distance)</option>
                <option value="5K" {{ $category == '5K' ? 'selected' : '' }}>5K Fun Run (Fastest)</option>
                <option value="10K" {{ $category == '10K' ? 'selected' : '' }}>10K Race (Fastest)</option>
                <option value="21K" {{ $category == '21K' ? 'selected' : '' }}>Half Marathon (Fastest)</option>
                <option value="42K" {{ $category == '42K' ? 'selected' : '' }}>Marathon (Fastest)</option>
            </select>
        </div>
        <div class="relative w-full xl:w-96 group">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 group-focus-within:text-primary transition-colors">
                <span class="material-icons">search</span>
            </span>
            <input name="search" value="{{ request('search') }}" class="form-input w-full pl-10 pr-4 py-2 rounded-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:ring-primary focus:border-primary shadow-sm transition-all" placeholder="Search runner name, club, or BIB number..." type="text" onchange="this.form.submit()"/>
            <script>
                const searchInput = document.querySelector('input[name="search"]');
                searchInput.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        window.location.href = '?search=' + this.value + '&category={{ $category }}&sort={{ $sort }}';
                    }
                });
            </script>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden relative flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                        <th class="px-6 py-4 font-bold text-center w-20">Rank</th>
                        <th class="px-6 py-4 font-bold">Runner Name</th>
                        <th class="px-6 py-4 font-bold hidden md:table-cell">City / Domicile</th>
                        <th class="px-6 py-4 font-bold hidden lg:table-cell text-right">Total Events</th>
                        <th class="px-6 py-4 font-bold hidden sm:table-cell text-right">Elev. Gain</th>
                        <th class="px-6 py-4 font-bold text-right text-primary">Total Distance</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rankings as $index => $runner)
                    <tr class="hover:bg-blue-50/50 dark:hover:bg-gray-700/30 transition-colors group">
                        <td class="px-6 py-4 text-center font-display font-bold text-gray-700 dark:text-gray-300 text-lg group-hover:text-primary transition-colors">
                            {{ $rankings->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <img class="w-10 h-10 rounded-full bg-gray-200 object-cover" src="{{ $runner->Gambar ?? 'https://ui-avatars.com/api/?name='.urlencode($runner->NamaLengkap).'&background=random' }}"/>
                                </div>
                                <div>
                                    <span class="font-bold text-gray-900 dark:text-white block">{{ $runner->NamaLengkap }}</span>
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <span>{{ '@' . $runner->Username }}</span>
                                        @if(isset($runner->NomorBIB))
                                            <span class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 font-mono text-gray-600 dark:text-gray-300">BIB: {{ $runner->NomorBIB }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell text-gray-500 dark:text-gray-400">
                            <div class="flex items-center gap-2">
                                @php 
                                    $rowCitySlug = \Illuminate\Support\Str::slug($runner->Kota);
                                    $rowIconFile = $cityIcons[$rowCitySlug] ?? null;
                                @endphp
                                @if($rowIconFile)
                                    <img src="{{ asset('assets/cities/'.$rowIconFile) }}" class="w-5 h-5 object-contain" alt="{{ $runner->Kota }}" title="{{ $runner->Kota }}">
                                @endif
                                {{ $runner->Kota ?? '-' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden lg:table-cell text-right text-gray-900 dark:text-white font-medium">
                            {{ $isSpeedRank ? '-' : $runner->TotalRace }}
                        </td>
                        <td class="px-6 py-4 hidden sm:table-cell text-right font-mono text-gray-600 dark:text-gray-400">
                             {{ $isSpeedRank ? $runner->NamaKategori : '--' }}
                        </td>
                        <td class="px-6 py-4 text-right font-display font-bold text-gray-900 dark:text-white text-lg">
                            @if($isSpeedRank)
                                {{ $runner->WaktuFinish }}
                            @else
                                {{ number_format($runner->TotalDist, 0) }} <span class="text-xs text-gray-400 font-sans font-normal">KM</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="p-6 text-center text-gray-500">No runners found for this category.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Sticky Footer for User Rank -->
<div class="sticky bottom-0 bg-primary dark:bg-blue-900 text-white border-t-4 border-blue-400 dark:border-blue-800 shadow-2xl z-20 mt-8 -mx-4 lg:-mx-10 px-4 lg:px-10 py-0">
    <div class="overflow-x-auto no-scrollbar">
        <table class="w-full text-left">
            <tbody>
                <tr class="bg-gradient-to-r from-primary to-blue-600 dark:from-blue-900 dark:to-slate-900">
                    @if(isset($userStats))
                    <td class="px-6 py-3 text-center w-20">
                        <div class="flex flex-col items-center">
                            <span class="text-[10px] uppercase tracking-wider opacity-75">Your Rank</span>
                            <span class="font-display font-bold text-2xl">#{{ $userStats->rank }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-3 min-w-[200px]">
                        <div class="flex items-center gap-3">
                            <img class="w-10 h-10 rounded-full border-2 border-white/30" src="{{ Auth::user()->Gambar ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->NamaLengkap).'&background=random' }}"/>
                            <div>
                                <span class="font-bold block text-lg">You</span>
                                <span class="text-xs text-blue-100 flex items-center gap-1">
                                    <span class="material-icons text-[10px]">arrow_upward</span> Top {{ $userStats->percentile }}%
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-3 hidden md:table-cell text-blue-100 font-medium">{{ Auth::user()->Kota ?? 'Runner' }}</td>
                    <td class="px-6 py-3 hidden lg:table-cell text-right font-bold text-lg">{{ $userStats->total_events }}</td>
                    <td class="px-6 py-3 hidden sm:table-cell text-right font-mono text-blue-100">-</td>
                    <td class="px-6 py-3 text-right">
                        <div class="flex flex-col items-end">
                            <span class="font-display font-bold text-white text-xl">{{ $userStats->display_value }}</span>
                            <span class="text-[10px] uppercase opacity-75">{{ $userStats->label }}</span>
                        </div>
                    </td>
                    @else
                    <td colspan="6" class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-4">
                            <span class="material-icons text-yellow-300 text-3xl">emoji_events</span>
                            <div class="text-left">
                                <div class="font-bold text-lg text-white">Not Ranked Yet</div>
                                <div class="text-xs text-blue-100">Join a race to see your standing on the leaderboard!</div>
                            </div>
                            <a href="{{ route('dashboard.events') }}" class="ml-4 px-4 py-2 bg-white text-primary font-bold rounded-lg text-sm hover:bg-gray-100 transition-colors">Find a Race</a>
                        </div>
                    </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
