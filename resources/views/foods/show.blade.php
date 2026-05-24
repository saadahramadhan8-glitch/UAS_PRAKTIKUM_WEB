@extends('layouts.dashboard')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- BACK BUTTON --}}
    <div class="mb-6">

        <a
            href="{{ route('foods.index') }}"
            class="inline-flex items-center gap-2 text-slate-600 hover:text-emerald-600 transition"
        >
            ← Kembali ke daftar makanan
        </a>

    </div>

    {{-- CARD --}}
    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">

        <div class="grid grid-cols-1 lg:grid-cols-2">

            {{-- IMAGE --}}
            <div class="bg-slate-100">

                @if($food->image)

                    <img
                        src="{{ asset('storage/' . $food->image) }}"
                        alt="{{ $food->title }}"
                        class="w-full h-full object-cover"
                    >

                @else

                    <div class="h-full min-h-[400px] flex items-center justify-center text-slate-400 text-xl">

                        Tidak ada gambar

                    </div>

                @endif

            </div>

            {{-- CONTENT --}}
            <div class="p-8 lg:p-10">

                {{-- STATUS --}}
                <div class="mb-4">

                    <span class="
                        px-4 py-2 rounded-full text-sm font-semibold

                        @if($food->status == 'available')
                            bg-emerald-100 text-emerald-700

                        @elseif($food->status == 'claimed')
                            bg-orange-100 text-orange-500

                        @elseif($food->status == 'pending_verification')
                            bg-yellow-100 text-yellow-600

                        @else
                            bg-red-100 text-red-500
                        @endif
                    ">

                        {{ ucfirst(str_replace('_', ' ', $food->status)) }}

                    </span>

                </div>

                {{-- TITLE --}}
                <h1 class="text-4xl font-bold text-slate-800 mb-4">

                    {{ $food->title }}

                </h1>

                {{-- DESCRIPTION --}}
                <p class="text-slate-500 leading-relaxed mb-8">

                    {{ $food->description }}

                </p>

                {{-- INFO --}}
                <div class="space-y-5 mb-8">

                    {{-- QUANTITY --}}
                    <div class="flex justify-between items-center border-b border-slate-100 pb-4">

                        <span class="text-slate-500">
                            Jumlah
                        </span>

                        <span class="font-semibold text-slate-800">
                            {{ $food->quantity }}
                        </span>

                    </div>

                    {{-- EXPIRED --}}
                    <div class="flex justify-between items-center border-b border-slate-100 pb-4">

                        <span class="text-slate-500">
                            Batas Konsumsi
                        </span>

                        <span class="font-semibold text-slate-800">
                            {{ $food->expired_at }}
                        </span>

                    </div>

                    {{-- ADDRESS --}}
                    <div class="flex justify-between items-start border-b border-slate-100 pb-4 gap-6">

                        <span class="text-slate-500">
                            Alamat
                        </span>

                        <span class="font-semibold text-slate-800 text-right">
                            {{ $food->address }}
                        </span>

                    </div>

                    {{-- LATITUDE --}}
                    <div class="flex justify-between items-center border-b border-slate-100 pb-4">

                        <span class="text-slate-500">
                            Latitude
                        </span>

                        <span class="font-semibold text-slate-800">
                            {{ $food->latitude ?? '-' }}
                        </span>

                    </div>

                    {{-- LONGITUDE --}}
                    <div class="flex justify-between items-center border-b border-slate-100 pb-4">

                        <span class="text-slate-500">
                            Longitude
                        </span>

                        <span class="font-semibold text-slate-800">
                            {{ $food->longitude ?? '-' }}
                        </span>

                    </div>

                </div>

                {{-- ACTION BUTTONS --}}
                <div class="flex flex-col sm:flex-row gap-4">

                    {{-- EDIT --}}
                    <a
                        href="{{ route('foods.edit', $food->id) }}"
                        class="flex-1 bg-orange-400 hover:bg-orange-500 text-white text-center py-3 rounded-2xl transition"
                    >
                        Edit Makanan
                    </a>

                    {{-- DELETE --}}
                    <form
                        action="{{ route('foods.destroy', $food->id) }}"
                        method="POST"
                        class="flex-1 delete-form"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-2xl transition"
                        >
                            Hapus Makanan
                        </button>

                    </form>
    <div class="max-w-5xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-8 flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Detail Makanan
                </h1>

                <p class="text-gray-500 mt-2">
                    Informasi lengkap makanan tersedia
                </p>

            </div>

            <a
                href="{{ route('foods.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-3 rounded-xl transition"
            >
                Kembali
            </a>

        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="md:flex">

                {{-- IMAGE --}}
                <div class="md:w-1/2 bg-gray-100">

                    @if($food->image)

                        <img
                            src="{{ asset('storage/' . $food->image) }}"
                            class="w-full h-full object-cover"
                        >

                    @else

                        <div
                            class="w-full h-full flex items-center justify-center text-gray-500 p-10"
                        >
                            Tidak ada gambar
                        </div>

                    @endif

                </div>

                {{-- CONTENT --}}
                <div class="p-8 flex-1">

                    <div class="flex items-start justify-between">

                        <h2 class="text-3xl font-bold text-gray-800">
                            {{ $food->title }}
                        </h2>

                        <span
                            class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium"
                        >
                            {{ $food->status }}
                        </span>

                    </div>

                    <div class="mt-6 space-y-5">

                        {{-- DESCRIPTION --}}
                        <div>

                            <h3 class="font-semibold text-gray-700 mb-2">
                                Deskripsi
                            </h3>

                            <p class="text-gray-600 leading-relaxed">
                                {{ $food->description }}
                            </p>

                        </div>

                        {{-- QUANTITY --}}
                        <div>

                            <h3 class="font-semibold text-gray-700 mb-2">
                                Jumlah
                            </h3>

                            <p class="text-gray-600">
                                {{ $food->quantity }}
                            </p>

                        </div>

                        {{-- ADDRESS --}}
                        <div>

                            <h3 class="font-semibold text-gray-700 mb-2">
                                Alamat
                            </h3>

                            <p class="text-gray-600">
                                {{ $food->address }}
                            </p>

                        </div>

                        {{-- EXPIRED --}}
                        <div>

                            <h3 class="font-semibold text-gray-700 mb-2">
                                Batas Konsumsi
                            </h3>

                            <p class="text-gray-600">
                                {{ $food->expired_at }}
                            </p>

                        </div>

                    </div>

                    {{-- ACTION --}}
                    <div class="mt-8 flex flex-wrap gap-4">

                        {{-- ADMIN / OWNER --}}
                        @if(
                            auth()->user()->role === 'admin'
                            ||
                            auth()->user()->id === $food->user_id
                        )

                            <a
                                href="{{ route('foods.edit', $food->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-3 rounded-xl transition"
                            >
                                Edit
                            </a>

                        @endif

                        {{-- PENERIMA --}}
                        @if(auth()->user()->role === 'penerima')

                            <button
                                class="bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-xl transition"
                            >
                                Claim Makanan
                            </button>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

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