@extends('layouts.dashboard')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">

    <div>

        <h1 class="text-3xl font-bold text-slate-800">
            Daftar Makanan
        </h1>

        <p class="text-slate-500 mt-1">
            Kelola makanan yang tersedia
        </p>

    </div>

    @if(
        auth()->user()->role === 'admin'
        ||
        auth()->user()->role === 'penyedia'
    )

        <a
            href="{{ route('foods.create') }}"
            class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-3 rounded-xl shadow transition"
        >
            + Tambah Makanan
        </a>

    @endif

</div>

{{-- FOOD LIST --}}
@if($foods->count() > 0)

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        @foreach($foods as $food)

            <div
                class="bg-white border border-slate-200 rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden"
            >

                {{-- IMAGE --}}
                @if($food->image)

                    <img
                        src="{{ asset('storage/' . $food->image) }}"
                        class="w-full h-52 object-cover"
                    >

                @else

                    <div
                        class="w-full h-52 bg-slate-100 flex items-center justify-center text-slate-500 text-sm"
                    >
                        Tidak ada gambar
                    </div>

                @endif

                {{-- CONTENT --}}
                <div class="p-5">

                    {{-- TITLE + STATUS --}}
                    <div class="flex justify-between items-start mb-3">

                        <h2 class="text-xl font-bold text-slate-800">

                            {{ $food->title }}

                        </h2>

                        <span
                            class="
                                px-3 py-1 rounded-full text-sm font-medium

                                @if($food->status == 'tersedia')
                                    bg-emerald-100 text-emerald-700

                                @elseif($food->status == 'claimed')
                                    bg-orange-100 text-orange-500

                                @else
                                    bg-red-100 text-red-500
                                @endif
                            "
                        >

                            {{ ucfirst($food->status) }}

                        </span>

                    </div>

                    {{-- DESCRIPTION --}}
                    <p class="text-slate-500 mb-4 line-clamp-3">

                        {{ $food->description }}

                    </p>

                    {{-- INFO --}}
                    <div class="space-y-2 text-sm text-slate-500 mb-5">

                        <p>

                            <span class="font-semibold text-slate-700">
                                Jumlah:
                            </span>

                            {{ $food->quantity }}

                        </p>

                        <p>

                            <span class="font-semibold text-slate-700">
                                Kadaluarsa:
                            </span>

                            {{ \Carbon\Carbon::parse($food->expired_at)->format('d M Y H:i') }}

                        </p>

                        <p>

                            <span class="font-semibold text-slate-700">
                                Alamat:
                            </span>

                            {{ $food->address }}

                        </p>

                    </div>

                    {{-- MINI LIVE MAP --}}
                    @if($food->latitude && $food->longitude)

                        <div
                            class="
                                rounded-2xl overflow-hidden
                                border border-slate-200
                                mb-5
                            "
                        >

                            <iframe
                                width="100%"
                                height="200"
                                style="border:0"
                                loading="lazy"
                                allowfullscreen
                                src="https://maps.google.com/maps?q={{ $food->latitude }},{{ $food->longitude }}&z=15&output=embed"
                            >
                            </iframe>

                        </div>

                    @endif

                    {{-- ACTION --}}
                    <div class="flex gap-2">

                        {{-- DETAIL --}}
                        <a
                            href="{{ route('foods.show', $food->id) }}"
                            class="flex-1 text-center bg-slate-700 hover:bg-slate-800 text-white py-2 rounded-xl transition"
                        >
                            Detail
                        </a>

                        {{-- ADMIN / OWNER --}}
                        @if(
                            auth()->user()->role === 'admin'
                            ||
                            auth()->user()->id === $food->user_id
                        )

                            {{-- EDIT --}}
                            <a
                                href="{{ route('foods.edit', $food->id) }}"
                                class="flex-1 text-center bg-orange-400 hover:bg-orange-500 text-white py-2 rounded-xl transition"
                            >
                                Edit
                            </a>

                        @endif

                    </div>

                    {{-- DELETE --}}
                    @if(
                        auth()->user()->role === 'admin'
                        ||
                        auth()->user()->id === $food->user_id
                    )

                        <form
                            action="{{ route('foods.destroy', $food->id) }}"
                            method="POST"
                            class="mt-3 delete-form"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-xl transition"
                            >
                                Hapus
                            </button>

                        </form>

                    @endif

                </div>

            </div>

        @endforeach

    </div>

@else

    {{-- EMPTY STATE --}}
    <div
        class="bg-white border border-slate-200 rounded-3xl shadow-sm p-14 text-center"
    >

        <div class="text-7xl mb-6">
            🍱
        </div>

        <h2 class="text-3xl font-bold text-slate-800 mb-3">

            Belum Ada Makanan

        </h2>

        <p class="text-slate-500 max-w-xl mx-auto mb-8 leading-relaxed">

            Saat ini belum ada makanan yang tersedia.

        </p>

        @if(
            auth()->user()->role === 'admin'
            ||
            auth()->user()->role === 'penyedia'
        )

            <a
                href="{{ route('foods.create') }}"
                class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-4 rounded-2xl transition shadow"
            >
                + Tambah Makanan Pertama
            </a>

        @endif

    </div>

@endif

{{-- SWEET ALERT --}}
<script>

    document.querySelectorAll('.delete-form').forEach(form => {

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            Swal.fire({

                title: 'Hapus makanan?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#64748B',

                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });

</script>

@endsection