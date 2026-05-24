<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PanganLokal</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white shadow-lg">

            <div class="p-6 border-b">

                <h1 class="text-2xl font-bold text-green-600">
                    PanganLokal
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    {{ auth()->user()->role }}
                </p>

            </div>

            <nav class="p-4 space-y-2">

                <a
                    href="/dashboard"
                    class="block px-4 py-3 rounded-lg hover:bg-green-100 transition"
                >
                    Dashboard
                </a>

                <a
                    href="/foods"
                    class="block px-4 py-3 rounded-lg hover:bg-green-100 transition"
                >
                    Daftar Makanan
                </a>

                <a
                    href="/foods/create"
                    class="block px-4 py-3 rounded-lg hover:bg-green-100 transition"
                >
                    Tambah Makanan
                </a>

            </nav>

            <div class="p-4 mt-auto">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg transition"
                    >
                        Logout
                    </button>

                </form>

            </div>

        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col">

            <!-- NAVBAR -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">

                <h2 class="text-xl font-semibold text-gray-700">
                    Dashboard
                </h2>

                <div class="flex items-center gap-3">

                    <div class="text-right">

                        <p class="font-medium">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                    <div
                        class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center font-bold"
                    >
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                </div>

            </header>

            <!-- CONTENT -->
            <main class="p-6">

                @yield('content')

            </main>

        </div>

    </div>

</body>
</html>