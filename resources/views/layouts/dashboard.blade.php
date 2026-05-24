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

        {{-- SIDEBAR --}}
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

            {{-- LOGO --}}
            <div
                class="p-6 border-b border-slate-200 flex items-center justify-between"
            >

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

            </div>

            {{-- MENU --}}
            <nav class="flex-1 p-4 space-y-2">

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
                >
                    Daftar Makanan
                </a>

                {{-- HISTORY CLAIM --}}
                @if(auth()->user()->role === 'penerima')

                    <a
                        href="{{ route('claims.my') }}"
                        class="
                            block px-4 py-3 rounded-xl transition font-medium

                            {{ request()->is('my-claims')
                                ? 'bg-emerald-500 text-white shadow'
                                : 'text-slate-700 hover:bg-emerald-50 hover:text-emerald-600'
                            }}
                        "
                    >
                        History Claim
                    </a>

                @endif

                {{-- CLAIM MASUK --}}
                @if(auth()->user()->role === 'penyedia')

                    <a
                        href="{{ route('claims.incoming') }}"
                        class="
                            block px-4 py-3 rounded-xl transition font-medium

                            {{ request()->is('incoming-claims')
                                ? 'bg-emerald-500 text-white shadow'
                                : 'text-slate-700 hover:bg-emerald-50 hover:text-emerald-600'
                            }}
                        "
                    >
                        Claim Masuk
                    </a>

                @endif

                {{-- ADMIN & PENYEDIA --}}
                @if(
                    auth()->user()->role === 'admin'
                    ||
                    auth()->user()->role === 'penyedia'
                )

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

                @endif

            </nav>

            {{-- LOGOUT --}}
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

        {{-- MAIN --}}
        <div class="flex-1 flex flex-col w-full">

            {{-- NAVBAR --}}
            <header
                class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center"
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

                {{-- USER --}}
                <a
                    href="{{ route('profile.edit') }}"
                    class="
                        flex items-center gap-4
                        hover:bg-slate-100
                        px-4 py-2 rounded-2xl
                        transition
                    "
                >

                    <div class="text-right hidden sm:block">

                        <p class="font-semibold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-sm text-slate-500">
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                    {{-- AVATAR --}}
                    <div
                        class="
                            w-11 h-11 rounded-full
                            bg-emerald-500 text-white
                            flex items-center justify-center
                            font-bold text-lg shadow
                        "
                    >

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>

                </a>

            </header>

            {{-- CONTENT --}}
            <main class="flex-1 p-6">

                @yield('content')

            </main>

        </div>

    </div>

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