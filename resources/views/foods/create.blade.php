@extends('layouts.dashboard')

@section('content')

    <h1>Tambah Makanan</h1>

    <form
        action="{{ route('foods.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div>
            <label>Judul</label>
            <br>

            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
            >

            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>Deskripsi</label>
            <br>

            <textarea name="description">{{ old('description') }}</textarea>

            @error('description')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>Jumlah</label>
            <br>

            <input
                type="number"
                name="quantity"
                value="{{ old('quantity') }}"
            >

            @error('quantity')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>Batas Konsumsi</label>
            <br>

            <input
                type="datetime-local"
                name="expired_at"
            >

            @error('expired_at')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>Foto Makanan</label>
            <br>

            <input
                type="file"
                name="image"
            >

            @error('image')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>Alamat</label>
            <br>

            <textarea name="address">{{ old('address') }}</textarea>

            @error('address')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>Latitude</label>
            <br>

            <input
                type="text"
                name="latitude"
                value="{{ old('latitude') }}"
            >
        </div>

        <br>

        <div>
            <label>Longitude</label>
            <br>

            <input
                type="text"
                name="longitude"
                value="{{ old('longitude') }}"
            >
        </div>

        <br>

        <button type="submit">
            Simpan
        </button>

    </form>

@endsection