<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PanganLokal</title>

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
            <p class="text-sm text-slate-500 mt-1">Buat akun baru</p>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- NAME -->
            <div>
                <label class="text-sm font-medium">Nama</label>
                <input type="text" name="name"
                       class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none"
                       placeholder="Nama lengkap" required>
            </div>

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

            <!-- CONFIRM PASSWORD -->
            <div>
                <label class="text-sm font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none"
                       placeholder="••••••••" required>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="w-full bg-emerald-600 text-white py-3 rounded-lg hover:bg-emerald-700 transition">
                Register
            </button>
        </form>

        <!-- FOOTER -->
        <p class="text-center text-sm text-slate-500 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-emerald-600 font-semibold hover:underline">
                Login
            </a>
        </p>

        <p class="text-center text-xs text-slate-400 mt-3">
            © PanganLokal System
        </p>

    </div>

</div>

</body>
</html>