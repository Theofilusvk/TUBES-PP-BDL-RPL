@extends('layouts.app')

@section('title', 'Dashboard Peserta')

@section('content')
<header class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
    <div>
        <h2 class="text-3xl font-bold text-text-light dark:text-text-dark">Selamat Datang, {{ $user->NamaLengkap }}! 👋</h2>
        <p class="text-muted-light dark:text-muted-dark mt-1">Ini ringkasan aktivitas event lari Anda hari ini.
        </p>
    </div>
    <div class="flex items-center gap-4">
        <div class="relative hidden md:block">
            <span
                class="absolute inset-y-0 left-0 flex items-center pl-3 text-muted-light dark:text-muted-dark">
                <span class="material-icons-outlined">search</span>
            </span>
            <input
                class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-card-dark text-sm focus:ring-primary focus:border-primary w-64"
                placeholder="Cari event, peserta..." type="text" />
        </div>
        <button class="relative p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
            <span class="material-icons-outlined text-muted-light dark:text-muted-dark">notifications</span>
            <span
                class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border border-white dark:border-gray-900"></span>
        </button>
        <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
            onclick="document.documentElement.classList.toggle('dark')">
            <span
                class="material-icons-outlined text-muted-light dark:text-muted-dark dark:hidden">dark_mode</span>
            <span
                class="material-icons-outlined text-muted-light dark:text-muted-dark hidden dark:inline">light_mode</span>
        </button>
    </div>
