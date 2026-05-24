<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query dasar
        $query = Food::query();

        // ROLE FILTER
        if (auth()->user()->role !== 'admin') {


            // Penyedia hanya melihat miliknya
            $query->where('user_id', auth()->id());

        }

        // Penyedia melihat makanan miliknya
        elseif (auth()->user()->role === 'penyedia') {

            $foods = Food::where('user_id', auth()->id())
                ->where('status', 'tersedia')
                ->latest()
                ->get();

        }

        // Penerima & kurir melihat makanan tersedia
        else {

            $foods = Food::where('status', 'tersedia')
                ->latest()
                ->get();

        }

        // SEARCH
        if ($request->search) {

            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // FILTER STATUS
        if ($request->status) {

            $query->where('status', $request->status);
        }

        // PAGINATION
        $foods = $query
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('foods.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hanya admin & penyedia
        if (

            auth()->user()->role !== 'admin'
            &&

            auth()->user()->role !== 'penyedia'

        ) {

            abort(403, 'Akses ditolak');

        }

        return view('foods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        // Hanya admin & penyedia
        if (

            auth()->user()->role !== 'admin'
            &&

            auth()->user()->role !== 'penyedia'

        ) {

            abort(403, 'Akses ditolak');

        }

        // Upload gambar
        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('foods', 'public');

        }

        // Simpan makanan
        Food::create([

            'user_id' => auth()->id(),

            'title' => $request->title,

            'description' => $request->description,

            'quantity' => $request->quantity,

            'expired_at' => $request->expired_at,

            'image' => $imagePath,

            'status' => 'tersedia',

            'address' => $request->address,

            'latitude' => $request->latitude,

            'longitude' => $request->longitude,

        ]);

        return redirect()
            ->route('foods.index')
            ->with('success', 'Makanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return view('foods.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        $this->authorizeFood($food);

        return view('foods.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        $this->authorizeFood($food);

        // Upload gambar baru
        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('foods', 'public');

        } else {

            $imagePath = $food->image;

        }

        // Update makanan
        $food->update([

            'title' => $request->title,

            'description' => $request->description,

            'quantity' => $request->quantity,

            'expired_at' => $request->expired_at,

            'image' => $imagePath,

            'address' => $request->address,

            'latitude' => $request->latitude,

            'longitude' => $request->longitude,

        ]);

        return redirect()
            ->route('foods.index')
            ->with('success', 'Makanan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $this->authorizeFood($food);

        $food->delete();

        return redirect()
            ->route('foods.index')
            ->with('success', 'Makanan berhasil dihapus');
    }

    /**
     * Authorization ownership
     */
    private function authorizeFood(Food $food)
    {
        if (

            auth()->user()->role !== 'admin'
            &&

            $food->user_id !== auth()->id()

        ) {

            abort(403, 'Akses ditolak');

        }
    }
}