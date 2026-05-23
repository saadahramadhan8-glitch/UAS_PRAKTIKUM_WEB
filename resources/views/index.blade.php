<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PanganLokal - Dashboard Penerima</title>
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
                    <a href="index.html" class="bg-emerald-50 text-emerald-600 font-medium px-4 py-2 rounded-lg">Katalog</a>
                    <a href="input-makanan.html" class="text-slate-500 hover:text-emerald-600 font-medium px-4 py-2 rounded-lg transition-colors">Donasi Makanan</a>
                    <a href="riwayat-klaim.html" class="text-slate-500 hover:text-emerald-600 font-medium px-4 py-2 rounded-lg transition-colors">Klaim Saya</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-white border-b border-slate-200 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-poppins font-bold text-slate-800 sm:text-4xl tracking-tight">
                Selamatkan Pangan, <span class="text-emerald-600">Bantu Sesama</span>
            </h1>
            <p class="mt-3 text-base text-slate-500 max-w-xl mx-auto">
                Cari dan klaim makanan layak konsumsi yang didonasikan oleh mitra warung dan restoran di sekitarmu.
            </p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">
        <div class="flex flex-col sm:flex-row gap-4 mb-8 justify-between items-center">
            <h2 class="text-xl font-poppins font-semibold text-slate-800 w-full sm:w-auto">Rekomendasi Makanan Tersedia</h2>
            <div class="flex gap-3 w-full sm:w-auto">
                <input type="text" placeholder="Cari makanan..." class="w-full sm:w-64 px-4 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:border-emerald-500 bg-white">
                <select class="px-3 py-2 text-sm border border-slate-200 rounded-lg bg-white text-slate-500">
                    <option>Semua Kategori</option>
                    <option>Nasi</option>
                    <option>Roti</option>
                    <option>Minuman</option>
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-all duration-200">
                <img src="https://images.unsplash.com/photo-1626132647523-66f5bf380027?auto=format&fit=crop&w=600&q=80" alt="Nasi Ayam" class="w-full h-48 object-cover">
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-poppins font-semibold text-slate-800">Nasi Ayam</h3>
                        <span class="bg-emerald-50 text-emerald-600 text-xs px-2.5 py-1 rounded-full font-medium">tersedia</span>
                    </div>
                    <p class="text-slate-500 text-xs line-clamp-2 mb-4">Nasi kotak komplit dengan lauk ayam goreng renyah dan lalapan segar bumbu berkah.</p>
                    <div class="border-t border-slate-100 pt-3 space-y-2 text-xs text-slate-500">
                        <p><strong class="text-slate-800">Sisa Stok:</strong> 10 Porsi</p>
                        <p><strong class="text-slate-800">Batas Waktu:</strong> Hari ini, 21:00 WITA</p>
                        <p><strong class="text-slate-800">Alamat Toko:</strong> Restoran Ayam Berkah</p>
                    </div>
                    <button class="mt-5 w-full bg-emerald-600 hover:bg-emerald-700 text-white font-poppins font-medium text-sm py-2 px-4 rounded-lg transition-colors shadow-sm">
                        Lihat Detail & Klaim
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-all duration-200">
                <img src="https://images.unsplash.com/photo-1607958996333-41aef7caefaa?auto=format&fit=crop&w=600&q=80" alt="Roti Coklat" class="w-full h-48 object-cover">
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-poppins font-semibold text-slate-800">Roti Coklat</h3>
                        <span class="bg-emerald-50 text-emerald-600 text-xs px-2.5 py-1 rounded-full font-medium">tersedia</span>
                    </div>
                    <p class="text-slate-500 text-xs line-clamp-2 mb-4">Roti manis bertekstur lembut dengan isian cokelat lumer berkualitas premium.</p>
                    <div class="border-t border-slate-100 pt-3 space-y-2 text-xs text-slate-500">
                        <p><strong class="text-slate-800">Sisa Stok:</strong> 20 Pcs</p>
                        <p><strong class="text-slate-800">Batas Waktu:</strong> Besok, 12:00 WITA</p>
                        <p><strong class="text-slate-800">Alamat Toko:</strong> Bakery Rasa Sayang</p>
                    </div>
                    <button class="mt-5 w-full bg-emerald-600 hover:bg-emerald-700 text-white font-poppins font-medium text-sm py-2 px-4 rounded-lg transition-colors shadow-sm">
                        Lihat Detail & Klaim
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-all duration-200">
                <img src="https://images.unsplash.com/photo-1556679343-c7306c1976bc?auto=format&fit=crop&w=600&q=80" alt="Es Teh Manis" class="w-full h-48 object-cover">
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-poppins font-semibold text-slate-800">Es Teh Manis</h3>
                        <span class="bg-emerald-50 text-emerald-600 text-xs px-2.5 py-1 rounded-full font-medium">tersedia</span>
                    </div>
                    <p class="text-slate-500 text-xs line-clamp-2 mb-4">Minuman segar es teh manis tradisional dikemas rapat dalam gelas plastik press sealed.</p>
                    <div class="border-t border-slate-100 pt-3 space-y-2 text-xs text-slate-500">
                        <p><strong class="text-slate-800">Sisa Stok:</strong> 15 Cup</p>
                        <p><strong class="text-slate-800">Batas Waktu:</strong> Hari ini, 18:00 WITA</p>
                        <p><strong class="text-slate-800">Alamat Toko:</strong> Warung Pojok</p>
                    </div>
                    <button class="mt-5 w-full bg-emerald-600 hover:bg-emerald-700 text-white font-poppins font-medium text-sm py-2 px-4 rounded-lg transition-colors shadow-sm">
                        Lihat Detail & Klaim
                    </button>
                </div>
            </div>

        </div>
    </main>
</body>
</html>