</header>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div
        class="bg-card-light dark:bg-card-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between group hover:shadow-md transition-all">
        <div>
            <p class="text-sm font-medium text-muted-light dark:text-muted-dark mb-1">Event Terdaftar</p>
            <h3 class="text-3xl font-bold text-text-light dark:text-text-dark">{{ $registeredCount }}</h3>
            <p class="text-xs text-green-500 flex items-center gap-1 mt-2 font-medium">
                <span class="material-icons-outlined text-sm">trending_up</span> +2 bulan ini
            </p>
        </div>
        <div
            class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary">
            <span class="material-icons-outlined text-2xl">confirmation_number</span>
        </div>
    </div>
    <div
        class="bg-card-light dark:bg-card-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between group hover:shadow-md transition-all">
        <div>
            <p class="text-sm font-medium text-muted-light dark:text-muted-dark mb-1">Total Jarak (km)</p>
            <h3 class="text-3xl font-bold text-text-light dark:text-text-dark">0</h3>
            <p class="text-xs text-green-500 flex items-center gap-1 mt-2 font-medium">
                <span class="material-icons-outlined text-sm">arrow_upward</span> Personal Best
            </p>
        </div>
        <div
            class="w-12 h-12 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400">
            <span class="material-icons-outlined text-2xl">directions_run</span>
        </div>
    </div>
    <div
        class="bg-card-light dark:bg-card-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between group hover:shadow-md transition-all">
        <div>
            <p class="text-sm font-medium text-muted-light dark:text-muted-dark mb-1">Peringkat Global</p>
            <h3 class="text-3xl font-bold text-text-light dark:text-text-dark">-</h3>
            <p class="text-xs text-blue-500 flex items-center gap-1 mt-2 font-medium">
                Belum ada peringkat
            </p>
        </div>
        <div
            class="w-12 h-12 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-yellow-600 dark:text-yellow-400">
            <span class="material-icons-outlined text-2xl">emoji_events</span>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-text-light dark:text-text-dark">Event Saya ({{ count($myRegistrations) }})</h3>
            <a class="text-sm text-primary font-medium hover:underline" href="#">Lihat Semua</a>
        </div>
        
        @forelse($myRegistrations as $reg)
        <div
            class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow flex flex-col sm:flex-row">
            <div class="h-48 sm:h-auto sm:w-48 bg-gray-200 relative">
                <img alt="Event Image" class="w-full h-full object-cover"
                    src="https://images.unsplash.com/photo-1552674605-4694553024c3" />
                <div
                    class="absolute top-2 right-2 bg-white dark:bg-black/50 backdrop-blur-md px-2 py-1 rounded text-xs font-bold shadow-sm">
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
                        <span class="text-xs text-muted-light dark:text-muted-dark flex items-center gap-1">
                            <span class="material-icons-outlined text-sm">place</span> {{ $reg->category->event->LokasiEvent ?? 'Lokasi tidak tersedia' }}
                        </span>
                    </div>
                    <h4 class="text-lg font-bold text-text-light dark:text-text-dark mb-1">{{ $reg->category->event->NamaEvent ?? 'Nama Event' }}
                    </h4>
                    <p class="text-sm text-muted-light dark:text-muted-dark mb-4">Kategori: {{ $reg->category->NamaKategori ?? '-' }}
                    </p>
                </div>
                <div class="flex items-center justify-between mt-2">
                    <div class="flex -space-x-2">
                         <!-- Dummy Avatars -->
                         <div class="w-8 h-8 rounded-full border-2 border-white dark:border-gray-800 bg-gray-200"></div>
                         <div class="w-8 h-8 rounded-full border-2 border-white dark:border-gray-800 bg-gray-300"></div>
                    </div>
                    <button
                        class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        Detail Race Pack
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-muted-light">
            Belum ada event yang didaftar.
        </div>
        @endforelse
    </div>
    <div class="space-y-6">
        <div class="bg-primary rounded-xl p-6 text-white shadow-lg relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-white opacity-10 rounded-full"></div>
            <div class="absolute -right-10 bottom-0 w-32 h-32 bg-white opacity-10 rounded-full"></div>
            <h3 class="text-lg font-bold mb-4 relative z-10">Aksi Cepat</h3>
            <div class="grid grid-cols-2 gap-3 relative z-10">
                <button
                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-lg flex flex-col items-center justify-center gap-2 transition-colors">
                    <span class="material-icons-outlined">add_circle</span>
                    <span class="text-xs font-medium">Daftar Event</span>
                </button>
                <button
                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-lg flex flex-col items-center justify-center gap-2 transition-colors">
                    <span class="material-icons-outlined">qr_code</span>
                    <span class="text-xs font-medium">Ambil Racepack</span>
                </button>
                <button
                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-lg flex flex-col items-center justify-center gap-2 transition-colors">
                    <span class="material-icons-outlined">cloud_upload</span>
                    <span class="text-xs font-medium">Upload Hasil</span>
                </button>
                <button
                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-lg flex flex-col items-center justify-center gap-2 transition-colors">
                    <span class="material-icons-outlined">support_agent</span>
                    <span class="text-xs font-medium">Bantuan</span>
                </button>
            </div>
        </div>
        <div
            class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="text-lg font-bold text-text-light dark:text-text-dark mb-4">Aktivitas Terkini</h3>
            <div class="space-y-4">
                <div class="flex gap-3">
                    <div class="mt-1">
                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-text-light dark:text-text-dark">Pendaftaran Jakarta
                            Marathon</p>
                        <p class="text-xs text-muted-light dark:text-muted-dark">Berhasil diverifikasi • 2 jam
                            yang lalu</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="mt-1">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-text-light dark:text-text-dark">Pembayaran Diterima
                        </p>
                        <p class="text-xs text-muted-light dark:text-muted-dark">INV-2024001 • 5 jam yang lalu
                        </p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="mt-1">
                        <div class="w-2 h-2 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-text-light dark:text-text-dark">Login Sistem</p>
                        <p class="text-xs text-muted-light dark:text-muted-dark">Dari Chrome Desktop • Hari ini
                            08:00</p>
                    </div>
                </div>
            </div>
            <button
                class="w-full mt-4 text-center text-xs text-muted-light dark:text-muted-dark hover:text-primary transition-colors">
                Lihat Log Lengkap
            </button>
        </div>
    </div>
</div>
@endsection
