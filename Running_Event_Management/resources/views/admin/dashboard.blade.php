@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6 transition-transform hover:-translate-y-1 duration-200">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Participants</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">4,289</h3>
            </div>
            <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-primary">
                <span class="material-icons-outlined text-2xl">groups</span>
            </div>
        </div>
        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
            <span class="material-icons-outlined text-sm mr-1">trending_up</span>
            <span>+12% from last week</span>
        </div>
    </div>
    <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6 transition-transform hover:-translate-y-1 duration-200">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rp 845.2M</h3>
            </div>
            <div class="p-2 bg-green-50 dark:bg-green-900/20 rounded-lg text-green-600 dark:text-green-400">
                <span class="material-icons-outlined text-2xl">account_balance_wallet</span>
            </div>
        </div>
        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
            <span>v_rekap_keuangan_event</span>
        </div>
    </div>
    <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6 transition-transform hover:-translate-y-1 duration-200">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending Verification</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">28</h3>
            </div>
            <div class="p-2 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg text-yellow-600 dark:text-yellow-400">
                <span class="material-icons-outlined text-2xl">pending_actions</span>
            </div>
        </div>
        <div class="flex items-center text-sm text-yellow-600 dark:text-yellow-400 font-medium">
            <span>Requires action</span>
        </div>
    </div>
    <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6 transition-transform hover:-translate-y-1 duration-200">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Race Packs Distributed</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">68%</h3>
            </div>
            <div class="p-2 bg-purple-50 dark:bg-purple-900/20 rounded-lg text-purple-600 dark:text-purple-400">
                <span class="material-icons-outlined text-2xl">local_shipping</span>
            </div>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 mt-2">
            <div class="bg-purple-600 h-1.5 rounded-full" style="width: 68%"></div>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="lg:col-span-2 bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Registration Statistics</h2>
            <select class="text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-800 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 text-gray-700 dark:text-gray-300">
                <option>Last 30 Days</option>
                <option>This Week</option>
                <option>All Time</option>
            </select>
        </div>
        <div class="relative h-72 w-full">
            <canvas id="registrationChart"></canvas>
        </div>
    </div>
    <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Stock Race Pack</h2>
            <button class="text-primary text-sm font-medium hover:underline">Details</button>
        </div>
        <div class="relative h-60 w-full flex justify-center">
            <canvas id="racePackChart"></canvas>
        </div>
        <div class="mt-4 space-y-3">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center">
                    <span class="w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                    <span class="text-gray-600 dark:text-gray-300">Size S</span>
                </div>
                <span class="font-medium text-gray-900 dark:text-white">120 Left</span>
            </div>
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center">
                    <span class="w-3 h-3 rounded-full bg-blue-400 mr-2"></span>
                    <span class="text-gray-600 dark:text-gray-300">Size M</span>
                </div>
                <span class="font-medium text-gray-900 dark:text-white">45 Left</span>
            </div>
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center">
                    <span class="w-3 h-3 rounded-full bg-blue-300 mr-2"></span>
                    <span class="text-gray-600 dark:text-gray-300">Size L</span>
                </div>
                <span class="font-medium text-gray-900 dark:text-white">88 Left</span>
            </div>
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center">
                    <span class="w-3 h-3 rounded-full bg-blue-200 mr-2"></span>
                    <span class="text-gray-600 dark:text-gray-300">Size XL</span>
                </div>
                <span class="font-medium text-gray-900 dark:text-white">200 Left</span>
            </div>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
        <div class="p-6 border-b border-border-light dark:border-border-dark flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Payment Verification Needed</h2>
            <a class="text-sm text-primary font-medium hover:underline" href="#">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-800 text-xs uppercase text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-4 font-semibold">User</th>
                        <th class="px-6 py-4 font-semibold">Category</th>
                        <th class="px-6 py-4 font-semibold">Amount</th>
                        <th class="px-6 py-4 font-semibold">Date</th>
                        <th class="px-6 py-4 font-semibold text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold mr-3">
                                    BP
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white">Budi Pratama</div>
                                    <div class="text-xs text-gray-500">ID: #TRX-8829</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                Marathon 42K
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white font-medium">
                            Rp 450.000
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs">
                            Oct 24, 2024
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button class="text-green-600 hover:text-green-800 font-medium mr-3">Approve</button>
                            <button class="text-red-600 hover:text-red-800 font-medium">Reject</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 font-bold mr-3">
                                    SA
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white">Siti Aminah</div>
                                    <div class="text-xs text-gray-500">ID: #TRX-8830</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Half Marathon 21K
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white font-medium">
                            Rp 350.000
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs">
                            Oct 24, 2024
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button class="text-green-600 hover:text-green-800 font-medium mr-3">Approve</button>
                            <button class="text-red-600 hover:text-red-800 font-medium">Reject</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 font-bold mr-3">
                                    DR
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white">Doni Ramadhan</div>
                                    <div class="text-xs text-gray-500">ID: #TRX-8832</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                10K Fun Run
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white font-medium">
                            Rp 200.000
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs">
                            Oct 23, 2024
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button class="text-green-600 hover:text-green-800 font-medium mr-3">Approve</button>
                            <button class="text-red-600 hover:text-red-800 font-medium">Reject</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">System Audit Log</h2>
            <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                <span class="material-icons-outlined">refresh</span>
            </button>
        </div>
        <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-300 before:to-transparent dark:before:via-gray-700">
            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-blue-50 dark:bg-blue-900/30 dark:border-gray-800 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                    <span class="material-icons-outlined text-sm text-blue-500">settings</span>
                </div>
                <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white dark:bg-gray-800 p-3 rounded border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center justify-between space-x-2 mb-1">
                        <div class="font-bold text-gray-900 dark:text-white text-sm">System Update</div>
                        <time class="font-mono text-xs text-gray-500">10:42 AM</time>
                    </div>
                    <div class="text-gray-500 dark:text-gray-400 text-xs">Updated `ms_biayakategori` table.</div>
                </div>
            </div>
            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-emerald-50 dark:bg-emerald-900/30 dark:border-gray-800 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                    <span class="material-icons-outlined text-sm text-emerald-500">login</span>
                </div>
                <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white dark:bg-gray-800 p-3 rounded border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center justify-between space-x-2 mb-1">
                        <div class="font-bold text-gray-900 dark:text-white text-sm">User Login</div>
                        <time class="font-mono text-xs text-gray-500">09:15 AM</time>
                    </div>
                    <div class="text-gray-500 dark:text-gray-400 text-xs">Admin `panitia_01` logged in successfully.</div>
                </div>
            </div>
            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-red-50 dark:bg-red-900/30 dark:border-gray-800 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                    <span class="material-icons-outlined text-sm text-red-500">warning</span>
                </div>
                <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white dark:bg-gray-800 p-3 rounded border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center justify-between space-x-2 mb-1">
                        <div class="font-bold text-gray-900 dark:text-white text-sm">Failed Attempt</div>
                        <time class="font-mono text-xs text-gray-500">08:30 AM</time>
                    </div>
                    <div class="text-gray-500 dark:text-gray-400 text-xs">Failed login attempt for user `guest`.</div>
                </div>
            </div>
        </div>
        <div class="mt-4 text-center">
            <a class="text-xs text-gray-500 hover:text-primary dark:text-gray-400" href="#">View complete log history</a>
        </div>
    </div>
