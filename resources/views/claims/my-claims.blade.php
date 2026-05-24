@extends('layouts.dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-800">
            History Claim
        </h1>

        <p class="text-slate-500 mt-2">
            Daftar makanan yang pernah kamu claim.
        </p>

    </div>

    @if($claims->count() > 0)

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            @foreach($claims as $claim)

                <div
                    class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6"
                >

                    {{-- TITLE --}}
                    <div class="flex justify-between items-start mb-4">

                        <div>

                            <h2 class="text-2xl font-bold text-slate-800">

                                {{ $claim->food->title }}

                            </h2>

                            <p class="text-slate-500 mt-1">

                                {{ $claim->food->address }}

                            </p>

                        </div>

                        {{-- STATUS --}}
                        <span
                            class="
                                px-3 py-1 rounded-full text-sm font-semibold

                                @if($claim->status == 'pending')
                                    bg-yellow-100 text-yellow-700

                                @elseif($claim->status == 'disetujui')
                                    bg-emerald-100 text-emerald-700

                                @elseif($claim->status == 'ditolak')
                                    bg-red-100 text-red-600

                                @else
                                    bg-slate-100 text-slate-600
                                @endif
                            "
                        >

                            {{ ucfirst($claim->status) }}

                        </span>

                    </div>

                    {{-- INFO --}}
                    <div class="space-y-3 text-slate-600">

                        <p>

                            <span class="font-semibold">
                                Quantity:
                            </span>

                            {{ $claim->quantity }}

                        </p>

                        <p>

                            <span class="font-semibold">
                                Tanggal Claim:
                            </span>

                            {{ \Carbon\Carbon::parse($claim->claim_date)->format('d M Y H:i') }}

                        </p>

                        @if($claim->notes)

                            <p>

                                <span class="font-semibold">
                                    Catatan:
                                </span>

                                {{ $claim->notes }}

                            </p>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

        {{-- PAGINATION --}}
        <div class="mt-8">

            {{ $claims->links() }}

        </div>

    @else

        <div
            class="bg-white border border-slate-200 rounded-3xl shadow-sm p-14 text-center"
        >

            <div class="text-7xl mb-6">
                📦
            </div>

            <h2 class="text-3xl font-bold text-slate-800 mb-3">

                Belum Ada Claim

            </h2>

            <p class="text-slate-500">

                Kamu belum pernah melakukan claim makanan.

            </p>

        </div>

    @endif

</div>

@endsection