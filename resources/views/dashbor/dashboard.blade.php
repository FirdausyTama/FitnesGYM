<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | FitnesGYM Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logogym.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#dc2626',
                        dark: '#080808',
                        card: '#0a0a0a',
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #080808; color: #fff; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #080808;
        }
        ::-webkit-scrollbar-thumb {
            background: #dc2626;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #b91c1c;
        }
    </style>
</head>
<body class="flex h-screen overflow-x-hidden">

    @include('layouts.navbar')

    <!-- Main Content -->
    <main id="main-content" class="flex-1 md:ml-64 pt-20 flex flex-col h-screen overflow-x-hidden relative transition-all duration-300">
        <!-- Content Area -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto p-4 md:p-8 lg:p-12 relative w-full bg-[#080808]">
            <div class="max-w-[1600px] mx-auto space-y-8 relative z-10">
                
                <!-- Hero Banner -->
                <div class="bg-gradient-to-r from-red-600 to-red-900 rounded-[2rem] p-8 text-white shadow-2xl shadow-red-900/20 relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="absolute right-0 top-0 p-8 transform rotate-12 opacity-10 pointer-events-none text-white">
                        <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12,6A6,6 0 0,0 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12A6,6 0 0,0 12,6M12,8A4,4 0 0,1 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8Z"/></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-2">Fitnes<span class="text-black/50">GYM</span> Admin</h1>
                        <p class="text-red-100 text-sm md:text-base font-normal opacity-90 leading-relaxed max-w-xl">Selamat Datang Kembali, {{ Auth::user()->name }}!</p>
                    </div>

                    <div class="relative z-10 flex flex-col md:items-end gap-2">
                        <div class="text-left md:text-right">
                            <div class="text-3xl md:text-5xl font-extrabold tracking-tighter font-mono" id="realtime-clock">--:--:--</div>
                            <div class="text-red-200 text-sm font-medium mt-1 uppercase tracking-widest">{{ now()->translatedFormat('l, d F Y') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Primary KPI Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    <!-- Total Member -->
                    <div class="glass p-8 rounded-[2rem] relative overflow-hidden group hover:bg-white/5 transition-all duration-300">
                        <div class="relative z-10">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="p-4 rounded-2xl bg-red-600 text-white shadow-lg shadow-red-600/20">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-gray-500 uppercase tracking-[0.2em]">Total Member</span>
                            </div>
                            <h3 class="text-5xl font-black text-white leading-none mb-2">{{ $stats['total_members'] }}</h3>
                            <p class="text-gray-500 text-sm font-medium">Anggota terdaftar</p>
                        </div>
                    </div>

                    <!-- Member Aktif -->
                    <div class="glass p-8 rounded-[2rem] relative overflow-hidden group hover:bg-white/5 transition-all duration-300">
                        <div class="relative z-10">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="p-4 rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/20">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-gray-500 uppercase tracking-[0.2em]">Member Aktif</span>
                            </div>
                            <h3 class="text-5xl font-black text-white leading-none mb-2">{{ $stats['active_members'] }}</h3>
                            <p class="text-emerald-500 text-sm font-medium">Subscription berjalan</p>
                        </div>
                    </div>

                    <!-- Pengunjung -->
                    <div class="glass p-8 rounded-[2rem] relative overflow-hidden group hover:bg-white/5 transition-all duration-300">
                        <div class="relative z-10">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="p-4 rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-gray-500 uppercase tracking-[0.2em]">Check-In Hari Ini</span>
                            </div>
                            <h3 class="text-5xl font-black text-white leading-none mb-2">{{ $stats['today_visitors'] }}</h3>
                            <p class="text-blue-500 text-sm font-medium">Kehadiran harian</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Chart -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <!-- Recent Members Table -->
                    <div class="lg:col-span-8 glass rounded-[2rem] overflow-hidden">
                        <div class="px-8 py-6 border-b border-white/5 flex items-center justify-between">
                            <h4 class="font-bold text-white uppercase tracking-widest text-sm">Member Terbaru</h4>
                            <button class="text-[10px] font-bold text-red-600 hover:underline uppercase tracking-widest">Lihat Semua</button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-white/5 text-[10px] uppercase tracking-[0.2em] text-gray-500">
                                    <tr>
                                        <th class="px-8 py-4">Nama</th>
                                        <th class="px-8 py-4">Paket</th>
                                        <th class="px-8 py-4">Status</th>
                                        <th class="px-8 py-4">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-8 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-red-600/20 text-red-600 flex items-center justify-center font-bold text-xs">A</div>
                                                <span class="text-sm font-medium">Andi Pratama</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-4 text-sm text-gray-400">Best Deal (3 Bulan)</td>
                                        <td class="px-8 py-4">
                                            <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-bold rounded-full">AKTIF</span>
                                        </td>
                                        <td class="px-8 py-4 text-xs text-gray-500 font-mono">14:20:05</td>
                                    </tr>
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-8 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-blue-600/20 text-blue-600 flex items-center justify-center font-bold text-xs">B</div>
                                                <span class="text-sm font-medium">Budi Santoso</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-4 text-sm text-gray-400">Harian</td>
                                        <td class="px-8 py-4">
                                            <span class="px-3 py-1 bg-red-500/10 text-red-500 text-[10px] font-bold rounded-full">EXPIRED</span>
                                        </td>
                                        <td class="px-8 py-4 text-xs text-gray-500 font-mono">12:15:30</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Statistics Chart (Placeholder Style) -->
                    <div class="lg:col-span-4 glass rounded-[2rem] p-8">
                        <h4 class="font-bold text-white uppercase tracking-widest text-sm mb-8 text-center">Distribusi Paket</h4>
                        <div class="h-64 relative">
                            <canvas id="packageChart"></canvas>
                        </div>
                        <div class="mt-8 space-y-4">
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-gray-500 font-bold uppercase">Best Deal</span>
                                <span class="text-white font-mono">65%</span>
                            </div>
                            <div class="h-1 w-full bg-white/5 rounded-full overflow-hidden">
                                <div class="h-full bg-red-600 w-[65%]"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Clock functionality
            function updateClock() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                const clockElement = document.getElementById('realtime-clock');
                if(clockElement) {
                    clockElement.textContent = `${hours}:${minutes}:${seconds}`;
                }
            }
            setInterval(updateClock, 1000);
            updateClock();

            // Chart
            const ctx = document.getElementById('packageChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Harian', 'Bulanan', 'Best Deal'],
                    datasets: [{
                        data: [15, 20, 65],
                        backgroundColor: ['#3b82f6', '#10b981', '#dc2626'],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    cutout: '80%'
                }
            });
        });
    </script>
</body>
</html>
