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

                    <div
                        class="h-full min-h-[400px] flex items-center justify-center text-slate-400 text-xl"
                    >

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

                        @if($food->status == 'tersedia')
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
                    <div
                        class="flex justify-between items-center border-b border-slate-100 pb-4"
                    >

                        <span class="text-slate-500">
                            Jumlah
                        </span>

                        <span class="font-semibold text-slate-800">
                            {{ $food->quantity }}
                        </span>

                    </div>

                    {{-- EXPIRED --}}
                    <div
                        class="flex justify-between items-center border-b border-slate-100 pb-4"
                    >

                        <span class="text-slate-500">
                            Batas Konsumsi
                        </span>

                        <span class="font-semibold text-slate-800">

                            {{ \Carbon\Carbon::parse($food->expired_at)->format('d M Y H:i') }}

                        </span>

                    </div>

                    {{-- ADDRESS --}}
                    <div
                        class="flex justify-between items-start border-b border-slate-100 pb-4 gap-6"
                    >

                        <span class="text-slate-500">
                            Alamat
                        </span>

                        <span class="font-semibold text-slate-800 text-right">
                            {{ $food->address }}
                        </span>

                    </div>

                    {{-- LATITUDE --}}
                    <div
                        class="flex justify-between items-center border-b border-slate-100 pb-4"
                    >

                        <span class="text-slate-500">
                            Latitude
                        </span>

                        <span class="font-semibold text-slate-800">
                            {{ $food->latitude ?? '-' }}
                        </span>

                    </div>

                    {{-- LONGITUDE --}}
                    <div
                        class="flex justify-between items-center border-b border-slate-100 pb-4"
                    >

                        <span class="text-slate-500">
                            Longitude
                        </span>

                        <span class="font-semibold text-slate-800">
                            {{ $food->longitude ?? '-' }}
                        </span>

                    </div>

                </div>

                {{-- ACTION --}}
                <div class="flex flex-col gap-4">

                    {{-- ADMIN / OWNER --}}
                    @if(
                        auth()->user()->role === 'admin'
                        ||
                        auth()->user()->id === $food->user_id
                    )

                        <div class="flex gap-4">

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

                        </div>

                    @endif

                    {{-- CLAIM FORM --}}
                    @if(
                        auth()->user()->role === 'penerima'
                        &&
                        $food->status === 'tersedia'
                    )

                        <form
                            action="{{ route('claims.store', $food->id) }}"
                            method="POST"
                            class="space-y-4"
                        >

                            @csrf

                            {{-- QUANTITY --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Jumlah Claim
                                </label>

                                <input
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    max="{{ $food->quantity }}"
                                    required
                                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                >

                            </div>

                            {{-- NOTES --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Catatan
                                </label>

                                <textarea
                                    name="notes"
                                    rows="3"
                                    placeholder="Tambahkan catatan..."
                                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                ></textarea>

                            </div>

                            {{-- BUTTON --}}
                            <button
                                type="submit"
                                class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-3 rounded-2xl transition"
                            >
                                Claim Makanan
                            </button>

                        </form>

                    @endif

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