</div>

<script>
    // Setup Charts
    document.addEventListener('DOMContentLoaded', function() {
        // Check for dark mode to adjust chart colors
        const isDark = document.documentElement.classList.contains('dark');
        const textColor = isDark ? '#E5E7EB' : '#374151';
        const gridColor = isDark ? '#374151' : '#E5E7EB';
        // Registration Chart
        const ctxReg = document.getElementById('registrationChart').getContext('2d');
        // Gradient Fill
        let gradient = ctxReg.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(37, 99, 235, 0.5)'); // Primary color
        gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');
        new Chart(ctxReg, {
            type: 'line',
            data: {
                labels: ['Oct 1', 'Oct 5', 'Oct 10', 'Oct 15', 'Oct 20', 'Oct 25'],
                datasets: [{
                    label: 'Registrations',
                    data: [150, 230, 180, 320, 290, 450],
                    borderColor: '#2563EB',
                    backgroundColor: gradient,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#2563EB',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: isDark ? '#1F2937' : '#FFFFFF',
                        titleColor: isDark ? '#F9FAFB' : '#111827',
                        bodyColor: isDark ? '#D1D5DB' : '#4B5563',
                        borderColor: isDark ? '#374151' : '#E5E7EB',
                        borderWidth: 1,
                        padding: 10,
                        displayColors: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: gridColor,
                            borderDash: [2, 4]
                        },
                        ticks: { color: textColor }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: textColor }
                    }
                }
            }
        });
        // Race Pack Chart (Doughnut)
        const ctxPack = document.getElementById('racePackChart').getContext('2d');
        new Chart(ctxPack, {
            type: 'doughnut',
            data: {
                labels: ['S', 'M', 'L', 'XL'],
                datasets: [{
                    data: [120, 45, 88, 200],
                    backgroundColor: [
                        '#3B82F6', // Blue 500
                        '#60A5FA', // Blue 400
                        '#93C5FD', // Blue 300
                        '#BFDBFE', // Blue 200
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false 
                    }
                }
            }
        });
    });
</script>
@endsection
