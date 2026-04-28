<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 hidden md:hidden transition-opacity"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-[#0a0a0a] shadow-xl flex flex-col h-full z-30 -translate-x-full md:translate-x-0 transition-transform duration-300 border-r border-white/5">
    <div class="h-20 flex items-center px-8 border-b border-white/5">
        <h1 class="text-2xl font-extrabold tracking-tighter text-white">Fitnes<span class="text-red-600">GYM</span></h1>
    </div>
    
    <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Dashboard
        </a>
        <a href="{{ route('admin.face-scan') }}" class="{{ request()->routeIs('admin.face-scan') ? 'bg-red-600 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
            Face Scan Entry
        </a>
        <a href="{{ route('admin.members.index') }}" class="{{ request()->routeIs('admin.members.*') ? 'bg-red-600 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            Kelola Member
        </a>
        <a href="#" class="text-gray-400 hover:bg-white/5 hover:text-white flex items-center gap-3 px-4 py-3 rounded-xl transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            Paket & Harga
        </a>
        <a href="#" class="text-gray-400 hover:bg-white/5 hover:text-white flex items-center gap-3 px-4 py-3 rounded-xl transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065zM15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            Setting
        </a>
    </nav>
    
    <div class="p-4 border-t border-white/5">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-red-500 hover:bg-red-500/10 rounded-xl transition-colors text-sm font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                KELUAR PANEL
            </button>
        </form>
    </div>
</aside>

<!-- Topbar -->
<header id="topbar" class="fixed top-0 left-0 right-0 md:left-64 h-20 bg-[#0a0a0a]/80 backdrop-blur-md border-b border-white/5 flex items-center justify-between px-8 z-20 transition-all duration-300">
    <div class="flex items-center gap-4">
        <!-- Sidebar Toggle Button -->
        <button id="sidebar-toggle-btn" class="p-2 text-gray-400 hover:text-white focus:outline-none rounded-lg hover:bg-white/5 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
        <h2 class="text-xl font-bold text-white">
            <span class="md:hidden">Dashboard</span>
            <span class="hidden md:inline">Dashboard Overview</span>
        </h2>
    </div>
    <div class="flex items-center gap-4">
        <div class="hidden md:block text-right">
            <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
            <p class="text-[10px] text-gray-500 uppercase tracking-widest">{{ Auth::user()->role }}</p>
        </div>
        <div class="w-10 h-10 rounded-full bg-red-600 text-white flex items-center justify-center font-bold shadow-lg shadow-red-600/20">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggleBtn = document.getElementById('sidebar-toggle-btn');
        const mainContent = document.getElementById('main-content');
        const topbar = document.getElementById('topbar');

        if (!sidebar || !toggleBtn) return;

        function toggleSidebar() {
            const isMobile = window.innerWidth < 768;
            
            if (isMobile) {
                sidebar.classList.toggle('-translate-x-full');
                if (overlay) overlay.classList.toggle('hidden');
            } else {
                sidebar.classList.toggle('md:-translate-x-full');
                sidebar.classList.toggle('md:translate-x-0');
                
                if (mainContent) {
                    mainContent.classList.toggle('md:ml-64');
                    mainContent.classList.toggle('md:ml-0');
                }
                if (topbar) {
                    topbar.classList.toggle('md:left-64');
                    topbar.classList.toggle('md:left-0');
                }
            }
        }

        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSidebar();
        });

        if (overlay) {
            overlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }
    });
</script>
