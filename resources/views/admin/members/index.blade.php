<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Member - FitnesGYM Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logogym.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #080808; color: #fff; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #080808; }
        ::-webkit-scrollbar-thumb { background: #dc2626; border-radius: 10px; }
    </style>
</head>
<body class="flex h-screen overflow-x-hidden">

    @include('layouts.navbar')

    <!-- Main Content -->
    <main id="main-content" class="flex-1 md:ml-64 pt-20 flex flex-col h-screen overflow-x-hidden relative transition-all duration-300">
        <div class="flex-1 overflow-x-hidden overflow-y-auto p-4 md:p-8 lg:p-12 bg-[#080808]">
            <div class="max-w-[1600px] mx-auto space-y-8">
                
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold">Kelola Member</h2>
                        <p class="text-gray-500 text-xs md:text-sm mt-1">Daftar dan pendaftaran member baru FitnesGYM.</p>
                    </div>
                    <button onclick="openAddModal()" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-bold text-sm transition shadow-lg shadow-red-600/20 uppercase tracking-widest">
                        + Member Baru
                    </button>
                </div>

                @if(session('success'))
                    <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 p-4 rounded-2xl text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="glass rounded-[2rem] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-white/5 text-[10px] uppercase tracking-[0.2em] text-gray-500">
                                <tr>
                                    <th class="px-8 py-6">ID Member</th>
                                    <th class="px-8 py-6">Nama / User</th>
                                    <th class="px-8 py-6">Paket</th>
                                    <th class="px-8 py-6">Status</th>
                                    <th class="px-8 py-6">Masa Aktif</th>
                                    <th class="px-8 py-6">Scan Wajah</th>
                                    <th class="px-8 py-6 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($members as $member)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="px-8 py-6">
                                        <span class="text-xs font-mono font-bold text-red-500 bg-red-500/10 px-3 py-1 rounded-full uppercase">{{ $member->member_id }}</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            @if($member->face_image)
                                                <img src="{{ $member->face_image }}" class="w-10 h-10 rounded-full object-cover border-2 border-red-600/30 shadow-lg">
                                            @else
                                                <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-xs font-black text-white shadow-lg shadow-red-600/20">
                                                    {{ substr($member->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-white">{{ $member->name }}</span>
                                                <span class="text-[10px] text-gray-500 uppercase tracking-widest">{{ $member->username }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="text-xs text-gray-400">{{ $member->package_name }}</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        @if($member->expired_at >= now())
                                            <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-black rounded-full uppercase tracking-widest">Aktif</span>
                                        @else
                                            <span class="px-3 py-1 bg-red-500/10 text-red-500 text-[10px] font-black rounded-full uppercase tracking-widest">Expired</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col text-[10px]">
                                            <span class="text-gray-500 uppercase">Hingga:</span>
                                            <span class="text-white font-mono font-bold mt-0.5">{{ \Carbon\Carbon::parse($member->expired_at)->format('d/m/Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3">
                                            @if($member->face_descriptor)
                                                <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-lg shadow-emerald-500/50" title="Wajah Terdaftar"></span>
                                            @else
                                                <span class="w-2 h-2 rounded-full bg-gray-700" title="Wajah Belum Didaftarkan"></span>
                                            @endif
                                            <button onclick="openFaceModal({{ $member->id }}, '{{ $member->name }}')" class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-white transition group">
                                                <svg class="w-4 h-4 text-red-500 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                {{ $member->face_descriptor ? 'Update Wajah' : 'Daftar Wajah' }}
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            <button onclick="openDetailModal({{ $member->id }})" class="text-gray-500 hover:text-emerald-500 transition" title="Detail Member">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </button>
                                            <button onclick="openEditModal({{ $member->id }})" class="text-gray-500 hover:text-blue-500 transition" title="Edit Member">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                            <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Hapus member ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-500 hover:text-red-500 transition" title="Hapus Member">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-20 text-center text-gray-500 text-sm font-medium">Belum ada member terdaftar.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="glass w-full max-w-4xl p-8 rounded-[2rem] relative border border-white/10 shadow-2xl overflow-y-auto max-h-[90vh]">
            <button onclick="closeAddModal()" class="absolute right-6 top-6 text-gray-500 hover:text-white transition">✕</button>
            <h3 class="text-2xl font-bold mb-6">Pendaftaran Member Baru</h3>
            
            <form action="{{ route('admin.members.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Data Pribadi -->
                    <div class="space-y-6">
                        <h4 class="text-xs font-black text-red-600 uppercase tracking-[0.2em] mb-4">Informasi Akun</h4>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Nama Lengkap Member</label>
                            <input type="text" name="name" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Email</label>
                            <input type="email" name="email" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Username (Otomatis)</label>
                                <div class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-gray-400 font-mono text-sm">
                                    {{ $nextId }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Password (Otomatis)</label>
                                <div class="relative">
                                    <input type="password" id="member_pass_preview" value="fitnesgym{{ $nextId }}" readonly class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-gray-400 font-mono text-sm pr-10 focus:outline-none">
                                    <button type="button" onclick="togglePassword('member_pass_preview', 'eye-member')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-white transition">
                                        <svg id="eye-member" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <p class="text-[9px] text-gray-600 italic">* Username & Password dibuat otomatis berdasarkan ID Member.</p>
                    </div>

                    <!-- Data Membership -->
                    <div class="space-y-6">
                        <h4 class="text-xs font-black text-red-600 uppercase tracking-[0.2em] mb-4">Informasi Membership</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">ID Member</label>
                                <div class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-red-500 font-mono font-bold uppercase tracking-widest text-sm">
                                    {{ $nextId }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Pilih Paket</label>
                                <select name="package_name" id="package_select" required class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition text-sm text-white">
                                    <option value="" disabled selected>-- Pilih Paket --</option>
                                    <option value="Harian">Harian</option>
                                    <option value="1 Bulan">1 Bulan</option>
                                    <option value="3 Bulan">3 Bulan (Best Deal)</option>
                                    <option value="6 Bulan">6 Bulan</option>
                                    <option value="Personal Trainer">Personal Trainer</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Tanggal Aktif</label>
                                <input type="date" name="active_at" id="active_at" value="{{ date('Y-m-d') }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition text-sm text-white">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Durasi (Bulan)</label>
                                <input type="number" name="duration_months" id="duration_input" value="1" min="0" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition text-sm text-white">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Tanggal Habis (Otomatis)</label>
                            <div id="expiry_preview" class="w-full bg-emerald-500/5 border border-emerald-500/20 rounded-xl px-4 py-3 text-emerald-500 font-mono font-bold text-sm tracking-widest">
                                -- / -- / ----
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex gap-4">
                    <button type="button" onclick="closeAddModal()" class="flex-1 bg-white/5 hover:bg-white/10 py-4 rounded-xl font-bold transition text-xs tracking-widest">BATAL</button>
                    <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 py-4 rounded-xl font-bold transition text-xs tracking-widest shadow-lg shadow-red-600/20">DAFTARKAN MEMBER</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="glass w-full max-w-4xl p-6 md:p-8 rounded-[2rem] relative border border-white/10 shadow-2xl overflow-y-auto max-h-[90vh]">
            <button onclick="closeEditModal()" class="absolute right-6 top-6 text-gray-500 hover:text-white transition">✕</button>
            <h3 class="text-2xl font-bold mb-6">Edit Data Member</h3>
            
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Data Pribadi -->
                    <div class="space-y-6">
                        <h4 class="text-xs font-black text-red-600 uppercase tracking-[0.2em] mb-4">Informasi Akun</h4>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Nama Lengkap Member</label>
                            <input type="text" name="name" id="edit_name" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Email</label>
                            <input type="email" name="email" id="edit_email" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Password (Kosongkan jika tidak diganti)</label>
                            <input type="password" name="password" placeholder="Min. 6 karakter" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition text-sm">
                        </div>
                    </div>

                    <!-- Data Membership -->
                    <div class="space-y-6">
                        <h4 class="text-xs font-black text-red-600 uppercase tracking-[0.2em] mb-4">Informasi Membership & Wajah</h4>
                        <div id="edit_face_preview_container" class="hidden">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Foto Wajah Tersimpan</label>
                            <img id="edit_face_img" src="" class="w-32 h-32 object-cover rounded-2xl border border-white/10 mb-4">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Pilih Paket</label>
                            <select name="package_name" id="edit_package_name" required class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition text-sm text-white">
                                <option value="Harian">Harian</option>
                                <option value="1 Bulan">1 Bulan</option>
                                <option value="3 Bulan">3 Bulan</option>
                                <option value="6 Bulan">6 Bulan</option>
                                <option value="Personal Trainer">Personal Trainer</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Tanggal Aktif</label>
                                <input type="date" name="active_at" id="edit_active_at" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition text-sm text-white">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Tanggal Habis</label>
                                <input type="date" name="expired_at" id="edit_expired_at" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition text-sm text-white">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    <button type="button" onclick="closeEditModal()" class="flex-1 bg-white/5 hover:bg-white/10 py-4 rounded-xl font-bold transition text-xs tracking-widest">BATAL</button>
                    <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 py-4 rounded-xl font-bold transition text-xs tracking-widest shadow-lg shadow-red-600/20">SIMPAN PERUBAHAN</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="glass w-full max-w-2xl p-6 md:p-8 rounded-[2rem] relative border border-white/10 shadow-2xl overflow-y-auto max-h-[90vh]">
            <button onclick="closeDetailModal()" class="absolute right-6 top-6 text-gray-500 hover:text-white transition">✕</button>
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8 mb-10 text-center md:text-left">
                <div class="relative w-32 h-32 md:w-40 md:h-40 shrink-0 mx-auto md:mx-0">
                    <div id="detail_avatar" class="w-full h-full rounded-[2rem] bg-red-600 flex items-center justify-center text-5xl font-black text-white shadow-2xl shadow-red-600/20"></div>
                    <img id="detail_face_img" src="" class="absolute inset-0 w-full h-full rounded-[2rem] object-cover border-4 border-red-600 hidden shadow-2xl shadow-red-600/40">
                </div>
                <div class="flex-1 pt-2">
                    <h3 id="detail_name" class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter line-clamp-2"></h3>
                    <p id="detail_member_id" class="text-red-500 font-mono font-black tracking-[0.3em] uppercase text-lg mt-2"></p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                <div class="bg-white/5 p-6 rounded-2xl border border-white/5">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Email</p>
                    <p id="detail_email" class="text-sm font-medium text-white"></p>
                </div>
                <div class="bg-white/5 p-6 rounded-2xl border border-white/5">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Username</p>
                    <p id="detail_username" class="text-sm font-mono text-white"></p>
                </div>
                <div class="bg-white/5 p-6 rounded-2xl border border-white/5">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Paket</p>
                    <p id="detail_package" class="text-sm font-bold text-white"></p>
                </div>
                <div class="bg-white/5 p-6 rounded-2xl border border-white/5">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Status</p>
                    <p id="detail_status" class="text-sm font-black uppercase tracking-widest"></p>
                </div>
                <div class="bg-white/5 p-6 rounded-2xl border border-white/5">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Tanggal Aktif</p>
                    <p id="detail_active" class="text-sm font-mono text-white"></p>
                </div>
                <div class="bg-white/5 p-6 rounded-2xl border border-white/5">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Masa Aktif</p>
                    <p id="detail_expiry" class="text-sm font-mono text-white"></p>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-white/5 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div id="detail_face_indicator" class="w-3 h-3 rounded-full"></div>
                    <span id="detail_face_text" class="text-[10px] font-bold uppercase tracking-widest"></span>
                </div>
                <button onclick="closeDetailModal()" class="bg-white/5 hover:bg-white/10 px-8 py-3 rounded-xl font-bold transition text-xs tracking-widest">TUTUP</button>
            </div>
        </div>
    </div>

    <!-- Face Registration Modal -->
    <div id="faceModal" class="fixed inset-0 bg-black/90 backdrop-blur-md z-50 hidden flex items-center justify-center p-4">
        <div class="glass w-full max-w-xl p-8 rounded-[2rem] relative border border-white/10 shadow-2xl text-center">
            <button onclick="closeFaceModal()" class="absolute right-6 top-6 text-gray-500 hover:text-white transition">✕</button>
            <h3 class="text-2xl font-bold mb-2">Daftarkan Wajah</h3>
            <p id="face_member_name" class="text-red-500 font-bold uppercase tracking-widest text-sm mb-6"></p>
            
            <div class="relative mx-auto w-full max-w-sm aspect-square bg-black rounded-3xl overflow-hidden border-2 border-white/5 mb-6 shadow-2xl">
                <video id="video" autoplay muted playsinline class="w-full h-full object-cover"></video>
                <canvas id="overlay" class="absolute inset-0 w-full h-full"></canvas>
                
                <!-- Camera Switch Button -->
                <button onclick="toggleCamera()" class="absolute top-4 right-4 z-20 bg-black/50 hover:bg-black/80 text-white p-3 rounded-full backdrop-blur-md border border-white/10 transition-all active:scale-95 group">
                    <svg class="w-4 h-4 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </button>

                <div id="face_loader" class="absolute inset-0 flex items-center justify-center bg-black/50">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-8 h-8 border-4 border-red-600 border-t-transparent rounded-full animate-spin"></div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-white">Inisialisasi Kamera...</p>
                    </div>
                </div>
            </div>

            <div id="face_status" class="text-xs font-medium text-gray-400 mb-6">Posisikan wajah Anda di tengah kamera.</div>

            <button id="btn_capture" onclick="captureFace()" disabled class="w-full bg-red-600 disabled:bg-gray-800 disabled:text-gray-500 hover:bg-red-700 text-white py-4 rounded-xl font-bold transition text-xs tracking-widest shadow-lg shadow-red-600/20 uppercase">
                Ambil Data Wajah
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api/dist/face-api.js"></script>
    <script>
        let currentMemberId = null;
        let isModelsLoaded = false;
        let videoStream = null;
        let currentFacingMode = 'user';

        async function initFaceApi() {
            if (isModelsLoaded) return;
            // Menggunakan URL raw github yang lebih stabil
            const MODEL_URL = 'https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights';
            
            try {
                console.log('Loading FaceAPI Models...');
                await faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL);
                await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
                await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);
                isModelsLoaded = true;
                console.log('FaceAPI Models Loaded Successfully');
            } catch (err) {
                console.error('FaceAPI Error:', err);
                alert('Gagal memuat AI: ' + err.message + '. Pastikan koneksi internet stabil.');
            }
        }

        async function openFaceModal(id, name) {
            currentMemberId = id;
            document.getElementById('face_member_name').innerText = name;
            document.getElementById('faceModal').classList.remove('hidden');
            document.getElementById('face_loader').classList.remove('hidden');
            document.getElementById('btn_capture').disabled = true;

            await initFaceApi();
            if (isModelsLoaded) {
                startCamera();
            } else {
                closeFaceModal();
            }
        }

        function startCamera() {
            if (videoStream) {
                videoStream.getTracks().forEach(track => track.stop());
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
                    video.srcObject = stream;
                    videoStream = stream;

                    // Mirror only for 'user' camera
                    if (currentFacingMode === 'user') {
                        video.classList.add('scale-x-[-1]');
                    } else {
                        video.classList.remove('scale-x-[-1]');
                    }

                    video.onloadedmetadata = () => {
                        document.getElementById('face_loader').classList.add('hidden');
                        detectFace();
                    };
                })
                .catch(err => {
                    console.error('Camera Error:', err);
                    if (currentFacingMode === 'environment') {
                        console.log('Falling back to user camera...');
                        currentFacingMode = 'user';
                        startCamera();
                    } else {
                        alert('Gagal mengakses kamera: ' + err.message);
                        closeFaceModal();
                    }
                });
        }

        function toggleCamera() {
            currentFacingMode = currentFacingMode === 'user' ? 'environment' : 'user';
            document.getElementById('face_loader').classList.remove('hidden');
            startCamera();
        }

        async function detectFace() {
            const video = document.getElementById('video');
            const status = document.getElementById('face_status');
            const btn = document.getElementById('btn_capture');

            if (!isModelsLoaded || video.paused || video.ended) return;

            try {
                const detection = await faceapi.detectSingleFace(video, new faceapi.TinyFaceDetectorOptions({ inputSize: 224, scoreThreshold: 0.6 })).withFaceLandmarks().withFaceDescriptor();

                if (detection) {
                    status.innerText = "Wajah Terdeteksi! Siap didaftarkan.";
                    status.classList.replace('text-gray-400', 'text-emerald-500');
                    btn.disabled = false;
                    window.lastDescriptor = detection.descriptor;
                } else {
                    status.innerText = "Mencari wajah... Pastikan wajah terlihat jelas.";
                    status.classList.replace('text-emerald-500', 'text-gray-400');
                    btn.disabled = true;
                }
            } catch (err) {
                console.error('Detection Loop Error:', err);
            }

            if (!document.getElementById('faceModal').classList.contains('hidden')) {
                requestAnimationFrame(detectFace);
            }
        }

        async function captureFace() {
            if (!window.lastDescriptor) return;

            const video = document.getElementById('video');
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');
            
            if (currentFacingMode === 'user') {
                ctx.translate(canvas.width, 0);
                ctx.scale(-1, 1);
            }
            
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const faceImage = canvas.toDataURL('image/jpeg', 0.8);

            const btn = document.getElementById('btn_capture');
            btn.innerText = "MENYIMPAN...";
            btn.disabled = true;

            const descriptorStr = JSON.stringify(Array.from(window.lastDescriptor));

            try {
                const response = await fetch(`/admin/members/${currentMemberId}/face`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        face_descriptor: descriptorStr,
                        face_image: faceImage
                    })
                });

                const result = await response.json();
                if (result.success) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert('Gagal menyimpan data wajah.');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan saat menyimpan data.');
            } finally {
                btn.innerText = "AMBIL DATA WAJAH";
                btn.disabled = false;
            }
        }

        function closeFaceModal() {
            document.getElementById('faceModal').classList.add('hidden');
            if (videoStream) {
                videoStream.getTracks().forEach(track => track.stop());
            }
        }

        async function openDetailModal(id) {
            try {
                const response = await fetch(`/admin/members/${id}`);
                const member = await response.json();
                
                document.getElementById('detail_avatar').innerText = member.name.charAt(0).toUpperCase();
                document.getElementById('detail_name').innerText = member.name;
                document.getElementById('detail_member_id').innerText = member.member_id;
                document.getElementById('detail_email').innerText = member.email;
                document.getElementById('detail_username').innerText = member.username;
                document.getElementById('detail_package').innerText = member.package_name;
                document.getElementById('detail_active').innerText = new Date(member.active_at).toLocaleDateString('id-ID');
                document.getElementById('detail_expiry').innerText = new Date(member.expired_at).toLocaleDateString('id-ID');
                
                const faceImg = document.getElementById('detail_face_img');
                const avatar = document.getElementById('detail_avatar');
                
                if (member.face_image && member.face_image.startsWith('data:image')) {
                    faceImg.src = member.face_image;
                    faceImg.classList.remove('hidden');
                    avatar.classList.add('hidden');
                } else {
                    faceImg.classList.add('hidden');
                    avatar.classList.remove('hidden');
                }

                const status = document.getElementById('detail_status');
                const isExpired = new Date(member.expired_at) < new Date();
                status.innerText = isExpired ? 'Expired' : 'Aktif';
                status.className = isExpired ? 'text-red-500' : 'text-emerald-500';

                const faceInd = document.getElementById('detail_face_indicator');
                const faceText = document.getElementById('detail_face_text');
                if (member.face_descriptor) {
                    faceInd.className = 'w-3 h-3 rounded-full bg-emerald-500';
                    faceText.innerText = 'Wajah Terdaftar';
                    faceText.className = 'text-[10px] font-bold uppercase tracking-widest text-emerald-500';
                } else {
                    faceInd.className = 'w-3 h-3 rounded-full bg-gray-600';
                    faceText.innerText = 'Wajah Belum Terdaftar';
                    faceText.className = 'text-[10px] font-bold uppercase tracking-widest text-gray-500';
                }

                document.getElementById('detailModal').classList.remove('hidden');
            } catch (err) {
                console.error(err);
                alert('Gagal mengambil data member.');
            }
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        async function openEditModal(id) {
            try {
                const response = await fetch(`/admin/members/${id}`);
                const member = await response.json();
                
                document.getElementById('edit_name').value = member.name;
                document.getElementById('edit_email').value = member.email;
                document.getElementById('edit_package_name').value = member.package_name;
                document.getElementById('edit_active_at').value = member.active_at.split(' ')[0];
                document.getElementById('edit_expired_at').value = member.expired_at.split(' ')[0];
                
                const facePreview = document.getElementById('edit_face_preview_container');
                const faceImg = document.getElementById('edit_face_img');
                if (member.face_image) {
                    faceImg.src = member.face_image;
                    facePreview.classList.remove('hidden');
                } else {
                    facePreview.classList.add('hidden');
                }

                document.getElementById('editForm').action = `/admin/members/${id}`;
                document.getElementById('editModal').classList.remove('hidden');
            } catch (err) {
                console.error(err);
                alert('Gagal mengambil data member.');
            }
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
            updateExpiryDate();
        }
        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }

        function updateExpiryDate() {
            const activeAt = document.getElementById('active_at').value;
            const duration = parseInt(document.getElementById('duration_input').value) || 0;
            const preview = document.getElementById('expiry_preview');

            if (activeAt) {
                let date = new Date(activeAt);
                date.setMonth(date.getMonth() + duration);
                
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = date.getFullYear();
                
                preview.innerText = `${day} / ${month} / ${year}`;
            }
        }

        // Auto-set duration based on package
        document.getElementById('package_select').addEventListener('change', function() {
            const durationInput = document.getElementById('duration_input');
            const packageName = this.value;

            if (packageName === 'Harian') {
                durationInput.value = 0;
                durationInput.readOnly = true;
            } else if (packageName === '1 Bulan') {
                durationInput.value = 1;
                durationInput.readOnly = true;
            } else if (packageName === '3 Bulan') {
                durationInput.value = 3;
                durationInput.readOnly = true;
            } else if (packageName === '6 Bulan') {
                durationInput.value = 6;
                durationInput.readOnly = true;
            } else {
                durationInput.value = 1;
                durationInput.readOnly = false;
            }
            updateExpiryDate();
        });

        document.getElementById('active_at').addEventListener('change', updateExpiryDate);
        document.getElementById('duration_input').addEventListener('input', updateExpiryDate);
    </script>
</body>
</html>
