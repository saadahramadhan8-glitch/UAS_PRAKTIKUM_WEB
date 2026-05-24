<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PanganLokal - Klaim Saya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        poppins: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        emerald: { 50: '#D1FAE5', 600: '#059669', 700: '#047857' },
                        slate: { 50: '#F8FAFC', 200: '#E2E8F0', 500: '#64748B', 800: '#1E293B' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-poppins font-bold text-emerald-600">Pangan<span class="text-slate-800">Lokal</span></span>
                </div>
                <div class="flex items-center space-x-2 font-poppins text-sm">
                    <a href="index.html" class="text-slate-500 hover:text-emerald-600 font-medium px-4 py-2 rounded-lg transition-colors">Katalog</a>
                    <a href="input-makanan.html" class="text-slate-500 hover:text-emerald-600 font-medium px-4 py-2 rounded-lg transition-colors">Donasi Makanan</a>
                    <a href="riwayat-klaim.html" class="bg-emerald-50 text-emerald-600 font-medium px-4 py-2 rounded-lg">Klaim Saya</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">
        <h2 class="text-xl font-poppins font-semibold text-slate-800 mb-6">Status Distribusi Klaim Saya</h2>

        <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                    <thead class="bg-slate-50 text-xs text-slate-500 font-poppins font-semibold uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Nama Makanan</th>
                            <th class="px-6 py-4">Jumlah Klaim</th>
                            <th class="px-6 py-4">Status Klaim</th>
                            <th class="px-6 py-4">Status Kurir</th>
                            <th class="px-6 py-4">Aksi Penerima</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200 text-slate-800">
                        <tr>
                            <td class="px-6 py-4 font-medium text-slate-800">Nasi Ayam</td>
                            <td class="px-6 py-4">2 Porsi</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">disetujui</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-600">delivering</span>
                            </td>
                            <td class="px-6 py-4">
                                <button class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs px-3 py-1.5 rounded-lg font-medium transition-colors shadow-sm">
                                    Konfirmasi Selesai
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-slate-800">Es Teh Manis</td>
                            <td class="px-6 py-4">5 Cup</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-600">pending</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-slate-500 text-xs">-</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-slate-500 text-xs italic">Menunggu Verifikasi Admin</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
