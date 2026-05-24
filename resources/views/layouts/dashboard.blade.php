<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PanganLokal</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-50 text-slate-800">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white border-r border-slate-200 flex flex-col">

            <!-- LOGO -->
            <div class="p-6 border-b border-slate-200">

                <h1 class="text-2xl font-bold text-emerald-500">
                    PanganLokal
                </h1>

                <p class="text-sm text-slate-500 mt-1 capitalize">
                    {{ auth()->user()->role }}
                </p>

            </div>

            <!-- MENU -->
            <nav class="flex-1 p-4 space-y-2">

                <a
                    href="/dashboard"
                    class="block px-4 py-3 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-emerald-600 transition font-medium"
                >
                    Dashboard
                </a>

                <a
                    href="/foods"
                    class="block px-4 py-3 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-emerald-600 transition font-medium"
                >
                    Daftar Makanan
                </a>

                <a
                    href="/foods/create"
                    class="block px-4 py-3 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-emerald-600 transition font-medium"
                >
                    Tambah Makanan
                </a>

            </nav>

            <!-- LOGOUT -->
            <div class="p-4 border-t border-slate-200">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl transition font-medium"
                    >
                        Logout
                    </button>

                </form>

            </div>

        </aside>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col">

            <!-- NAVBAR -->
            <header class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center">

                <div>

                    <h2 class="text-2xl font-bold text-slate-800">
                        Dashboard
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Selamat datang kembali 👋
                    </p>

                </div>

                <!-- USER -->
                <div class="flex items-center gap-3">

                    <div class="text-right">

                        <p class="font-semibold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-sm text-slate-500">
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                    <!-- AVATAR -->
                    <div
                        class="w-11 h-11 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-lg shadow"
                    >
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                </div>

            </header>

            <!-- CONTENT -->
            <main class="flex-1 p-6">

                @yield('content')

            </main>

        </div>

    </div>

</body>
</html>