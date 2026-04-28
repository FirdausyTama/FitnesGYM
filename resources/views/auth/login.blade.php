<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FitnesGYM Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logogym.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #0a0a0a; color: #fff; }
        .glass { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md p-8 glass rounded-2xl shadow-2xl">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold tracking-tighter">Fitnes<span class="text-red-600">GYM</span></h1>
            <p class="text-gray-400 mt-2">Masuk Ke Dashboard</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Username</label>
                <input type="text" name="username" required 
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition"
                    value="{{ old('username') }}">
                @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="relative group">
                <label class="block text-sm font-medium text-gray-400 mb-2">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required 
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition pr-12">
                    <button type="button" onclick="togglePassword('password', 'eye-icon')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-white transition">
                        <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="rounded border-white/10 bg-white/5 text-red-600 focus:ring-red-600">
                <label for="remember" class="ml-2 text-sm text-gray-400">Remember me</label>
            </div>

            <button type="submit" 
                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl transition transform hover:scale-[1.02]">
                MASUK
            </button>
        </form>

        <script>
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
        </script>

        <div class="mt-8 text-center">
            <a href="/" class="text-sm text-gray-500 hover:text-white transition">&larr; Back to Landing Page</a>
        </div>
    </div>
</body>
</html>
