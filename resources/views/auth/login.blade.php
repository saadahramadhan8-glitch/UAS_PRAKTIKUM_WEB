<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PanganLokal</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50">

<div class="min-h-screen flex items-center justify-center px-6">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-md">

        <!-- HEADER -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-emerald-600">🌿 PanganLokal</h1>
            <p class="text-sm text-slate-500 mt-1">Login ke sistem</p>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- EMAIL -->
            <div>
                <label class="text-sm font-medium">Email</label>
                <input type="email" name="email"
                       class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none"
                       placeholder="email@domain.com" required>
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="text-sm font-medium">Password</label>
                <input type="password" name="password"
                       class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none"
                       placeholder="••••••••" required>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="w-full bg-emerald-600 text-white py-3 rounded-lg hover:bg-emerald-700 transition">
                Login
            </button>
        </form>

        <!-- FOOTER -->
        <p class="text-center text-sm text-slate-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-emerald-600 font-semibold hover:underline">
                Register
            </a>
        </p>

        <p class="text-center text-xs text-slate-400 mt-6">
            © PanganLokal System
        </p>

    </div>

</div>

</body>
</html>