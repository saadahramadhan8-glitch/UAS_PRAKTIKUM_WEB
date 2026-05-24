<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Dashboard' }}</title>

</head>
<body>

    <header style="padding:15px; border-bottom:1px solid #ccc;">

        <h2>PanganLokal</h2>

        <p>
            Login sebagai:
            {{ auth()->user()->role }}
        </p>

    </header>

    <div style="display:flex; min-height:100vh;">

        <!-- SIDEBAR -->
        <aside
            style="
                width:250px;
                border-right:1px solid #ccc;
                padding:20px;
            "
        >

            <h3>Menu</h3>

            <ul>

                <li>
                    <a href="/dashboard">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="/foods">
                        Daftar Makanan
                    </a>
                </li>

                <li>
                    <a href="/foods/create">
                        Tambah Makanan
                    </a>
                </li>

            </ul>

            <br>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit">
                    Logout
                </button>
            </form>

        </aside>

        <!-- CONTENT -->
        <main style="padding:20px; flex:1;">

            @yield('content')

        </main>

    </div>

</body>
</html>