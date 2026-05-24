@extends('layouts.dashboard')

@section('content')

    <h1>Makanan Tersedia</h1>

    <hr>

    @forelse($foods as $food)

        <div
            style="
                border:1px solid #ccc;
                padding:15px;
                margin-bottom:20px;
            "
        >

            <h3>{{ $food->title }}</h3>

            <p>{{ $food->description }}</p>

            <p>
                Jumlah:
                {{ $food->quantity }}
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
                    width="200"
                >

            @endif

        </div>

    @empty

        <p>
            Belum ada makanan tersedia.
        </p>

    @endforelse

@endsection