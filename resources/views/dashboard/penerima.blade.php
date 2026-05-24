@extends('layouts.dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- WELCOME --}}
    <div
        class="
            bg-gradient-to-r from-emerald-500 to-emerald-600
            rounded-3xl p-8 text-white shadow-lg mb-8
        "
    >

        <h1 class="text-4xl font-bold mb-3">

            Halo, {{ auth()->user()->name }} 👋

        </h1>

        <p class="text-emerald-100 text-lg max-w-2xl">

            Temukan makanan layak konsumsi di sekitar Anda dan bantu
            mengurangi food waste bersama PanganLokal.

        </p>

    </div>

    {{-- STATISTIC --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        {{-- TOTAL CLAIM --}}
        <div
            class="
                bg-white rounded-3xl
                border border-slate-200
                shadow-sm p-6
            "
        >

            <p class="text-slate-500 text-sm mb-2">

                Total Claim Saya

            </p>

            <h2 class="text-4xl font-bold text-emerald-500">

                {{ \App\Models\Claim::where('user_id', auth()->id())->count() }}

            </h2>

        </div>

        {{-- PENDING --}}
        <div
            class="
                bg-white rounded-3xl
                border border-slate-200
                shadow-sm p-6
            "
        >

            <p class="text-slate-500 text-sm mb-2">

                Claim Pending

            </p>

            <h2 class="text-4xl font-bold text-yellow-500">

                {{ \App\Models\Claim::where('user_id', auth()->id())->where('status', 'pending')->count() }}

            </h2>

        </div>

        {{-- APPROVED --}}
        <div
            class="
                bg-white rounded-3xl
                border border-slate-200
                shadow-sm p-6
            "
        >

            <p class="text-slate-500 text-sm mb-2">

                Claim Disetujui

            </p>

            <h2 class="text-4xl font-bold text-emerald-500">

                {{ \App\Models\Claim::where('user_id', auth()->id())->where('status', 'disetujui')->count() }}

            </h2>

        </div>

        {{-- REJECTED --}}
        <div
            class="
                bg-white rounded-3xl
                border border-slate-200
                shadow-sm p-6
            "
        >

            <p class="text-slate-500 text-sm mb-2">

                Claim Ditolak

            </p>

            <h2 class="text-4xl font-bold text-red-500">

                {{ \App\Models\Claim::where('user_id', auth()->id())->where('status', 'ditolak')->count() }}

            </h2>

        </div>

    </div>

    {{-- QUICK ACTION --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

        {{-- CARI MAKANAN --}}
        <a
            href="{{ route('foods.index') }}"
            class="
                bg-white rounded-3xl border border-slate-200
                shadow-sm p-8 hover:shadow-lg transition
            "
        >

            <div class="text-5xl mb-4">
                🍱
            </div>

            <h2 class="text-2xl font-bold text-slate-800 mb-2">

                Cari Makanan

            </h2>

            <p class="text-slate-500">

                Lihat makanan yang tersedia dan lakukan claim.

            </p>

        </a>

        {{-- HISTORY CLAIM --}}
        <a
            href="{{ route('claims.my') }}"
            class="
                bg-white rounded-3xl border border-slate-200
                shadow-sm p-8 hover:shadow-lg transition
            "
        >

            <div class="text-5xl mb-4">
                📦
            </div>

            <h2 class="text-2xl font-bold text-slate-800 mb-2">

                History Claim

            </h2>

            <p class="text-slate-500">

                Lihat status claim makanan Anda.

            </p>

        </a>

    </div>

    {{-- MAKANAN TERBARU --}}
    <div
        class="
            bg-white rounded-3xl
            border border-slate-200
            shadow-sm p-8
        "
    >

        <div class="flex justify-between items-center mb-6">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">

                    Makanan Terbaru

                </h2>

                <p class="text-slate-500 mt-1">

                    Makanan terbaru yang tersedia untuk di-claim.

                </p>

            </div>

            <a
                href="{{ route('foods.index') }}"
                class="
                    bg-emerald-500 hover:bg-emerald-600
                    text-white px-5 py-3 rounded-2xl
                    transition
                "
            >
                Lihat Semua
            </a>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @foreach(
                \App\Models\Food::where('status', 'tersedia')
                    ->latest()
                    ->take(3)
                    ->get()
                as $food
            )

                <div
                    class="
                        border border-slate-200
                        rounded-3xl overflow-hidden
                        hover:shadow-lg transition
                    "
                >

                    {{-- IMAGE --}}
                    @if($food->image)

                        <img
                            src="{{ asset('storage/' . $food->image) }}"
                            class="w-full h-52 object-cover"
                        >

                    @else

                        <div
                            class="
                                w-full h-52 bg-slate-100
                                flex items-center justify-center
                                text-slate-500
                            "
                        >
                            Tidak ada gambar
                        </div>

                    @endif

                    {{-- CONTENT --}}
                    <div class="p-5">

                        <h3 class="text-xl font-bold text-slate-800 mb-2">

                            {{ $food->title }}

                        </h3>

                        <p class="text-slate-500 text-sm mb-4 line-clamp-2">

                            {{ $food->description }}

                        </p>

                        <div class="flex justify-between items-center">

                            <span
                                class="
                                    px-3 py-1 rounded-full
                                    bg-emerald-100 text-emerald-700
                                    text-sm font-medium
                                "
                            >

                                Stok: {{ $food->quantity }}

                            </span>

                            <a
                                href="{{ route('foods.show', $food->id) }}"
                                class="
                                    bg-slate-800 hover:bg-slate-900
                                    text-white px-4 py-2 rounded-xl
                                    transition
                                "
                            >
                                Detail
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

@endsection