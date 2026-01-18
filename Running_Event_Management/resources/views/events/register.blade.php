@extends('layouts.app')

@section('title', 'Pendaftaran Event')

@section('content')
<nav aria-label="Breadcrumb" class="flex mb-8">
    <ol class="flex items-center space-x-4">
        <li>
            <div>
                <a class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300" href="{{ route('dashboard') }}">
                    <span class="material-icons text-xl">home</span>
                    <span class="sr-only">Home</span>
                </a>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <span class="material-icons text-gray-400 text-sm">chevron_right</span>
                <a class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" href="#">Events</a>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <span class="material-icons text-gray-400 text-sm">chevron_right</span>
                <a aria-current="page" class="ml-4 text-sm font-medium text-primary hover:text-primary-dark" href="#">Jakarta Kalcer Run 2024</a>
            </div>
        </li>
    </ol>
</nav>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-surface-light dark:bg-card-dark rounded-xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="relative h-48 bg-gradient-to-r from-blue-600 to-indigo-700">
                <img alt="Runners silhouette at sunset" class="w-full h-full object-cover opacity-40 mix-blend-overlay" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDVy3nCYKMtu9UFm-HYOAMuX5xtpyUC5ssRSc1aSJ7FXRujkauxkZf3s__3QSRmu67ihCnEUjv6eNn2wlIWHritXElJcYtAtgZEHI8rLtOphVzZitpbtjQY7JWJO-0ldGDa2pLzzRoEMXrrc-J9SOUPgCmq4iCQMELA1D8kiTIXrnOVoVQyH-hNs9dfgPkIzjHuu20PlPW49HyWH3zkAw8shWDCUDxjbrLTB5BqOJccfaaZjpomU9NqZc8d_0XhDYI37aZ7-gMhaG0"/>
                <div class="absolute bottom-4 left-4 text-white">
                    <span class="bg-accent text-white text-xs px-2 py-1 rounded-full font-bold uppercase tracking-wider mb-2 inline-block">Open Registration</span>
                    <h1 class="text-2xl font-bold">Jakarta Kalcer Run 2024</h1>
                    <p class="text-sm opacity-90">Senayan Park, Jakarta</p>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-start gap-4">
                    <div class="bg-blue-50 dark:bg-blue-900/30 p-2 rounded-lg text-primary">
                        <span class="material-icons">calendar_today</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Waktu &amp; Tanggal</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Minggu, 12 Agustus 2024</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">05:00 WIB - Selesai</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="bg-blue-50 dark:bg-blue-900/30 p-2 rounded-lg text-primary">
                        <span class="material-icons">place</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Lokasi Start/Finish</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Plaza Timur Senayan</p>
                    </div>
                </div>
                <div class="w-full h-40 bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden relative group cursor-pointer mt-4">
                    <img alt="Map Preview" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5HazoQ24_sGrvhzHvcEGOGpRlTuxcCXZ1kw5Av8HM2ki1744Bd2cEzQ9TrYo0imxkmMOWfALGumwVPYXn_M5e94H1OtzhD8HcM6P0ViipG5oY11sAMQPsYzW1bowSdo5SroqkB9BktphWx0nn3VqBvQaKFRaop1Fr9J0L5VOgsfGXZF5ECnZDCwflR4hEpmrnK18zMQrfMkbd_X780LVsgZfEYe5GkU4crDdg7_ejXvlKRQfzy9wFLAQDYaxhzNpqOqO8NeDt5z0"/>
                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-white text-sm font-medium flex items-center gap-1"><span class="material-icons text-sm">open_in_new</span> Buka Peta</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-surface-light dark:bg-card-dark rounded-xl shadow p-6 border border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-icons text-primary">inventory_2</span> Race Pack
            </h3>
            <ul class="space-y-3">
                <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                    <span class="material-icons text-green-500 text-sm">check_circle</span> Jersey Eksklusif
                </li>
                <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                    <span class="material-icons text-green-500 text-sm">check_circle</span> Nomor BIB + Timing Chip
                </li>
                <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                    <span class="material-icons text-green-500 text-sm">check_circle</span> Medali Finisher
                </li>
                <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                    <span class="material-icons text-green-500 text-sm">check_circle</span> Goodie Bag Sponsor
                </li>
                <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                    <span class="material-icons text-green-500 text-sm">check_circle</span> Asuransi Peserta
                </li>
            </ul>
        </div>
    </div>
    <div class="lg:col-span-2">
        <div class="bg-surface-light dark:bg-card-dark rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="border-b border-gray-200 dark:border-gray-700 p-6 bg-gray-50 dark:bg-gray-800/50">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Formulir Pendaftaran</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Lengkapi data diri Anda untuk mengikuti event.</p>
            </div>
            <form class="p-6 space-y-8">
                <section>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Pilih Kategori</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="relative block cursor-pointer group">
                            <input class="peer sr-only" name="race_category" type="radio" value="5k"/>
                            <div class="p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-700 peer-checked:border-primary peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 transition-all h-full">
                                <div class="flex flex-col h-full justify-between">
                                    <div>
                                        <span class="text-3xl font-black text-gray-800 dark:text-white">5K</span>
                                        <span class="text-sm block text-gray-500 dark:text-gray-400 mt-1">Fun Run</span>
                                    </div>
                                    <div class="mt-4">
                                        <span class="text-lg font-bold text-primary">Rp 150.000</span>
                                        <div class="text-xs text-green-600 dark:text-green-400 font-medium mt-1 flex items-center gap-1">
                                            <span class="material-icons text-xs">bolt</span> Tersedia
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity">
                                <span class="material-icons text-primary">check_circle</span>
                            </div>
                        </label>
                        <label class="relative block cursor-pointer group">
                            <input checked="" class="peer sr-only" name="race_category" type="radio" value="10k"/>
                            <div class="p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-700 peer-checked:border-primary peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 transition-all h-full">
                                <div class="flex flex-col h-full justify-between">
                                    <div>
                                        <span class="text-3xl font-black text-gray-800 dark:text-white">10K</span>
                                        <span class="text-sm block text-gray-500 dark:text-gray-400 mt-1">Competitive</span>
                                    </div>
                                    <div class="mt-4">
                                        <span class="text-lg font-bold text-primary">Rp 250.000</span>
                                        <div class="text-xs text-green-600 dark:text-green-400 font-medium mt-1 flex items-center gap-1">
                                            <span class="material-icons text-xs">bolt</span> Tersedia
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity">
                                <span class="material-icons text-primary">check_circle</span>
                            </div>
                        </label>
                        <label class="relative block cursor-pointer group">
                            <input class="peer sr-only" name="race_category" type="radio" value="21k"/>
                            <div class="p-4 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-700 peer-checked:border-primary peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 transition-all h-full">
                                <div class="flex flex-col h-full justify-between">
                                    <div>
                                        <span class="text-3xl font-black text-gray-800 dark:text-white">21K</span>
                                        <span class="text-sm block text-gray-500 dark:text-gray-400 mt-1">Half Marathon</span>
                                    </div>
                                    <div class="mt-4">
                                        <span class="text-lg font-bold text-primary">Rp 400.000</span>
                                        <div class="text-xs text-red-500 dark:text-red-400 font-medium mt-1 flex items-center gap-1">
                                            <span class="material-icons text-xs">warning</span> Hampir Habis
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity">
                                <span class="material-icons text-primary">check_circle</span>
                            </div>
                        </label>
                    </div>
                </section>
                <hr class="border-gray-200 dark:border-gray-700"/>
                <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-2">Data Peserta</h3>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="first-name">Nama Depan</label>
                        <input class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 shadow-sm focus:border-primary focus:ring-primary sm:text-sm text-gray-900 dark:text-white py-2 px-3" id="first-name" name="first-name" type="text"/>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="last-name">Nama Belakang</label>
                        <input class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 shadow-sm focus:border-primary focus:ring-primary sm:text-sm text-gray-900 dark:text-white py-2 px-3" id="last-name" name="last-name" type="text"/>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="nik">Nomor KTP/NIK</label>
                        <input class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 shadow-sm focus:border-primary focus:ring-primary sm:text-sm text-gray-900 dark:text-white py-2 px-3" id="nik" name="nik" type="text"/>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Untuk verifikasi asuransi.</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="birthdate">Tanggal Lahir</label>
                        <input class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 shadow-sm focus:border-primary focus:ring-primary sm:text-sm text-gray-900 dark:text-white py-2 px-3" id="birthdate" name="birthdate" type="date"/>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="gender">Jenis Kelamin</label>
                        <select class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 shadow-sm focus:border-primary focus:ring-primary sm:text-sm text-gray-900 dark:text-white py-2 px-3" id="gender" name="gender">
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="jersey">Ukuran Jersey</label>
                        <div class="flex gap-2 mt-1">
                            <select class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 shadow-sm focus:border-primary focus:ring-primary sm:text-sm text-gray-900 dark:text-white py-2 px-3" id="jersey" name="jersey">
                                <option>S</option>
                                <option>M</option>
                                <option selected="">L</option>
                                <option>XL</option>
                                <option>XXL</option>
                            </select>
                            <button class="text-primary text-sm font-medium hover:underline whitespace-nowrap" type="button">Lihat Size Chart</button>
                        </div>
                    </div>
                </section>
                <hr class="border-gray-200 dark:border-gray-700"/>
                <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-2">Kontak Darurat</h3>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="emergency-name">Nama Kontak</label>
                        <input class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 shadow-sm focus:border-primary focus:ring-primary sm:text-sm text-gray-900 dark:text-white py-2 px-3" id="emergency-name" name="emergency-name" type="text"/>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="emergency-phone">Nomor Telepon</label>
                        <input class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 shadow-sm focus:border-primary focus:ring-primary sm:text-sm text-gray-900 dark:text-white py-2 px-3" id="emergency-phone" name="emergency-phone" type="tel"/>
                    </div>
                </section>
                <div class="rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 p-6 flex flex-col items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors cursor-pointer">
                    <span class="material-icons text-gray-400 text-4xl mb-2">cloud_upload</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">Upload Surat Keterangan Sehat (Opsional)</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">Format PDF/JPG max 2MB</span>
                    <input class="hidden" type="file"/>
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input class="focus:ring-primary h-4 w-4 text-primary border-gray-300 rounded" id="terms" name="terms" type="checkbox"/>
                    </div>
                    <div class="ml-3 text-sm">
                        <label class="font-medium text-gray-700 dark:text-gray-300" for="terms">Saya menyetujui syarat &amp; ketentuan</label>
                        <p class="text-gray-500 dark:text-gray-400">Saya menyatakan bahwa saya sehat jasmani dan rohani untuk mengikuti event ini.</p>
                    </div>
                </div>
                <div class="flex items-center justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white font-medium text-sm" type="button">Batal</button>
                    <button class="bg-primary hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all flex items-center gap-2" type="submit">
                        Lanjut Pembayaran <span class="material-icons text-sm">arrow_forward</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
