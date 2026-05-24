@extends('layouts.dashboard')

@section('content')

    <h1>Detail Makanan</h1>

    <h2>{{ $food->title }}</h2>

    <p>{{ $food->description }}</p>

    <p>
        Jumlah:
        {{ $food->quantity }}
    </p>

    <p>
        Status:
        {{ $food->status }}
    </p>

    <p>
        Alamat:
        {{ $food->address }}
    </p>

    <p>
        Kadaluarsa:
        {{ $food->expired_at }}
    </p>

    @if($food->image)

        <img
            src="{{ asset('storage/' . $food->image) }}"
            width="300"
        >

    @endif

    <br><br>

    <a href="{{ route('foods.index') }}">
        Kembali
    </a>

@endsection