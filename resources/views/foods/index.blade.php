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

    <a
        href="{{ route('foods.create') }}"
        class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-3 rounded-xl shadow transition"
    >
        + Tambah Makanan
    </a>

</div>

{{-- FILTER --}}
<div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-5 mb-6">

    <form
        method="GET"
        action="{{ route('foods.index') }}"
        class="grid grid-cols-1 md:grid-cols-3 gap-4"
    >

        {{-- SEARCH --}}
        <div>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari makanan..."
                class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >
    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Daftar Makanan
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola dan lihat daftar makanan tersedia
            </p>

        </div>

        @if(
            auth()->user()->role === 'admin'
            ||
            auth()->user()->role === 'penyedia'
        )

            <a
                href="{{ route('foods.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-lg shadow transition"
            >
                + Tambah Makanan
            </a>

        @endif

    </div>

    {{-- Flash Message --}}
    @if(session('success'))

        <div
            class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6"
        >
            {{ session('success') }}
        </div>

    @endif

    {{-- Food List --}}
    @forelse($foods as $food)

        <div
            class="bg-white rounded-2xl shadow-md overflow-hidden mb-6"
        >

            <div class="md:flex">

                {{-- IMAGE --}}
                <div class="md:w-1/3">

                    @if($food->image)

                        <img
                            src="{{ asset('storage/' . $food->image) }}"
                            class="w-full h-full object-cover"
                        >

                    @else

                        <div
                            class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-500"
                        >
                            Tidak ada gambar
                        </div>

                    @endif

                </div>

                {{-- CONTENT --}}
                <div class="p-6 flex-1">

                    <div class="flex items-start justify-between">

                        <div>

                            <h2 class="text-2xl font-bold text-gray-800">
                                {{ $food->title }}
                            </h2>

                            <p class="text-gray-500 mt-2">
                                {{ $food->description }}
                            </p>

                        </div>

                        <span
                            class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full"
                        >
                            {{ $food->status }}
                        </span>

                    </div>

                    <div class="mt-4 space-y-2 text-gray-600">

                        <p>
                            <span class="font-semibold">
                                Jumlah:
                            </span>

                            {{ $food->quantity }}
                        </p>

                        <p>
                            <span class="font-semibold">
                                Kadaluarsa:
                            </span>

                            {{ $food->expired_at }}
                        </p>

                    </div>

                    {{-- ACTION BUTTON --}}
                    <div class="mt-6 flex flex-wrap gap-3">

                        {{-- DETAIL --}}
                        <a
                            href="{{ route('foods.show', $food->id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition"
                        >
                            Detail
                        </a>

                        {{-- EDIT & DELETE --}}
                        @if(
                            auth()->user()->role === 'admin'
                            ||
                            auth()->user()->id === $food->user_id
                        )

                            <a
                                href="{{ route('foods.edit', $food->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('foods.destroy', $food->id) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition"
                                >
                                    Hapus
                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        {{-- STATUS --}}
        <div>

            <select
                name="status"
                class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >
        <div
            class="bg-white rounded-2xl shadow-md p-10 text-center"
        >

            <h2 class="text-2xl font-bold text-gray-700">
                Belum Ada Makanan
            </h2>

            <p class="text-gray-500 mt-2">
                Silakan tambahkan makanan terlebih dahulu
            </p>

        </div>

                <option value="">
                    Semua Status
                </option>

                <option
                    value="available"
                    {{ request('status') == 'available' ? 'selected' : '' }}
                >
                    Available
                </option>

                <option
                    value="claimed"
                    {{ request('status') == 'claimed' ? 'selected' : '' }}
                >
                    Claimed
                </option>

                <option
                    value="expired"
                    {{ request('status') == 'expired' ? 'selected' : '' }}
                >
                    Expired
                </option>

            </select>

        </div>

        {{-- BUTTON --}}
        <div class="flex gap-3">

            <button
                type="submit"
                class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition"
            >
                Filter
            </button>

            <a
                href="{{ route('foods.index') }}"
                class="flex-1 border border-slate-200 text-slate-600 rounded-xl flex items-center justify-center hover:bg-slate-100 transition"
            >
                Reset
            </a>

        </div>

    </form>

</div>

{{-- FOOD LIST --}}
@if($foods->count() > 0)

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        @foreach($foods as $food)

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden">

                {{-- IMAGE --}}
                @if($food->image)

                    <img
                        src="{{ asset('storage/' . $food->image) }}"
                        class="w-full h-52 object-cover"
                    >

                @else

                    <div class="w-full h-52 bg-slate-100 flex items-center justify-center text-slate-500 text-sm">

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

                        <span class="
                            px-3 py-1 rounded-full text-sm font-medium

                            @if($food->status == 'available')
                                bg-emerald-100 text-emerald-700

                            @elseif($food->status == 'claimed')
                                bg-orange-100 text-orange-500

                            @else
                                bg-red-100 text-red-500
                            @endif
                        ">

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

                            {{ $food->expired_at }}

                        </p>

                    </div>

                    {{-- ACTION --}}
                    <div class="flex gap-2">

                        <a
                            href="{{ route('foods.show', $food->id) }}"
                            class="flex-1 text-center bg-slate-700 hover:bg-slate-800 text-white py-2 rounded-xl transition"
                        >
                            Detail
                        </a>

                        <a
                            href="{{ route('foods.edit', $food->id) }}"
                            class="flex-1 text-center bg-orange-400 hover:bg-orange-500 text-white py-2 rounded-xl transition"
                        >
                            Edit
                        </a>

                    </div>

                    {{-- DELETE --}}
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

                </div>

            </div>

        @endforeach

    </div>

    {{-- PAGINATION --}}
    <div class="mt-8">

        {{ $foods->links() }}

    </div>

@else

    {{-- EMPTY STATE --}}
    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-14 text-center">

        {{-- ICON --}}
        <div class="text-7xl mb-6">
            🍱
        </div>

        {{-- TITLE --}}
        <h2 class="text-3xl font-bold text-slate-800 mb-3">

            Belum Ada Makanan

        </h2>

        {{-- DESCRIPTION --}}
        <p class="text-slate-500 max-w-xl mx-auto mb-8 leading-relaxed">

            Saat ini belum ada makanan yang tersedia.
            Mulailah berbagi makanan untuk membantu orang di sekitar.

        </p>

        {{-- BUTTON --}}
        <a
            href="{{ route('foods.create') }}"
            class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-4 rounded-2xl transition shadow"
        >
            + Tambah Makanan Pertama
        </a>

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