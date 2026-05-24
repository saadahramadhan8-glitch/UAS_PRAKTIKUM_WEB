@extends('layouts.dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-800">

            Dashboard Admin

        </h1>

        <p class="text-slate-500 mt-1">

            Monitoring seluruh aktivitas sistem PanganLokal.

        </p>

    </div>

    {{-- STATISTIC --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">

        {{-- TOTAL MAKANAN --}}
        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

            <p class="text-slate-500 text-sm mb-2">
                Total Makanan
            </p>

            <h2 class="text-4xl font-bold text-emerald-500">

                {{ $totalFoods }}

            </h2>

        </div>

        {{-- TOTAL CLAIM --}}
        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

            <p class="text-slate-500 text-sm mb-2">
                Total Claim
            </p>

            <h2 class="text-4xl font-bold text-blue-500">

                {{ $totalClaims }}

            </h2>

        </div>

        {{-- TOTAL PENYEDIA --}}
        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

            <p class="text-slate-500 text-sm mb-2">
                Total Penyedia
            </p>

            <h2 class="text-4xl font-bold text-orange-500">

                {{ $totalProviders }}

            </h2>

        </div>

        {{-- TOTAL PENERIMA --}}
        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

            <p class="text-slate-500 text-sm mb-2">
                Total Penerima
            </p>

            <h2 class="text-4xl font-bold text-pink-500">

                {{ $totalReceivers }}

            </h2>

        </div>

        {{-- CLAIM PENDING --}}
        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

            <p class="text-slate-500 text-sm mb-2">
                Claim Pending
            </p>

            <h2 class="text-4xl font-bold text-yellow-500">

                {{ $pendingClaims }}

            </h2>

        </div>

        {{-- CLAIM DISETUJUI --}}
        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

            <p class="text-slate-500 text-sm mb-2">
                Claim Disetujui
            </p>

            <h2 class="text-4xl font-bold text-emerald-500">

                {{ $approvedClaims }}

            </h2>

        </div>

    </div>

    {{-- RECENT SECTION --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

        {{-- RECENT CLAIMS --}}
        <div
            class="
                bg-white rounded-3xl
                border border-slate-200
                shadow-sm p-6
            "
        >

            <h2 class="text-2xl font-bold text-slate-800 mb-6">

                Claim Terbaru

            </h2>

            <div class="space-y-4">

                @forelse($recentClaims as $claim)

                    <div
                        class="
                            border border-slate-100
                            rounded-2xl p-4
                            flex justify-between items-center
                        "
                    >

                        <div>

                            <h3 class="font-semibold text-slate-800">

                                {{ $claim->food->title ?? 'Makanan Dihapus' }}

                            </h3>

                            <p class="text-sm text-slate-500 mt-1">

                                Oleh:
                                {{ $claim->user->name }}

                            </p>

                        </div>

                        <span
                            class="
                                px-3 py-1 rounded-full text-sm font-medium

                                @if($claim->status == 'pending')
                                    bg-yellow-100 text-yellow-700

                                @elseif($claim->status == 'disetujui')
                                    bg-emerald-100 text-emerald-700

                                @else
                                    bg-red-100 text-red-700
                                @endif
                            "
                        >

                            {{ ucfirst($claim->status) }}

                        </span>

                    </div>

                @empty

                    <p class="text-slate-500">

                        Belum ada claim terbaru.

                    </p>

                @endforelse

            </div>

        </div>

        {{-- RECENT FOODS --}}
        <div
            class="
                bg-white rounded-3xl
                border border-slate-200
                shadow-sm p-6
            "
        >

            <h2 class="text-2xl font-bold text-slate-800 mb-6">

                Makanan Terbaru

            </h2>

            <div class="space-y-4">

                @forelse($recentFoods as $food)

                    <div
                        class="
                            border border-slate-100
                            rounded-2xl p-4
                            flex justify-between items-center
                        "
                    >

                        <div>

                            <h3 class="font-semibold text-slate-800">

                                {{ $food->title }}

                            </h3>

                            <p class="text-sm text-slate-500 mt-1">

                                Stok:
                                {{ $food->quantity }}

                            </p>

                        </div>

                        <span
                            class="
                                px-3 py-1 rounded-full text-sm font-medium

                                @if($food->status == 'tersedia')
                                    bg-emerald-100 text-emerald-700

                                @elseif($food->status == 'habis')
                                    bg-red-100 text-red-700

                                @else
                                    bg-slate-100 text-slate-700
                                @endif
                            "
                        >

                            {{ ucfirst($food->status) }}

                        </span>

                    </div>

                @empty

                    <p class="text-slate-500">

                        Belum ada makanan terbaru.

                    </p>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection