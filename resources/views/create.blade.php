<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PanganLokal - Tambah Pangan</title>
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
                        emerald: { 500: '#10B981', 600: '#059669' },
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
                    <a href="input-makanan.html" class="bg-emerald-50 text-emerald-600 font-medium px-4 py-2 rounded-lg">Donasi Makanan</a>
                    <a href="riwayat-klaim.html" class="text-slate-500 hover:text-emerald-600 font-medium px-4 py-2 rounded-lg transition-colors">Klaim Saya</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-2xl mx-auto px-4 py-10 flex-grow w-full">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200">
            <h2 class="text-xl font-poppins font-semibold text-slate-800 mb-1">Donasikan Sisa Makanan</h2>
            <p class="text-slate-500 text-xs mb-6">Pastikan makanan yang diunggah masih dalam kondisi higienis dan layak konsumsi.</p>
            
            <form action="#" class="space-y-5 text-sm">
                <div>
                    <label class="block text-xs font-medium text-slate-800 mb-1.5">Nama Makanan (Title)</label>
                    <input type="text" placeholder="Contoh: Nasi Kotak Ayam Bakar" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-emerald-500 text-slate-800">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-800 mb-1.5">Kategori</label>
                        <select class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-emerald-500 bg-white text-slate-800">
                            <option>Nasi</option>
                            <option>Minuman</option>
                            <option>Roti</option>
                            <option>Sayur</option>
                            <option>Makanan Berat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-800 mb-1.5">Jumlah Tersedia (Porsi / Pcs)</label>
                        <input type="number" placeholder="Contoh: 5" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-emerald-500 text-slate-800">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-800 mb-1.5">Batas Waktu Layak Konsumsi (Expired At)</label>
                    <input type="datetime-local" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-emerald-500 text-slate-500">
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-800 mb-1.5">Deskripsi Singkat Kondisi Makanan</label>
                    <textarea rows="3" placeholder="Ceritakan detail makanan, misalnya: Baru dikemas 2 jam lalu dari sisa katering pesta..." class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-emerald-500 text-slate-800"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-800 mb-1.5">Alamat Lengkap Pengambilan (Pickup Address)</label>
                    <textarea rows="2" placeholder="Tulis nama jalan, nomor bangunan, atau ciri khas lokasi warung Anda..." class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-emerald-500 text-slate-800"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-800 mb-1.5">Foto Makanan Terkini</label>
                    <input type="file" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-emerald-50 file:text-emerald-600 hover:file:bg-emerald-100 transition-colors">
                </div>

                <button type="button" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-poppins font-medium py-2.5 px-4 rounded-lg transition-colors shadow-sm mt-2">
                    Simpan & Publikasikan
                </button>
            </form>
        </div>
    </main>
</body>
</html>
