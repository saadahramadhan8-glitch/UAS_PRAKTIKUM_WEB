@extends('layouts.dashboard')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">

        <h1 class="text-3xl font-bold text-slate-800">
            Edit Makanan
        </h1>

        <p class="text-slate-500 mt-1">
            Perbarui informasi makanan yang tersedia.
        </p>

    </div>

    {{-- FORM CARD --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-8">

        <form
            action="{{ route('foods.update', $food->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6"
        >

            @csrf
            @method('PUT')

            {{-- TITLE --}}
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Judul Makanan
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $food->title) }}"
                    placeholder="Contoh: Nasi Goreng"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                >

                @error('title')

                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            {{-- DESCRIPTION --}}
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="5"
                    placeholder="Deskripsikan makanan..."
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                >{{ old('description', $food->description) }}</textarea>

                @error('description')

                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            {{-- GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- QUANTITY --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Jumlah
                    </label>

                    <input
                        type="number"
                        name="quantity"
                        value="{{ old('quantity', $food->quantity) }}"
                        placeholder="Contoh: 10"
                        class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    >

                    @error('quantity')

                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                {{-- EXPIRED --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Batas Konsumsi
                    </label>

                    <input
                        type="datetime-local"
                        name="expired_at"
                        value="{{ old('expired_at', \Carbon\Carbon::parse($food->expired_at)->format('Y-m-d\TH:i')) }}"
                        class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    >

                    @error('expired_at')

                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>

            {{-- IMAGE --}}
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Foto Makanan
                </label>

                {{-- PREVIEW --}}
                @if($food->image)

                    <div class="mb-4">

                        <img
                            src="{{ asset('storage/' . $food->image) }}"
                            class="w-48 h-48 object-cover rounded-2xl border border-slate-200"
                        >

                    </div>

                @endif

                <input
                    type="file"
                    name="image"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 bg-slate-50"
                >

                @error('image')

                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            {{-- ADDRESS --}}
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Alamat
                </label>

                <textarea
                    name="address"
                    rows="4"
                    placeholder="Masukkan alamat lokasi makanan..."
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                >{{ old('address', $food->address) }}</textarea>

                @error('address')

                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            {{-- LOCATION --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- LATITUDE --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Latitude
                    </label>

                    <input
                        type="text"
                        name="latitude"
                        value="{{ old('latitude', $food->latitude) }}"
                        placeholder="-0.123456"
                        class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    >

                </div>

                {{-- LONGITUDE --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Longitude
                    </label>

                    <input
                        type="text"
                        name="longitude"
                        value="{{ old('longitude', $food->longitude) }}"
                        placeholder="119.123456"
                        class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    >

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end gap-3 pt-4">

                <a
                    href="{{ route('foods.index') }}"
                    class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 transition"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl transition shadow-sm"
                >
                    Update Makanan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection