@extends('layouts.dashboard')

@section('content')

    <h1>Daftar Makanan</h1>

    @if(session('success'))
        <p>
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('foods.create') }}">
        Tambah Makanan
    </a>

    <hr>

    @forelse($foods as $food)

        <div style="margin-bottom:20px; border:1px solid #ccc; padding:15px;">

            <h3>{{ $food->title }}</h3>

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
                Kadaluarsa:
                {{ $food->expired_at }}
            </p>

            @if($food->image)

                <img
                    src="{{ asset('storage/' . $food->image) }}"
                    width="200"
                >

            @endif

            <br><br>

            <a href="{{ route('foods.show', $food->id) }}">
                Detail
            </a>

            <a href="{{ route('foods.edit', $food->id) }}">
                Edit
            </a>

            <form
                action="{{ route('foods.destroy', $food->id) }}"
                method="POST"
            >
                @csrf
                @method('DELETE')

                <button type="submit">
                    Hapus
                </button>
            </form>

        </div>

    @empty

        <p>Belum ada makanan.</p>

    @endforelse

@endsection