@extends('layouts.dashboard')

@section('content')

    <h1>Edit Makanan</h1>

    <form
        action="{{ route('foods.update', $food->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div>
            <label>Judul</label>
            <br>

            <input
                type="text"
                name="title"
                value="{{ old('title', $food->title) }}"
            >
        </div>

        <br>

        <div>
            <label>Deskripsi</label>
            <br>

            <textarea name="description">{{ old('description', $food->description) }}</textarea>
        </div>

        <br>

        <div>
            <label>Jumlah</label>
            <br>

            <input
                type="number"
                name="quantity"
                value="{{ old('quantity', $food->quantity) }}"
            >
        </div>

        <br>

        <div>
            <label>Batas Konsumsi</label>
            <br>

            <input
                type="datetime-local"
                name="expired_at"
                value="{{ old('expired_at', $food->expired_at) }}"
            >
        </div>

        <br>

        <div>
            <label>Foto Baru</label>
            <br>

            <input
                type="file"
                name="image"
            >
        </div>

        <br>

        <div>
            <label>Alamat</label>
            <br>

            <textarea name="address">{{ old('address', $food->address) }}</textarea>
        </div>

        <br>

        <button type="submit">
            Update
        </button>

    </form>

@endsection