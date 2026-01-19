@extends('layouts.dashboard')

@section('title', 'Dashboard Peserta')
@section('header_title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Selamat Datang, {{ $user->NamaLengkap }}! 👋</h2>
    <p class="text-gray-500 dark:text-gray-400 mt-1">Ini ringkasan aktivitas event lari Anda hari ini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white dark:bg-card-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between group hover:shadow-md transition-all">
        <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Event Terdaftar</p>
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $registeredCount }}</h3>
            <p class="text-xs text-green-500 flex items-center gap-1 mt-2 font-medium">
                <span class="material-icons text-sm">trending_up</span> +2 bulan ini
            </p>
        </div>
        <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary">
            <span class="material-icons text-2xl">confirmation_number</span>
        </div>
    </div>
    <div class="bg-white dark:bg-card-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between group hover:shadow-md transition-all">
        <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Jarak (km)</p>
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">0</h3>
            <p class="text-xs text-green-500 flex items-center gap-1 mt-2 font-medium">
                <span class="material-icons text-sm">arrow_upward</span> Personal Best
            </p>
        </div>
        <div class="w-12 h-12 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400">
            <span class="material-icons text-2xl">directions_run</span>
        </div>
    </div>
    <div class="bg-white dark:bg-card-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between group hover:shadow-md transition-all">
        <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Peringkat Global</p>
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">-</h3>
            <p class="text-xs text-blue-500 flex items-center gap-1 mt-2 font-medium">
                Belum ada peringkat
            </p>
        </div>
        <div class="w-12 h-12 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-yellow-600 dark:text-yellow-400">
            <span class="material-icons text-2xl">emoji_events</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Event Saya ({{ count($myRegistrations) }})</h3>
            <a class="text-sm text-primary font-medium hover:underline" href="{{ route('dashboard.events', ['filter' => 'my_events']) }}">Lihat Semua</a>
        </div>
        
        @forelse($myRegistrations as $reg)
        <div class="bg-white dark:bg-card-dark rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow flex flex-col sm:flex-row">
            <div class="h-48 sm:h-auto sm:w-48 bg-gray-200 relative">
                <img alt="Event Image" class="w-full h-full object-cover"
                    src="{{ $reg->category->event->GambarEvent ?? 'https://placehold.co/600x400' }}" />
                <div class="absolute top-2 right-2 bg-white/90 dark:bg-black/50 backdrop-blur-md px-2 py-1 rounded text-xs font-bold shadow-sm">
                    {{ \Carbon\Carbon::parse($reg->category->event->TanggalMulai ?? now())->format('d M') }}
                </div>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        @if($reg->StatusPendaftaran == 'Terverifikasi')
                        <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-semibold rounded-full">Terdaftar</span>
                        @else
                        <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-semibold rounded-full">{{ $reg->StatusPendaftaran }}</span>
                        @endif
                        <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                            <span class="material-icons text-sm">place</span> {{ $reg->category->event->LokasiEvent ?? 'Lokasi tidak tersedia' }}
                        </span>
                    </div>
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $reg->category->event->NamaEvent ?? 'Nama Event' }}
                    </h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Kategori: {{ $reg->category->NamaKategori ?? '-' }}
                    </p>
                </div>
                <div class="flex items-center justify-between mt-2">
                    <div class="flex -space-x-2">
                         <!-- Placeholders for participants -->
                         <div class="w-8 h-8 rounded-full border-2 border-white dark:border-gray-800 bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-500">{{ substr($reg->NamaPeserta ?? 'U', 0, 1) }}</div>
                    </div>
                    <button class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        Detail Race Pack
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-500 dark:text-gray-400 bg-white dark:bg-card-dark rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
            Belum ada event yang didaftar. <a href="{{ route('dashboard.events') }}" class="text-primary hover:underline">Cari event sekarang</a>.
        </div>
        @endforelse
    </div>
    <div class="space-y-6">
        <div class="bg-primary rounded-xl p-6 text-white shadow-lg relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-white opacity-10 rounded-full"></div>
            <div class="absolute -right-10 bottom-0 w-32 h-32 bg-white opacity-10 rounded-full"></div>
            <h3 class="text-lg font-bold mb-4 relative z-10">Aksi Cepat</h3>
            <div class="grid grid-cols-2 gap-3 relative z-10">
                <a href="{{ route('dashboard.events') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-lg flex flex-col items-center justify-center gap-2 transition-colors cursor-pointer">
                    <span class="material-icons">add_circle</span>
                    <span class="text-xs font-medium">Daftar Event</span>
                </a>
                <button class="bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-lg flex flex-col items-center justify-center gap-2 transition-colors">
                    <span class="material-icons">qr_code</span>
                    <span class="text-xs font-medium">Ambil Racepack</span>
                </button>
                <button class="bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-lg flex flex-col items-center justify-center gap-2 transition-colors">
                    <span class="material-icons">cloud_upload</span>
                    <span class="text-xs font-medium">Upload Hasil</span>
                </button>
                <button class="bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-lg flex flex-col items-center justify-center gap-2 transition-colors">
                    <span class="material-icons">support_agent</span>
                    <span class="text-xs font-medium">Bantuan</span>
                </button>
            </div>
        </div>
        <div class="bg-white dark:bg-card-dark rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Aktivitas Terkini</h3>
            <div class="space-y-4">
                <div class="flex gap-3">
                    <div class="mt-1">
                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Pendaftaran Jakarta Marathon</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Berhasil diverifikasi • 2 jam yang lalu</p>
                    </div>
                </div>
                <!-- More items can be dynamic later -->
            </div>
        </div>
    </div>
</div>
@endsection
