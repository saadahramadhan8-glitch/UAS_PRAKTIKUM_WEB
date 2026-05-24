@extends('layouts.dashboard')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6 flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Detail Makanan
            </h1>

            <p class="text-slate-500 mt-1">
                Informasi lengkap makanan yang tersedia.
            </p>

        </div>

        {{-- STATUS --}}
        <span class="
            px-4 py-2 rounded-full text-sm font-semibold

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

    {{-- CARD --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- IMAGE --}}
        @if($food->image)

            <img
                src="{{ asset('storage/' . $food->image) }}"
                class="w-full h-96 object-cover cursor-pointer hover:opacity-90 transition"
                onclick="openImageModal('{{ asset('storage/' . $food->image) }}')"
            >

        @else

            <div class="w-full h-96 bg-slate-100 flex items-center justify-center text-slate-500">

                Tidak ada gambar

            </div>

        @endif

        {{-- CONTENT --}}
        <div class="p-8">

            {{-- TITLE --}}
            <div class="mb-6">

                <h2 class="text-3xl font-bold text-slate-800 mb-2">

                    {{ $food->title }}

                </h2>

                <p class="text-slate-500 leading-relaxed">

                    {{ $food->description }}

                </p>

            </div>

            {{-- INFO GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                {{-- QUANTITY --}}
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5">

                    <p class="text-sm text-slate-500 mb-1">
                        Jumlah
                    </p>

                    <h3 class="text-2xl font-bold text-slate-800">

                        {{ $food->quantity }}

                    </h3>

                </div>

                {{-- EXPIRED --}}
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5">

                    <p class="text-sm text-slate-500 mb-1">
                        Batas Konsumsi
                    </p>

                    <h3 class="text-lg font-semibold text-slate-800">

                        {{ $food->expired_at }}

                    </h3>

                </div>

            </div>

            {{-- ADDRESS --}}
            <div class="mb-8">

                <h3 class="text-xl font-bold text-slate-800 mb-3">
                    Lokasi
                </h3>

                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5">

                    <p class="text-slate-700 mb-3">

                        {{ $food->address }}

                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-500">

                        <p>

                            <span class="font-semibold text-slate-700">
                                Latitude:
                            </span>

                            {{ $food->latitude }}

                        </p>

                        <p>

                            <span class="font-semibold text-slate-700">
                                Longitude:
                            </span>

                            {{ $food->longitude }}

                        </p>

                    </div>

                </div>

            </div>

            {{-- ACTION BUTTON --}}
            <div class="flex flex-wrap gap-3">

                {{-- BACK --}}
                <a
                    href="{{ route('foods.index') }}"
                    class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 transition"
                >
                    Kembali
                </a>

                {{-- EDIT --}}
                <a
                    href="{{ route('foods.edit', $food->id) }}"
                    class="bg-orange-400 hover:bg-orange-500 text-white px-6 py-3 rounded-xl transition"
                >
                    Edit
                </a>

                {{-- DELETE --}}
                <form
                    action="{{ route('foods.destroy', $food->id) }}"
                    method="POST"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl transition"
                    >
                        Hapus
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

{{-- IMAGE MODAL --}}
<div
    id="imageModal"
    class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 p-5"
    onclick="closeImageModal()"
>

    <img
        id="modalImage"
        class="max-w-full max-h-full rounded-2xl shadow-2xl"
    >

</div>

<script>

    function openImageModal(imageUrl)
    {
        document.getElementById('imageModal').classList.remove('hidden');

        document.getElementById('imageModal').classList.add('flex');

        document.getElementById('modalImage').src = imageUrl;
    }

    function closeImageModal()
    {
        document.getElementById('imageModal').classList.add('hidden');

        document.getElementById('imageModal').classList.remove('flex');
    }

</script>

@endsection