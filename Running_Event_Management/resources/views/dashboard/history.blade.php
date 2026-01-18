@extends('layouts.app')

@section('title', 'Portofolio & Riwayat Lari')

@section('content')
<style>
    .timeline-line::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 2px;
        background-color: #E5E7EB;transform: translateX(-50%);
        z-index: 0;
    }
    .dark .timeline-line::before {
            background-color: #374151;}
</style>

<header class="h-16 bg-card-light dark:bg-card-dark shadow-sm flex items-center justify-between px-6 sticky top-0 z-20 mb-6 rounded-xl">
    <div class="flex items-center gap-4">
        <h1 class="text-xl font-bold text-text-main-light dark:text-text-main-dark">Portofolio &amp; Riwayat Lari</h1>
    </div>
    <div class="flex items-center gap-4">
        <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 text-text-sub-light dark:text-text-sub-dark">
            <span class="material-icons-outlined">notifications</span>
        </button>
        <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 text-text-sub-light dark:text-text-sub-dark" onclick="document.documentElement.classList.toggle('dark')">
            <span class="material-icons-outlined">dark_mode</span>
        </button>
    </div>
</header>

<div class="space-y-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-card-light dark:bg-card-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 lg:col-span-2">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Analisis Performa</h2>
                <select class="bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-sm text-muted-light dark:text-muted-dark px-3 py-1 focus:ring-primary">
                    <option>Tahun Ini</option>
                    <option>Tahun Lalu</option>
                </select>
            </div>
            <div class="h-64 w-full">
                <canvas id="performanceChart"></canvas>
            </div>
        </div>
        <div class="bg-card-light dark:bg-card-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Pencapaian</h2>
                <a class="text-sm text-primary font-medium hover:underline" href="#">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-2 gap-4 flex-1">
                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 p-4 rounded-xl flex flex-col items-center justify-center text-center border border-yellow-100 dark:border-yellow-900/30 hover:shadow-md transition-shadow cursor-pointer group">
                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-800 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                        <span class="material-icons-outlined text-yellow-600 dark:text-yellow-300 text-2xl">local_fire_department</span>
                    </div>
                    <h3 class="font-bold text-sm text-yellow-800 dark:text-yellow-200">Marathon Finisher</h3>
                    <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-1">Selesaikan 42K</p>
                </div>
                <!-- More achievement items... -->
                 <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 p-4 rounded-xl flex flex-col items-center justify-center text-center border border-blue-100 dark:border-blue-900/30 hover:shadow-md transition-shadow cursor-pointer group">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-800 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                        <span class="material-icons-outlined text-blue-600 dark:text-blue-300 text-2xl">speed</span>
                    </div>
                    <h3 class="font-bold text-sm text-blue-800 dark:text-blue-200">Speed Demon</h3>
                    <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">Pace &lt; 5:00/km</p>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 p-4 rounded-xl flex flex-col items-center justify-center text-center border border-purple-100 dark:border-purple-900/30 hover:shadow-md transition-shadow cursor-pointer group">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-800 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                        <span class="material-icons-outlined text-purple-600 dark:text-purple-300 text-2xl">terrain</span>
                    </div>
                    <h3 class="font-bold text-sm text-purple-800 dark:text-purple-200">Trail Master</h3>
                    <p class="text-xs text-purple-600 dark:text-purple-400 mt-1">500m Elevasi</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl flex flex-col items-center justify-center text-center border border-gray-100 dark:border-gray-700 opacity-60">
                    <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mb-2">
                        <span class="material-icons-outlined text-gray-400 text-2xl">lock</span>
                    </div>
                    <h3 class="font-bold text-sm text-gray-500">Ultra Runner</h3>
                    <p class="text-xs text-gray-400 mt-1">Locked</p>
                </div>
            </div>
        </div>
    </div>
    
    <div>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Riwayat Event</h2>
            <div class="flex gap-2 bg-white dark:bg-gray-800 p-1 rounded-lg shadow-sm w-fit">
                <button class="px-4 py-2 rounded-md bg-primary text-white text-sm font-medium shadow-sm flex items-center gap-2">
                    <span class="material-icons-outlined text-sm">view_agenda</span> Kartu
                </button>
                <button class="px-4 py-2 rounded-md text-muted-light dark:text-muted-dark hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium transition-colors flex items-center gap-2">
                    <span class="material-icons-outlined text-sm">table_rows</span> Daftar
                </button>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <!-- Event Card 1 -->
            <div class="group bg-card-light dark:bg-card-dark rounded-2xl shadow-sm hover:shadow-lg dark:shadow-none dark:hover:bg-gray-800 transition-all border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col">
                <div class="h-40 bg-gray-200 relative overflow-hidden">
                    <img alt="Jakarta Marathon 2023" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAz1QgIY6I9V87JrwT_DSxjT_GX3WfhKHZ6AetP3cP_HVRZl2rAudwJfGL8jFKMUzXrkt7qrPyQtWxxgWxn2DlAoxy36V1abkFzhlzdi4DVQ0oMPh9VSTbMHypVZgc62fBEsIaOqAiUSSq36Cnk4PawNX2trzBc1x7ZlPcSvm6x30FK2snJyDQam8_xBFS9ipDKYYvFDfST4tH3lq6zCMFzhPEBd9pIdXJWV4i_dUhQVxN76vejp89u6CAJuyN50h0mgqUZR47pjeY"/>
                    <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Finished</div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <h3 class="text-white font-bold text-lg">Jakarta Marathon 2023</h3>
                        <p class="text-gray-200 text-sm">22 Oktober 2023</p>
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-2">
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 p-1.5 rounded-lg">
                                <span class="material-icons-outlined text-xl">timer</span>
                            </span>
                            <div>
                                <p class="text-xs text-muted-light dark:text-muted-dark">Finish Time</p>
                                <p class="font-bold font-mono text-gray-900 dark:text-white">03:45:12</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-muted-light dark:text-muted-dark">Category</p>
                            <p class="font-semibold text-primary">Full Marathon</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-2 mt-auto">
                        <button class="flex flex-col items-center justify-center p-2 rounded-xl bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group/btn">
                            <span class="material-icons-outlined text-yellow-500 mb-1 group-hover/btn:scale-110 transition-transform">military_tech</span>
                            <span class="text-[10px] font-medium text-muted-light dark:text-muted-dark">Medali</span>
                        </button>
                        <button class="flex flex-col items-center justify-center p-2 rounded-xl bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group/btn">
                            <span class="material-icons-outlined text-blue-500 mb-1 group-hover/btn:scale-110 transition-transform">workspace_premium</span>
                            <span class="text-[10px] font-medium text-muted-light dark:text-muted-dark">Sertifikat</span>
                        </button>
                        <button class="flex flex-col items-center justify-center p-2 rounded-xl bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group/btn">
                            <span class="material-icons-outlined text-purple-500 mb-1 group-hover/btn:scale-110 transition-transform">photo_library</span>
                            <span class="text-[10px] font-medium text-muted-light dark:text-muted-dark">Galeri</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Event Card 2 -->
             <div class="group bg-card-light dark:bg-card-dark rounded-2xl shadow-sm hover:shadow-lg dark:shadow-none dark:hover:bg-gray-800 transition-all border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col">
                <div class="h-40 bg-gray-200 relative overflow-hidden">
                    <img alt="Bali Trail Run" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBaSbVFt5dpjUuGZg3tD-nsWeWVgXHmBJ4qqNj7W3JsvVreLSlEYgRZpdM3WNfA-Gh0SYf57R3Fo5Q4e2McPEDXelFaFdHrF5sh7pMrF8V5RpUEr5LSzrCcK9T8NnanmlCIBSKoPoVEX_EjC6PjrYL8AWagg5lB9LmugipectQuTJNrpUKcVtnjrfajSbe9wV4y-e_dq85btPD__yzx8zcGHeBQVq1VN64AkXdkHPdcmaENlwblgf4ukJGUvBMwyXevBBzUoT3I0H4"/>
                    <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Finished</div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <h3 class="text-white font-bold text-lg">Bali Trail Run 2023</h3>
                        <p class="text-gray-200 text-sm">15 Agustus 2023</p>
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-2">
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 p-1.5 rounded-lg">
                                <span class="material-icons-outlined text-xl">timer</span>
                            </span>
                            <div>
                                <p class="text-xs text-muted-light dark:text-muted-dark">Finish Time</p>
                                <p class="font-bold font-mono text-gray-900 dark:text-white">02:15:30</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-muted-light dark:text-muted-dark">Category</p>
                            <p class="font-semibold text-primary">21K Trail</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-2 mt-auto">
                        <button class="flex flex-col items-center justify-center p-2 rounded-xl bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group/btn">
                            <span class="material-icons-outlined text-yellow-500 mb-1 group-hover/btn:scale-110 transition-transform">military_tech</span>
                            <span class="text-[10px] font-medium text-muted-light dark:text-muted-dark">Medali</span>
                        </button>
                        <button class="flex flex-col items-center justify-center p-2 rounded-xl bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group/btn">
                            <span class="material-icons-outlined text-blue-500 mb-1 group-hover/btn:scale-110 transition-transform">workspace_premium</span>
                            <span class="text-[10px] font-medium text-muted-light dark:text-muted-dark">Sertifikat</span>
                        </button>
                        <button class="flex flex-col items-center justify-center p-2 rounded-xl bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group/btn">
                            <span class="material-icons-outlined text-purple-500 mb-1 group-hover/btn:scale-110 transition-transform">photo_library</span>
                            <span class="text-[10px] font-medium text-muted-light dark:text-muted-dark">Galeri</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Event Card 3 -->
            <div class="group bg-card-light dark:bg-card-dark rounded-2xl shadow-sm hover:shadow-lg dark:shadow-none dark:hover:bg-gray-800 transition-all border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col">
                <div class="h-40 bg-gray-200 relative overflow-hidden">
                    <img alt="Borobudur Marathon" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 grayscale group-hover:grayscale-0" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA1f2DN1F4_7OziQeHoJsKTH5rd4w-APymSFGh2HZLLz6sw4URO-Mn0Q3_aoGzaUC-oVy6FmMexRat_6yaAoneSeODTAJKbjn5VgYE73qcuYHWYcHNVuCQUeBgXOEggJkAr99iVTCYZKxT2LSk31pgIWynCI6SYSl4xtHDcvTkZpfptiD03EnBCBZ6jbPiGFBLHleXCS8uSbUBDX0jXNOVkp2vOoChdf8oZHRMeJ9HQWjtaSco_xk_cKC4z7TtYiWAxFc4LRc0XTUo"/>
                    <div class="absolute top-3 right-3 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Upcoming</div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <h3 class="text-white font-bold text-lg">Borobudur Marathon 2024</h3>
                        <p class="text-gray-200 text-sm">12 November 2024</p>
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-2 opacity-50">
                            <span class="bg-gray-100 dark:bg-gray-700 text-gray-400 p-1.5 rounded-lg">
                                <span class="material-icons-outlined text-xl">timer</span>
                            </span>
                            <div>
                                <p class="text-xs text-muted-light dark:text-muted-dark">Finish Time</p>
                                <p class="font-bold font-mono text-gray-900 dark:text-white">--:--:--</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-muted-light dark:text-muted-dark">Category</p>
                            <p class="font-semibold text-primary">10K Run</p>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <div class="bg-blue-50 dark:bg-blue-900/30 rounded-xl p-3 flex items-start gap-3">
                            <span class="material-icons-outlined text-primary text-xl mt-0.5">info</span>
                            <div>
                                <p class="text-xs font-semibold text-primary mb-1">Race Pack Belum Diambil</p>
                                <a class="text-xs underline text-blue-600 dark:text-blue-300" href="#">Lihat jadwal pengambilan →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-card-light dark:bg-card-dark rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
            <h3 class="font-bold text-lg text-gray-900 dark:text-white">Log Aktivitas Terbaru</h3>
            <button class="text-sm text-primary hover:underline">Lihat Semua</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-muted-light dark:text-muted-dark">
                <thead class="bg-gray-50 dark:bg-gray-800 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-6 py-3">Event</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Aktivitas</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <td class="px-6 py-4 font-medium text-text-light dark:text-text-dark">Borobudur Marathon 2024</td>
                        <td class="px-6 py-4">20 Okt 2024</td>
                        <td class="px-6 py-4">Pembayaran Pendaftaran</td>
                        <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Verified</span></td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <td class="px-6 py-4 font-medium text-text-light dark:text-text-dark">Jakarta Marathon 2023</td>
                        <td class="px-6 py-4">22 Okt 2023</td>
                        <td class="px-6 py-4">Unduh Sertifikat</td>
                        <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">Completed</span></td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <td class="px-6 py-4 font-medium text-text-light dark:text-text-dark">Jakarta Marathon 2023</td>
                        <td class="px-6 py-4">22 Okt 2023</td>
                        <td class="px-6 py-4">Catat Waktu Finish</td>
                        <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">System</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Chart.js Configuration
    const ctx = document.getElementById('performanceChart').getContext('2d');
    // Setup gradient for the chart
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(37, 99, 235, 0.5)'); // primary color with opacity
    gradient.addColorStop(1, 'rgba(37, 99, 235, 0.0)');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            datasets: [{
                label: 'Jarak Lari (KM)',
                data: [12, 19, 15, 25, 22, 30, 45, 35, 50, 65], // Sample data representing progress
                borderColor: '#2563EB',
                backgroundColor: gradient,
                borderWidth: 2,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#2563EB',
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                    titleColor: '#F9FAFB',
                    bodyColor: '#F3F4F6',
                    borderColor: 'rgba(255,255,255,0.1)',
                    borderWidth: 1,
                    padding: 10,
                    displayColors: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(156, 163, 175, 0.1)',
                        borderDash: [5, 5]
                    },
                    ticks: {
                        color: '#9CA3AF',
                        font: {
                            family: "'Inter', sans-serif"
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#9CA3AF',
                        font: {
                            family: "'Inter', sans-serif"
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
        }
    });

    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.attributeName === 'class') {
                // Re-render chart logic could go here if colors needed to change dramatically
            }
        });
    });
    observer.observe(document.documentElement, { attributes: true });
</script>
@endsection
