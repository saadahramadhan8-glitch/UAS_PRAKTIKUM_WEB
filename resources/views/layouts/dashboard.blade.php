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

        {{-- MOBILE OVERLAY --}}
        <div
            id="sidebarOverlay"
            class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"
            onclick="closeSidebar()"
        ></div>

        <!-- SIDEBAR -->

        <aside
            id="sidebar"
            class="
                fixed lg:static
                top-0 left-0
                w-64 h-screen
                bg-white border-r border-slate-200
                flex flex-col
                z-50
                transform -translate-x-full
                lg:translate-x-0
                transition-transform duration-300
            "
        >

            <!-- LOGO -->
            <div class="p-6 border-b border-slate-200 flex items-center justify-between">

        <aside class="w-64 bg-white shadow-lg flex flex-col">

            <!-- LOGO -->
            <div class="p-6 border-b">

                <div>


                    <h1 class="text-2xl font-bold text-emerald-500">
                        PanganLokal
                    </h1>

                    <p class="text-sm text-slate-500 mt-1 capitalize">
                        {{ auth()->user()->role }}
                    </p>

                </div>

                {{-- CLOSE BUTTON MOBILE --}}
                <button
                    onclick="closeSidebar()"
                    class="lg:hidden text-slate-500 text-2xl"
                >
                    ✕
                </button>
                <p class="text-sm text-gray-500 mt-1 capitalize">
                    {{ auth()->user()->role }}
                </p>

            </div>

            <!-- MENU -->
            <nav class="flex-1 p-4 space-y-2">

            <nav class="p-4 space-y-2 flex-1">

                {{-- DASHBOARD --}}
                <a
                    href="/dashboard"

                    class="
                        block px-4 py-3 rounded-xl transition font-medium

                        {{ request()->is('dashboard') || request()->is('*dashboard')
                            ? 'bg-emerald-500 text-white shadow'
                            : 'text-slate-700 hover:bg-emerald-50 hover:text-emerald-600'
                        }}
                    "

                    class="block px-4 py-3 rounded-xl hover:bg-green-100 hover:text-green-700 transition"

                >
                    Dashboard
                </a>

                {{-- DAFTAR MAKANAN --}}
                <a
                    href="/foods"
                    class="
                        block px-4 py-3 rounded-xl transition font-medium

                        {{ request()->is('foods') || request()->is('foods/*')
                            ? 'bg-emerald-500 text-white shadow'
                            : 'text-slate-700 hover:bg-emerald-50 hover:text-emerald-600'
                        }}
                    "

                {{-- FOOD LIST --}}
                <a
                    href="/foods"
                    class="block px-4 py-3 rounded-xl hover:bg-green-100 hover:text-green-700 transition"
                >
                    Daftar Makanan
                </a>

                {{-- TAMBAH MAKANAN --}}
                <a
                    href="/foods/create"
                    class="
                        block px-4 py-3 rounded-xl transition font-medium

                        {{ request()->is('foods/create')
                            ? 'bg-emerald-500 text-white shadow'
                            : 'text-slate-700 hover:bg-emerald-50 hover:text-emerald-600'
                        }}
                    "
                >
                    Tambah Makanan
                </a>

                {{-- ONLY ADMIN & PENYEDIA --}}
                @if(
                    auth()->user()->role === 'admin'
                    ||
                    auth()->user()->role === 'penyedia'
                )

                    <a
                        href="/foods/create"
                        class="block px-4 py-3 rounded-xl hover:bg-green-100 hover:text-green-700 transition"
                    >
                        Tambah Makanan
                    </a>

                @endif

            </nav>

            <!-- LOGOUT -->

            <div class="p-4 border-t border-slate-200">

            <div class="p-4 border-t">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl transition font-medium"

                        class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl transition shadow-md"

                    >
                        Logout
                    </button>

                </form>

            </div>

        </aside>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col w-full">

            <!-- NAVBAR -->
            <header class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center">

            <header
                class="bg-white shadow px-6 py-4 flex justify-between items-center"
            >

                <div class="flex items-center gap-4">

                    {{-- HAMBURGER --}}
                    <button
                        onclick="openSidebar()"
                        class="lg:hidden text-3xl text-slate-700"
                    >
                        ☰
                    </button>

                    <div>

                        <h2 class="text-2xl font-bold text-slate-800">
                            Dashboard
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Selamat datang kembali 👋
                        </p>

                    </div>

                </div>

                <!-- USER -->
                <div class="flex items-center gap-3">

                <!-- USER INFO -->
                <div class="flex items-center gap-4">

                    <div class="text-right hidden sm:block">

                        <p class="font-semibold text-slate-800">

                        <p class="font-semibold text-gray-800">

                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-sm text-slate-500">
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                    <!-- AVATAR -->
                    <div

                        class="w-11 h-11 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-lg shadow"

                        class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center font-bold shadow"
                    >
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                </div>

            </header>

            <!-- CONTENT -->
            <main class="flex-1 p-6">
            <!-- PAGE CONTENT -->
            <main class="p-6">

                @yield('content')

            </main>

        </div>

    </div>

    {{-- TOAST SUCCESS --}}
    @if(session('success'))

        <script>

            Swal.fire({

                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true

            });

        </script>

    @endif

    {{-- SIDEBAR SCRIPT --}}
    <script>

        function openSidebar()
        {
            document.getElementById('sidebar')
                .classList.remove('-translate-x-full');

            document.getElementById('sidebarOverlay')
                .classList.remove('hidden');
        }

        function closeSidebar()
        {
            document.getElementById('sidebar')
                .classList.add('-translate-x-full');

            document.getElementById('sidebarOverlay')
                .classList.add('hidden');
        }

    </script>

</body>
</html>