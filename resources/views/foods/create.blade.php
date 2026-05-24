@extends('layouts.dashboard')

@section('content')

{{-- LEAFLET CSS --}}
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet/dist/leaflet.css"
/>

<div class="max-w-4xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-800">
            Tambah Makanan
        </h1>

        <p class="text-slate-500 mt-1">
            Bagikan makanan layak konsumsi untuk membantu sesama.
        </p>

    </div>

    {{-- FORM CARD --}}
    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-8">

        <form
            action="{{ route('foods.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6"
        >

            @csrf

            {{-- TITLE --}}
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Judul Makanan
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Contoh: Nasi Kotak Ayam"
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
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
                    placeholder="Jelaskan kondisi makanan..."
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                >{{ old('description') }}</textarea>

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
                        value="{{ old('quantity') }}"
                        placeholder="Contoh: 10"
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
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
                        class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
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

                <input
                    type="file"
                    name="image"
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 bg-white"
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
                    placeholder="Masukkan alamat lengkap..."
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                >{{ old('address') }}</textarea>

                @error('address')

                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            {{-- HIDDEN COORDINATE --}}
            <input
                type="hidden"
                name="latitude"
                id="latitude"
            >

            <input
                type="hidden"
                name="longitude"
                id="longitude"
            >

            {{-- LIVE MAP --}}
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-3">
                    Pilih Lokasi di Map
                </label>

                <div
                    id="map"
                    class="w-full h-[400px] rounded-3xl border border-slate-200 overflow-hidden"
                ></div>

            </div>

            {{-- BUTTON --}}
            <div class="flex flex-col sm:flex-row gap-4 pt-4">

                {{-- SAVE --}}
                <button
                    type="submit"
                    class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white py-4 rounded-2xl transition font-medium"
                >
                    Simpan Makanan
                </button>

                {{-- CANCEL --}}
                <a
                    href="{{ route('foods.index') }}"
                    class="flex-1 border border-slate-200 text-slate-700 py-4 rounded-2xl text-center hover:bg-slate-100 transition font-medium"
                >
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

{{-- LEAFLET JS --}}
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

    // DEFAULT LOCATION PALU
    const defaultLat = -0.8917;
    const defaultLng = 119.8707;

    // MAP INIT
    const map = L.map('map').setView(
        [defaultLat, defaultLng],
        13
    );

    // TILE
    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap contributors'
        }
    ).addTo(map);

    // MARKER
    let marker = L.marker(
        [defaultLat, defaultLng],
        {
            draggable: true
        }
    ).addTo(map);

    // INPUT
    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');

    // DEFAULT VALUE
    latInput.value = defaultLat;
    lngInput.value = defaultLng;

    // DRAG MARKER
    marker.on('dragend', function () {

        const position = marker.getLatLng();

        latInput.value = position.lat;
        lngInput.value = position.lng;

    });

    // CLICK MAP
    map.on('click', function (e) {

        marker.setLatLng(e.latlng);

        latInput.value = e.latlng.lat;
        lngInput.value = e.latlng.lng;

    });

</script>

@endsection