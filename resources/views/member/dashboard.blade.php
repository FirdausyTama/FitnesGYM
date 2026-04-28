<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member Dashboard - FitnesGYM</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logogym.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #080808; color: #fff; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .card-gradient { background: linear-gradient(135deg, #dc2626 0%, #7f1d1d 100%); }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8 flex items-center justify-center bg-[#080808]">

    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-extrabold tracking-tighter">Fitnes<span class="text-red-600">GYM</span></h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs font-bold text-gray-500 hover:text-red-500 uppercase tracking-widest transition">Keluar</button>
            </form>
        </div>

        <!-- Digital Card -->
        <div class="card-gradient p-8 rounded-[2rem] shadow-2xl shadow-red-900/40 relative overflow-hidden">
            <div class="absolute right-0 bottom-0 p-8 transform rotate-12 opacity-10 pointer-events-none">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12,6A6,6 0 0,0 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12A6,6 0 0,0 12,6M12,8A4,4 0 0,1 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8Z"/></svg>
            </div>
            
            <div class="relative z-10 flex flex-col h-48 justify-between">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] opacity-60">Digital Member Pass</p>
                    <h2 class="text-2xl font-bold mt-2">{{ Auth::user()->name }}</h2>
                    <p class="text-xs font-mono opacity-80 mt-1 uppercase">{{ Auth::user()->member_id }}</p>
                </div>
                
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest opacity-60">Paket</p>
                        <p class="text-sm font-bold">{{ Auth::user()->package_name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-bold uppercase tracking-widest opacity-60">Masa Aktif</p>
                        <p class="text-sm font-bold">{{ \Carbon\Carbon::parse(Auth::user()->expired_at)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Info -->
        <div class="glass p-6 rounded-2xl flex items-center justify-between">
            <div class="flex items-center gap-4">
                @if(Auth::user()->expired_at >= now())
                    <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></div>
                    <div>
                        <p class="text-xs font-bold text-white uppercase tracking-widest">Status: Aktif</p>
                        <p class="text-[10px] text-emerald-500 font-medium">Anda memiliki akses penuh ke Gym.</p>
                    </div>
                @else
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <div>
                        <p class="text-xs font-bold text-white uppercase tracking-widest">Status: Expired</p>
                        <p class="text-[10px] text-red-500 font-medium">Silakan perpanjang paket Anda.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="text-center">
            <p class="text-[10px] text-gray-600 uppercase tracking-widest">Tunjukkan kartu digital ini kepada petugas di resepsionis.</p>
        </div>
    </div>

</body>
</html>
