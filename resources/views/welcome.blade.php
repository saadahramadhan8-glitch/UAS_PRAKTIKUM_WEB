<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PanganLokal</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">

<!-- NAVBAR -->
<header class="flex justify-between items-center px-6 py-4 bg-white shadow-sm">
    <h1 class="text-xl font-bold text-emerald-600">🌿 PanganLokal</h1>

    <div class="space-x-4 text-sm">
        <a href="/" class="hover:text-emerald-600">Home</a>
        <a href="#" class="hover:text-emerald-600">About</a>
        <a href="{{ route('login') }}" class="text-emerald-600 font-semibold">Login</a>
    </div>
</header>

<!-- HERO -->
<section class="text-center py-20 px-6">
    <h2 class="text-3xl md:text-5xl font-bold leading-tight">
        Selamatkan Makanan, <br> Kurangi Limbah
    </h2>

    <p class="mt-4 text-slate-500 max-w-xl mx-auto">
        PanganLokal adalah platform yang menghubungkan penyedia makanan berlebih
        dengan penerima yang membutuhkan secara cepat dan efisien.
    </p>

    <div class="mt-6 space-x-3">
        <a href="{{ route('register') }}"
           class="bg-emerald-600 text-white px-6 py-3 rounded-lg shadow hover:bg-emerald-700">
            Mulai Sekarang
        </a>

    </div>
</section>

<!-- FEATURES -->
<section id="fitur" class="grid md:grid-cols-3 gap-6 px-6 pb-20 max-w-6xl mx-auto">

    <div class="bg-white p-6 rounded-xl shadow-sm">
        <h3 class="font-semibold text-lg text-emerald-600">🍱 Food Sharing</h3>
        <p class="text-sm text-slate-500 mt-2">
            Penyedia dapat mengupload makanan berlebih dengan mudah.
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm">
        <h3 class="font-semibold text-lg text-emerald-600">🤝 Klaim Cepat</h3>
        <p class="text-sm text-slate-500 mt-2">
            Penerima bisa langsung mengklaim makanan yang tersedia.
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm">
        <h3 class="font-semibold text-lg text-emerald-600">🚚 Pengantaran</h3>
        <p class="text-sm text-slate-500 mt-2">
            Makanan bisa dikirimkan melalui kurir.
        </p>
    </div>

</section>

<!-- FOOTER -->
<footer class="text-center py-6 text-sm text-slate-400">
    © {{ date('Y') }} PanganLokal — Sistem Food Rescue
</footer>

</body>
</html>