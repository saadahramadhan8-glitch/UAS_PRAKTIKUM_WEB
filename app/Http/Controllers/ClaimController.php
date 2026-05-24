<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    /**
     * Simpan claim makanan
     */
    public function store(Request $request, Food $food)
    {
        // hanya penerima
        if (auth()->user()->role !== 'penerima') {

            abort(403, 'Hanya penerima yang dapat claim makanan');

        }

        // validasi quantity
        $request->validate([

            'quantity' => 'required|integer|min:1'

        ]);

        // cek stok
        if ($request->quantity > $food->quantity) {

            return back()->with(

                'error',
                'Jumlah claim melebihi stok makanan'

            );

        }

        // simpan claim
        Claim::create([

            'food_id' => $food->id,

            'user_id' => auth()->id(),

            'quantity' => $request->quantity,

            'status' => 'pending',

            'claim_date' => now(),

            'notes' => $request->notes

        ]);

        // kurangi stok makanan
        $food->quantity -= $request->quantity;

        // jika stok habis
        if ($food->quantity <= 0) {

            $food->status = 'habis';

        }

        $food->save();

        return redirect()
            ->route('foods.index')
            ->with('success', 'Makanan berhasil di-claim');
    }
}