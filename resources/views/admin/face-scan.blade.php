<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Face Scan Entry - FitnesGYM</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logogym.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #080808; color: #fff; min-h-screen; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .scan-line {
            position: absolute;
            width: 100%;
            height: 2px;
            background: #dc2626;
            box-shadow: 0 0 15px #dc2626;
            top: 0;
            animation: scan 3s linear infinite;
        }
        @keyframes scan {
            0% { top: 0; }
            100% { top: 100%; }
        }
        .success-glow { box-shadow: 0 0 50px rgba(16, 185, 129, 0.2); border-color: #10b981; }
        .error-glow { box-shadow: 0 0 50px rgba(220, 38, 38, 0.2); border-color: #dc2626; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(220, 38, 38, 0.3); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(220, 38, 38, 0.5); }
    </style>
</head>
<body class="bg-[#080808] text-white min-h-screen overflow-x-hidden">
    <div class="p-4 md:p-8 lg:p-12">
        <div class="max-w-[1600px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
        
        <!-- Left: Scanner -->
        <div class="lg:col-span-4 sticky top-0 lg:top-12 z-30 bg-[#080808] lg:bg-transparent py-4 lg:py-0 -mx-4 px-4 lg:mx-0 lg:px-0 space-y-6">
            <!-- Combined Header: Title & Time -->
            <div class="glass p-4 md:p-5 rounded-[1.5rem] bg-gradient-to-r from-red-600/10 via-transparent to-transparent border-red-600/5 flex items-center justify-between gap-2">
                <div>
                    <h1 class="text-lg md:text-xl font-black uppercase tracking-tighter leading-none">Fitnes <span class="text-red-600">GYM</span></h1>
                    <p class="text-[8px] text-gray-500 font-bold uppercase tracking-widest mt-1">Face Recognition</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl md:text-3xl font-black tracking-tighter font-mono text-white leading-none" id="realtime-clock">00:00:00</div>
                    <div id="realtime-date" class="text-[8px] md:text-[10px] font-bold text-red-500 uppercase tracking-widest mt-1">--/--/--</div>
                </div>
            </div>

            <div id="scanner_box" class="relative aspect-square bg-white/5 rounded-[2.5rem] border-2 border-white/10 overflow-hidden transition-all duration-500 shadow-2xl">
                <video id="video" autoplay muted playsinline class="w-full h-full object-cover"></video>
                <div id="scan_line" class="scan-line"></div>
                
                <!-- Camera Switch Button -->
                <button onclick="toggleCamera()" class="absolute top-4 right-4 z-20 bg-black/50 hover:bg-black/80 text-white p-3 rounded-full backdrop-blur-md border border-white/10 transition-all active:scale-95 group">
                    <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </button>
                
                <div id="loader" class="absolute inset-0 bg-black/80 flex flex-col items-center justify-center gap-4">
                    <div class="w-10 h-10 border-4 border-red-600 border-t-transparent rounded-full animate-spin"></div>
                    <p class="text-xs font-bold uppercase tracking-widest text-white">Loading Models...</p>
                </div>

                <div id="result_overlay" class="absolute inset-0 hidden flex flex-col items-center justify-center p-8 bg-black/60 backdrop-blur-sm transition-all animate-fade">
                    <div id="result_icon" class="w-20 h-20 rounded-full flex items-center justify-center mb-4"></div>
                    <h2 id="result_title" class="text-3xl font-black uppercase tracking-tight text-center"></h2>
                    <p id="result_name" class="text-xl font-bold text-red-500 text-center mt-1 uppercase"></p>
                    <p id="result_message" class="text-sm text-gray-300 text-center mt-2"></p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 gap-4">
                <button id="btn_start_scan" onclick="startScan()" class="bg-emerald-600 hover:bg-emerald-700 py-5 rounded-2xl font-black text-sm uppercase tracking-[0.2em] transition-all shadow-lg shadow-emerald-600/20 flex items-center justify-center gap-3">
                    <span class="w-3 h-3 bg-white rounded-full animate-pulse"></span>
                    Mulai Scan Wajah
                </button>
                <button id="btn_stop_scan" onclick="stopScan()" class="hidden bg-red-600/10 hover:bg-red-600 text-red-600 hover:text-white py-5 rounded-2xl font-black text-sm uppercase tracking-[0.2em] transition-all border border-red-600/20 flex items-center justify-center gap-3">
                    <span class="w-3 h-3 bg-current rounded-full"></span>
                    Berhenti Scan
                </button>
            </div>
            
            <div class="flex justify-between items-center px-4">
                <p id="status_text" class="text-xs font-bold text-gray-500 uppercase tracking-widest">Inisialisasi Sistem...</p>
                <a href="{{ route('admin.dashboard') }}" class="text-[10px] text-gray-500 hover:text-white uppercase tracking-widest underline font-bold">Kembali</a>
            </div>
        </div>

        <!-- Right: Today's Attendance List -->
        <div class="lg:col-span-8 space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white">Log Aktivitas Member</h2>
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">Kehadiran & Durasi Latihan Hari Ini</p>
                </div>
                <div class="flex items-center gap-4">
                    <form action="{{ route('admin.attendance.clear') }}" method="POST" onsubmit="return confirm('Hapus semua history hari ini?')">
                        @csrf
                        <button type="submit" class="bg-white/5 hover:bg-red-600/20 text-gray-500 hover:text-red-500 p-2 rounded-lg transition-all" title="Bersihkan History">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                    <div class="bg-red-600 px-4 py-2 rounded-xl text-white text-xs font-black uppercase tracking-widest shadow-lg shadow-red-600/20">
                        {{ count($todayAttendances) }} Check-ins
                    </div>
                </div>
            </div>

            <div class="glass rounded-[2.5rem] overflow-hidden flex flex-col h-[500px] lg:h-[calc(100vh-180px)]">
                <div class="flex-1 overflow-y-auto overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-white/5 text-[10px] uppercase tracking-[0.2em] text-gray-500">
                            <tr>
                                <th class="px-6 py-5">Member</th>
                                <th class="px-6 py-5">Status / Paket</th>
                                <th class="px-6 py-5">Waktu Check-in</th>
                                <th class="px-6 py-5">Check-out / Durasi</th>
                                <th class="px-6 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($todayAttendances as $attendance)
                            <tr class="hover:bg-white/5 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        @if($attendance->user->face_image)
                                            <img src="{{ $attendance->user->face_image }}" class="w-10 h-10 rounded-full object-cover border border-red-600/30">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-xs font-black text-white">
                                                {{ substr($attendance->user->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-white">{{ $attendance->user->name }}</span>
                                            <span class="text-[9px] text-gray-500 font-mono tracking-widest">{{ $attendance->user->member_id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col gap-1">
                                        @if($attendance->user->expired_at >= now())
                                            <span class="text-[9px] font-black text-emerald-500 uppercase">Aktif</span>
                                        @else
                                            <span class="text-[9px] font-black text-red-500 uppercase">Expired</span>
                                        @endif
                                        <span class="text-[10px] text-gray-400 font-medium">Hingga: {{ \Carbon\Carbon::parse($attendance->user->expired_at)->format('d/m/Y') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-white">{{ $attendance->created_at->timezone('Asia/Jakarta')->format('H:i') }} <span class="text-[10px] text-gray-500">WIB</span></span>
                                        <span class="text-[9px] text-gray-500 uppercase font-bold tracking-widest">Masuk</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    @if($attendance->check_out_at)
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-emerald-500">{{ $attendance->check_out_at->timezone('Asia/Jakarta')->format('H:i') }}</span>
                                            <span class="text-[10px] font-bold text-white bg-white/10 px-2 py-0.5 rounded-md inline-block w-fit mt-1">{{ $attendance->duration }}</span>
                                        </div>
                                    @else
                                        <span class="text-[10px] font-black text-blue-500 uppercase animate-pulse">Latihan...</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-right">
                                    @if(!$attendance->check_out_at)
                                        <form action="{{ route('admin.attendance.checkout', $attendance->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-blue-600/10 hover:bg-blue-600 text-blue-500 hover:text-white px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">
                                                Cekout
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[10px] font-black text-gray-600 uppercase tracking-widest">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center gap-3 opacity-30">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <p class="text-xs font-bold uppercase tracking-widest">Belum ada aktivitas hari ini</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api/dist/face-api.js"></script>
    <script>
        const members = {!! json_encode($members) !!};
        let faceMatcher = null;
        let isScanning = false;
        let isProcessing = false;
        let isModelsLoaded = false;
        let currentFacingMode = 'user';
        let currentStream = null;

        function startScan(save = true) {
            if (!isModelsLoaded) {
                if (save) alert("Mohon tunggu hingga model AI selesai dimuat.");
                return;
            }
            isScanning = true;
            if (save) localStorage.setItem('scanner_active', 'true');
            const btnStart = document.getElementById('btn_start_scan');
            const btnStop = document.getElementById('btn_stop_scan');
            const statusText = document.getElementById('status_text');
            const scanLine = document.getElementById('scan_line');

            if (btnStart) btnStart.classList.add('hidden');
            if (btnStop) btnStop.classList.remove('hidden');
            if (statusText) statusText.innerText = "Scanner Aktif. Mencari Wajah...";
            if (scanLine) scanLine.classList.remove('hidden');
        }

        function stopScan() {
            isScanning = false;
            localStorage.setItem('scanner_active', 'false');
            const btnStart = document.getElementById('btn_start_scan');
            const btnStop = document.getElementById('btn_stop_scan');
            const statusText = document.getElementById('status_text');
            const scanLine = document.getElementById('scan_line');

            if (btnStart) btnStart.classList.remove('hidden');
            if (btnStop) btnStop.classList.add('hidden');
            if (statusText) statusText.innerText = "Scanner Berhenti.";
            if (scanLine) scanLine.classList.add('hidden');
        }

        async function init() {
            const status = document.getElementById('status_text');
            
            if (typeof faceapi === 'undefined') {
                status.innerText = "Error: Library FaceAPI tidak termuat.";
                return;
            }

            const MODEL_URL = 'https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights';
            
            try {
                status.innerText = "1/3 Memuat Model AI...";
                console.log('Loading FaceAPI Models...');
                await Promise.all([
                    faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL),
                    faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
                    faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL)
                ]);

                status.innerText = "2/3 Memproses Data Member...";
                console.log('Processing Member Data...', members.length, 'members found');

                // Create Labeled Face Descriptors
                const labeledDescriptors = members.map(m => {
                    if (!m.face_descriptor) return null;
                    try {
                        const descriptor = new Float32Array(JSON.parse(m.face_descriptor));
                        return new faceapi.LabeledFaceDescriptors(m.id.toString(), [descriptor]);
                    } catch (e) {
                        console.error('Descriptor error for member:', m.id, e);
                        return null;
                    }
                }).filter(ld => ld !== null);

                console.log('Valid Labeled Descriptors:', labeledDescriptors.length);

                if (labeledDescriptors.length > 0) {
                    faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.4); // Threshold diperketat ke 0.4
                } else {
                    console.warn('Tidak ada data wajah member yang ditemukan di database.');
                    status.innerText = "Peringatan: Belum ada member terdaftar wajah.";
                }

                status.innerText = "3/3 Membuka Kamera...";
                isModelsLoaded = true;
                const loader = document.getElementById('loader');
                if (loader) loader.classList.add('hidden');
                status.innerText = "Sistem Siap. Menunggu Wajah...";
                startCamera();

                // Restore Scanner State
                if (localStorage.getItem('scanner_active') === 'true') {
                    startScan(false);
                }
            } catch (err) {
                console.error('FaceAPI Init Error:', err);
                status.innerText = "Gagal Memuat AI. Cek Koneksi.";
                alert('Gagal memuat AI: ' + err.message);
            }
        }

        function startCamera() {
            if (currentStream) {
                currentStream.getTracks().forEach(track => track.stop());
            }

            const video = document.getElementById('video');
            const constraints = {
                video: {
                    facingMode: currentFacingMode,
                    width: { ideal: 640 },
                    height: { ideal: 480 }
                }
            };

            navigator.mediaDevices.getUserMedia(constraints)
                .then(stream => {
                    currentStream = stream;
                    video.srcObject = stream;
                    
                    // Mirror only for 'user' camera
                    if (currentFacingMode === 'user') {
                        video.classList.add('scale-x-[-1]');
                    } else {
                        video.classList.remove('scale-x-[-1]');
                    }

                    video.onloadedmetadata = () => {
                        requestAnimationFrame(detect);
                    };
                })
                .catch(err => {
                    console.error('Camera Error:', err);
                    const status = document.getElementById('status_text');
                    status.innerText = "Error Kamera: " + err.message;
                    if (currentFacingMode === 'environment') {
                        console.log('Falling back to user camera...');
                        currentFacingMode = 'user';
                        startCamera();
                    }
                });
        }

        function toggleCamera() {
            currentFacingMode = currentFacingMode === 'user' ? 'environment' : 'user';
            const status = document.getElementById('status_text');
            status.innerText = "Menukar Kamera...";
            startCamera();
        }

        async function detect() {
            if (!isModelsLoaded || !isScanning || isProcessing) {
                requestAnimationFrame(detect);
                return;
            }

            const video = document.getElementById('video');
            if (video.paused || video.ended) {
                requestAnimationFrame(detect);
                return;
            }

            try {
                const detection = await faceapi.detectSingleFace(video, new faceapi.TinyFaceDetectorOptions({ inputSize: 224, scoreThreshold: 0.5 })).withFaceLandmarks().withFaceDescriptor();

                if (detection && faceMatcher) {
                    const result = faceMatcher.findBestMatch(detection.descriptor);
                    console.log('Match Result:', result.toString()); // Debugging
                    
                    if (result.label !== 'unknown') {
                        handleMatch(result.label);
                    } else {
                        isProcessing = true;
                        showResult({
                            success: false,
                            message: 'Wajah tidak dikenali atau belum terdaftar.',
                            user: null
                        });
                    }
                }
            } catch (err) {
                console.error('Detection Error:', err);
            }

            requestAnimationFrame(detect);
        }

        async function handleMatch(userId) {
            isProcessing = true;
            document.getElementById('status_text').innerText = "Wajah Dikenali! Memverifikasi...";

            try {
                const response = await fetch('/admin/face-verify', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ user_id: userId })
                });

                const data = await response.json();
                showResult(data);
            } catch (err) {
                console.error(err);
                isProcessing = false;
            }
        }

        function showResult(data) {
            const box = document.getElementById('scanner_box');
            const overlay = document.getElementById('result_overlay');
            const icon = document.getElementById('result_icon');
            const title = document.getElementById('result_title');
            const nameDisplay = document.getElementById('result_name');
            const msg = document.getElementById('result_message');

            if (overlay) overlay.classList.remove('hidden');
            
            if (data.success) {
                if (box) box.classList.add('success-glow');
                if (icon) {
                    icon.innerHTML = '<svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                    icon.className = "w-20 h-20 rounded-full flex items-center justify-center mb-4 bg-emerald-500 shadow-lg shadow-emerald-500/50";
                }
                if (title) {
                    title.innerText = "AKSES DITERIMA";
                    title.className = "text-3xl font-black uppercase tracking-tight text-center text-emerald-500";
                }
            } else {
                if (box) box.classList.add('error-glow');
                if (icon) {
                    icon.innerHTML = '<svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
                    icon.className = "w-20 h-20 rounded-full flex items-center justify-center mb-4 bg-red-600 shadow-lg shadow-red-500/50";
                }
                if (title) {
                    title.innerText = "AKSES DITOLAK";
                    title.className = "text-3xl font-black uppercase tracking-tight text-center text-red-500";
                }
            }

            if (data.user) {
                if (nameDisplay) {
                    nameDisplay.innerText = data.user.name;
                    nameDisplay.classList.remove('hidden');
                }
            } else {
                if (nameDisplay) nameDisplay.classList.add('hidden');
            }

            if (msg) msg.innerText = data.message;

            setTimeout(() => {
                if (overlay) overlay.classList.add('hidden');
                if (box) box.classList.remove('success-glow', 'error-glow');
                isProcessing = false;
                const statusEl = document.getElementById('status_text');
                if (statusEl) statusEl.innerText = "Sistem Siap. Menunggu Wajah...";
                if (data.success) {
                    location.reload(); // Reload to update History list
                }
            }, 3000);
        }

        function updateClock() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            
            const dayName = days[now.getDay()];
            const day = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();
            
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            const clockElement = document.getElementById('realtime-clock');
            const dateElement = document.getElementById('realtime-date');
            
            if(clockElement) clockElement.textContent = `${hours}:${minutes}:${seconds}`;
            if(dateElement) dateElement.textContent = `${dayName}, ${day} ${monthName} ${year}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        init();
    </script>
        </div>
    </div>
</body>
</html>
