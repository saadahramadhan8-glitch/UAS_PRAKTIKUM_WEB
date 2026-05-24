@extends('layouts.dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-800">

            Claim Masuk

        </h1>

        <p class="text-slate-500 mt-1">

            Daftar claim makanan dari penerima.

        </p>

    </div>

    {{-- CLAIM LIST --}}
    @if($claims->count() > 0)

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @foreach($claims as $claim)

                <div
                    class="
                        bg-white border border-slate-200
                        rounded-3xl shadow-sm
                        overflow-hidden
                    "
                >

                    {{-- IMAGE --}}
                    @if($claim->food && $claim->food->image)

                        <img
                            src="{{ asset('storage/' . $claim->food->image) }}"
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

                        {{-- TITLE --}}
                        <h2 class="text-xl font-bold text-slate-800 mb-3">

                            {{ $claim->food->title ?? 'Makanan Dihapus' }}

                        </h2>

                        {{-- STATUS --}}
                        <span
                            class="
                                inline-block px-3 py-1 rounded-full
                                text-sm font-medium mb-4

                                @if($claim->status == 'pending')
                                    bg-yellow-100 text-yellow-700

                                @elseif($claim->status == 'disetujui')
                                    bg-emerald-100 text-emerald-700

                                @elseif($claim->status == 'ditolak')
                                    bg-red-100 text-red-700

                                @else
                                    bg-slate-100 text-slate-700
                                @endif
                            "
                        >

                            {{ ucfirst($claim->status) }}

                        </span>

                        {{-- INFO --}}
                        <div class="space-y-2 text-sm text-slate-600">

                            <p>

                                <span class="font-semibold text-slate-800">
                                    Penerima:
                                </span>

                                {{ $claim->user->name }}

                            </p>

                            <p>

                                <span class="font-semibold text-slate-800">
                                    Quantity:
                                </span>

                                {{ $claim->quantity }}

                            </p>

                            <p>

                                <span class="font-semibold text-slate-800">
                                    Tanggal Claim:
                                </span>

                                {{ \Carbon\Carbon::parse($claim->claim_date)->format('d M Y H:i') }}

                            </p>

                            @if($claim->notes)

                                <p>

                                    <span class="font-semibold text-slate-800">
                                        Catatan:
                                    </span>

                                    {{ $claim->notes }}

                                </p>

                            @endif

                        </div>

                        {{-- ACTION --}}
                        @if($claim->status == 'pending')

                            <div class="flex gap-3 mt-5">

                                {{-- APPROVE --}}
                                <form
                                    action="{{ route('claims.approve', $claim->id) }}"
                                    method="POST"
                                    class="flex-1"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="
                                            w-full bg-emerald-500
                                            hover:bg-emerald-600
                                            text-white py-3 rounded-2xl
                                            transition
                                        "
                                    >
                                        Setujui
                                    </button>

                                </form>

                                {{-- REJECT --}}
                                <form
                                    action="{{ route('claims.reject', $claim->id) }}"
                                    method="POST"
                                    class="flex-1"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="
                                            w-full bg-red-500
                                            hover:bg-red-600
                                            text-white py-3 rounded-2xl
                                            transition
                                        "
                                    >
                                        Tolak
                                    </button>

                                </form>

                            </div>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

        {{-- PAGINATION --}}
        <div class="mt-10">

            {{ $claims->links() }}

        </div>

    @else

        {{-- EMPTY STATE --}}
        <div
            class="
                bg-white border border-slate-200
                rounded-3xl shadow-sm
                p-14 text-center
            "
        >

            <div class="text-7xl mb-6">
                📦
            </div>

            <h2 class="text-3xl font-bold text-slate-800 mb-3">

                Belum Ada Claim

            </h2>

            <p class="text-slate-500 max-w-xl mx-auto">

                Saat ini belum ada claim masuk.

            </p>

        </div>

    @endif

</div>

@endsection