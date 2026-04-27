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
            <p class="text-gray-400 mt-2">Admin Portal Access</p>
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

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Password</label>
                <input type="password" name="password" required 
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-600 transition">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="rounded border-white/10 bg-white/5 text-red-600 focus:ring-red-600">
                <label for="remember" class="ml-2 text-sm text-gray-400">Remember me</label>
            </div>

            <button type="submit" 
                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-xl transition transform hover:scale-[1.02]">
                LOG IN
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="/" class="text-sm text-gray-500 hover:text-white transition">&larr; Back to Landing Page</a>
        </div>
    </div>
</body>
</html>
