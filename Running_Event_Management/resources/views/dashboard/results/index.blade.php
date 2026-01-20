@extends('layouts.dashboard')

@section('title', 'Results')
@section('header_title', 'Results & Timing')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div>
        <h1 class="text-3xl lg:text-4xl font-display font-bold uppercase italic text-gray-900 dark:text-white">
            RESULTS <span class="text-primary">& TIMING</span>
        </h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">
            Analyze your race history, track personal bests, and download official certificates.
        </p>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-card-dark p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                <span class="material-icons text-3xl text-primary">emoji_events</span>
            </div>
            <div>
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wide">Personal Best</div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white flex items-baseline gap-2">
                    {{ $personalBest->TimeDisplay ?? '--:--:--' }}
                    <span class="text-xs font-normal text-gray-500">
                        ({{ $personalBest->NamaEvent ?? 'No Data' }} - {{ $personalBest->NamaKategori ?? '' }})
                    </span>
                </div>
                <div class="text-xs text-green-600 font-medium mt-1">Fastest Pace: {{ $pbPaceFormatted }}/km</div>
            </div>
        </div>

        <div class="bg-white dark:bg-card-dark p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl">
                <span class="material-icons text-3xl text-secondary">directions_run</span>
            </div>
            <div>
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wide">Total Finished</div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalRaces }} <span class="text-sm font-normal text-gray-500">Races</span></div>
                <div class="text-xs text-gray-500 mt-1">All time history</div>
            </div>
        </div>

        <div class="bg-white dark:bg-card-dark p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-rose-100 dark:bg-rose-900/30 rounded-xl">
                <span class="material-icons text-3xl text-accent">speed</span>
            </div>
            <div>
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wide">Average Pace</div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $avgPace }} <span class="text-sm font-normal text-gray-500">/km</span></div>
                <div class="text-xs text-gray-500 mt-1">Across all distances</div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-card-dark p-4 rounded-xl border border-gray-200 dark:border-gray-800 flex flex-wrap gap-4 items-center justify-between">
        <div class="relative flex-1 min-w-[200px]">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-icons text-gray-400 text-sm">search</span>
            </span>
            <input class="pl-9 pr-4 py-2 bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-sm w-full focus:ring-2 focus:ring-primary text-gray-900 dark:text-white placeholder-gray-500" placeholder="Search by event name..." type="text"/>
        </div>
        <div class="flex gap-2">
            <select class="bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-sm text-gray-700 dark:text-gray-300 py-2 pl-3 pr-8 focus:ring-1 focus:ring-primary" onchange="window.location.href='?year='+this.value">
                <option value="All">Year: All</option>
                <option value="2026">2026</option>
                <option value="2025">2025</option>
            </select>
            <select class="bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-sm text-gray-700 dark:text-gray-300 py-2 pl-3 pr-8 focus:ring-1 focus:ring-primary" onchange="window.location.href='?distance='+this.value">
                <option value="All">Distance: All</option>
                <option value="5K">5K</option>
                <option value="10K">10K</option>
                <option value="21K">21K</option>
                <option value="42K">42K</option>
            </select>
        </div>
    </div>

    <!-- Results Table -->
    <div class="bg-white dark:bg-card-dark rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-800/50 text-xs uppercase font-bold text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-4">Event Name</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Distance</th>
                        <th class="px-6 py-4">Official Time</th>
                        <th class="px-6 py-4">Pace</th>
                        <th class="px-6 py-4 text-center">Rank</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($results as $res)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-gray-200 overflow-hidden">
                                    <img src="{{ $res->GambarEvent ?? 'https://placehold.co/100' }}" alt="Event" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900 dark:text-white">{{ $res->NamaEvent }}</div>
                                    <div class="text-xs">{{ $res->NamaKategori }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($res->EventDate ?? $res->TanggalPendaftaran)->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                {{ $res->Jarak }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-mono font-medium text-gray-900 dark:text-white">
                            {{ $res->WaktuFinish }}
                        </td>
                        <td class="px-6 py-4 font-mono text-sm text-emerald-600 dark:text-emerald-400 font-medium">
                            {{ $res->Pace ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-bold text-gray-900 dark:text-white">#{{ $res->PeringkatUmum }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="text-gray-400 hover:text-primary transition-colors" title="View Details">
                                    <span class="material-icons text-lg">visibility</span>
                                </button>
                                <button class="text-gray-400 hover:text-accent transition-colors" title="Download Certificate">
                                    <span class="material-icons text-lg">workspace_premium</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            No race results found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">
            {{ $results->links() }}
        </div>
    </div>
</div>
@endsection
