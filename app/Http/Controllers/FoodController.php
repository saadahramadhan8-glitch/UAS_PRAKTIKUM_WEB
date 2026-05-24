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
        return view('foods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        // Simpan gambar jika ada
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

            'status' => 'pending_verification',

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
        return view('foods.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        // Update gambar jika ada
        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('foods', 'public');

            $food->image = $imagePath;
        }

        // Update data makanan
        $food->update([

            'title' => $request->title,

            'description' => $request->description,

            'quantity' => $request->quantity,

            'expired_at' => $request->expired_at,

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
        $food->delete();

        return redirect()
            ->route('foods.index')
            ->with('success', 'Makanan berhasil dihapus');
    }
}