@extends('layouts.dashboard')

@section('content')

<div class="mb-8">

    <h1 class="text-3xl font-bold text-slate-800">
        Dashboard Penyedia
    </h1>

    <p class="text-slate-500 mt-1">
        Ringkasan aktivitas makanan yang kamu bagikan.
    </p>

</div>

{{-- STATISTICS --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    {{-- TOTAL --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

        <p class="text-slate-500 text-sm mb-2">
            Total Makanan
        </p>

        <h2 class="text-4xl font-bold text-slate-800">

            {{ $totalFoods }}

        </h2>

    </div>

    {{-- AVAILABLE --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

        <p class="text-slate-500 text-sm mb-2">
            Tersedia
        </p>

        <h2 class="text-4xl font-bold text-emerald-500">

            {{ $availableFoods }}

        </h2>

    </div>

    {{-- CLAIMED --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

        <p class="text-slate-500 text-sm mb-2">
            Sudah Diambil
        </p>

        <h2 class="text-4xl font-bold text-orange-400">

            {{ $claimedFoods }}

        </h2>

    </div>

    {{-- EXPIRED --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

        <p class="text-slate-500 text-sm mb-2">
            Expired
        </p>

        <h2 class="text-4xl font-bold text-red-500">

            {{ $expiredFoods }}

        </h2>

    </div>

</div>

{{-- QUICK ACTION --}}
<div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

        <div>

            <h2 class="text-2xl font-bold text-slate-800 mb-2">
                Mulai Bagikan Makanan 🍱
            </h2>

            <p class="text-slate-500">
                Tambahkan makanan baru untuk membantu penerima di sekitar.
            </p>

        </div>

        <a
            href="{{ route('foods.create') }}"
            class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-2xl transition text-center"
        >
            + Tambah Makanan
        </a>

    </div>

</div>

@endsection