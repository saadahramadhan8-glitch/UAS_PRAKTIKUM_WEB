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
        /*
        |--------------------------------------------------------------------------
        | HANYA PENERIMA
        |--------------------------------------------------------------------------
        */

        if (auth()->user()->role !== 'penerima') {

            abort(403, 'Hanya penerima yang dapat claim makanan');

        }

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'quantity' => 'required|integer|min:1',

            'notes' => 'nullable|string|max:1000'

        ]);

        /*
        |--------------------------------------------------------------------------
        | CEK STATUS MAKANAN
        |--------------------------------------------------------------------------
        */

        if ($food->status !== 'tersedia') {

            return back()->with(

                'error',
                'Makanan tidak tersedia untuk di-claim'

            );

        }

        /*
        |--------------------------------------------------------------------------
        | CEK STOK
        |--------------------------------------------------------------------------
        */

        if ($food->quantity <= 0) {

            return back()->with(

                'error',
                'Stok makanan sudah habis'

            );

        }

        /*
        |--------------------------------------------------------------------------
        | CEK QUANTITY CLAIM
        |--------------------------------------------------------------------------
        */

        if ($request->quantity > $food->quantity) {

            return back()->with(

                'error',
                'Jumlah claim melebihi stok makanan'

            );

        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN CLAIM
        |--------------------------------------------------------------------------
        */

        Claim::create([

            'food_id' => $food->id,

            'user_id' => auth()->id(),

            'quantity' => $request->quantity,

            // STATUS CLAIM
            'status' => 'pending',

            // TANGGAL CLAIM
            'claim_date' => now(),

            // CATATAN
            'notes' => $request->notes

        ]);

        /*
        |--------------------------------------------------------------------------
        | KURANGI STOK MAKANAN
        |--------------------------------------------------------------------------
        */

        $food->quantity -= $request->quantity;

        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS MAKANAN
        |--------------------------------------------------------------------------
        */

        // jika stok habis
        if ($food->quantity <= 0) {

            $food->status = 'habis';

        }

        // jika masih tersedia
        else {

            $food->status = 'tersedia';

        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN PERUBAHAN
        |--------------------------------------------------------------------------
        */

        $food->save();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('foods.index')
            ->with('success', 'Makanan berhasil di-claim');
    }

    /**
     * History claim penerima
     */
    public function myClaims()
    {
        /*
        |--------------------------------------------------------------------------
        | HANYA PENERIMA
        |--------------------------------------------------------------------------
        */

        if (auth()->user()->role !== 'penerima') {

            abort(403, 'Akses ditolak');

        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA CLAIM
        |--------------------------------------------------------------------------
        */

        $claims = Claim::with('food')

            ->where('user_id', auth()->id())

            ->latest()

            ->paginate(10);

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(

            'claims.my-claims',

            compact('claims')

        );
    }
}