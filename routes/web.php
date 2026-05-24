<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ClaimController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return view('welcome');

});

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $role = auth()->user()->role;

    // Redirect berdasarkan role
    return match ($role) {

        'admin' => redirect('/admin/dashboard'),

        'penyedia' => redirect('/penyedia/dashboard'),

        'penerima' => redirect('/penerima/dashboard'),

        'kurir' => redirect('/kurir/dashboard'),

        default => abort(403)

    };

})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {

        /*
        |--------------------------------------------------------------------------
        | TOTAL DATA
        |--------------------------------------------------------------------------
        */

        $totalFoods = \App\Models\Food::count();

        $totalClaims = \App\Models\Claim::count();

        $totalProviders = \App\Models\User::where(

            'role',

            'penyedia'

        )->count();

        $totalReceivers = \App\Models\User::where(

            'role',

            'penerima'

        )->count();

        /*
        |--------------------------------------------------------------------------
        | CLAIM STATUS
        |--------------------------------------------------------------------------
        */

        $pendingClaims = \App\Models\Claim::where(

            'status',

            'pending'

        )->count();

        $approvedClaims = \App\Models\Claim::where(

            'status',

            'disetujui'

        )->count();

        /*
        |--------------------------------------------------------------------------
        | RECENT CLAIMS
        |--------------------------------------------------------------------------
        */

        $recentClaims = \App\Models\Claim::with([

            'food',
            'user'

        ])

        ->latest()

        ->take(5)

        ->get();

        /*
        |--------------------------------------------------------------------------
        | RECENT FOODS
        |--------------------------------------------------------------------------
        */

        $recentFoods = \App\Models\Food::latest()

            ->take(5)

            ->get();

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view('dashboard.admin', [

            'totalFoods' => $totalFoods,

            'totalClaims' => $totalClaims,

            'totalProviders' => $totalProviders,

            'totalReceivers' => $totalReceivers,

            'pendingClaims' => $pendingClaims,

            'approvedClaims' => $approvedClaims,

            'recentClaims' => $recentClaims,

            'recentFoods' => $recentFoods,

        ]);

    });

});

/*
|--------------------------------------------------------------------------
| PENYEDIA ROUTE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:penyedia'])->group(function () {

    Route::get('/penyedia/dashboard', function () {

        $foods = \App\Models\Food::where('user_id', auth()->id());

        return view('dashboard.penyedia', [

            /*
            |--------------------------------------------------------------------------
            | TOTAL MAKANAN
            |--------------------------------------------------------------------------
            */

            'totalFoods' => $foods->count(),

            /*
            |--------------------------------------------------------------------------
            | MAKANAN TERSEDIA
            |--------------------------------------------------------------------------
            */

            'availableFoods' => (clone $foods)
                ->where('status', 'tersedia')
                ->count(),

            /*
            |--------------------------------------------------------------------------
            | MAKANAN HABIS
            |--------------------------------------------------------------------------
            */

            'claimedFoods' => (clone $foods)
                ->where('status', 'habis')
                ->count(),

            /*
            |--------------------------------------------------------------------------
            | MAKANAN KADALUARSA
            |--------------------------------------------------------------------------
            */

            'expiredFoods' => (clone $foods)
                ->where('status', 'kadaluarsa')
                ->count(),

        ]);

    });

});

/*
|--------------------------------------------------------------------------
| PENERIMA ROUTE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:penerima'])->group(function () {

    Route::get('/penerima/dashboard', function () {

        return view('dashboard.penerima');

    });

});

/*
|--------------------------------------------------------------------------
| KURIR ROUTE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:kurir'])->group(function () {

    Route::get('/kurir/dashboard', function () {

        return view('dashboard.kurir');

    });

});

/*
|--------------------------------------------------------------------------
| FOOD ROUTE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | FOOD RESOURCE
    |--------------------------------------------------------------------------
    */

    Route::resource('foods', FoodController::class);

    /*
    |--------------------------------------------------------------------------
    | AVAILABLE FOOD
    |--------------------------------------------------------------------------
    */

    Route::get(

        '/available-foods',

        [FoodController::class, 'availableFoods']

    )->name('foods.available');

    /*
    |--------------------------------------------------------------------------
    | CLAIM ROUTE
    |--------------------------------------------------------------------------
    */

    Route::post(

        '/foods/{food}/claim',

        [ClaimController::class, 'store']

    )->name('claims.store');

    /*
    |--------------------------------------------------------------------------
    | MY CLAIMS
    |--------------------------------------------------------------------------
    */

    Route::get(

        '/my-claims',

        [ClaimController::class, 'myClaims']

    )->name('claims.my');

    /*
    |--------------------------------------------------------------------------
    | INCOMING CLAIMS
    |--------------------------------------------------------------------------
    */

    Route::get(

        '/incoming-claims',

        [ClaimController::class, 'incomingClaims']

    )->name('claims.incoming');

    /*
    |--------------------------------------------------------------------------
    | APPROVE CLAIM
    |--------------------------------------------------------------------------
    */

    Route::patch(

        '/claims/{claim}/approve',

        [ClaimController::class, 'approve']

    )->name('claims.approve');

    /*
    |--------------------------------------------------------------------------
    | REJECT CLAIM
    |--------------------------------------------------------------------------
    */

    Route::patch(

        '/claims/{claim}/reject',

        [ClaimController::class, 'reject']

    )->name('claims.reject');

});

/*
|--------------------------------------------------------------------------
| PROFILE ROUTE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTE
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';