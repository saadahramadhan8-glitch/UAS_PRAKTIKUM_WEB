<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [

            'user' => $request->user(),

        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATED DATA
        |--------------------------------------------------------------------------
        */

        $validated = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | OPTIONAL FIELD
        |--------------------------------------------------------------------------
        */

        $validated['phone'] = $request->phone;

        $validated['address'] = $request->address;

        /*
        |--------------------------------------------------------------------------
        | FILL USER DATA
        |--------------------------------------------------------------------------
        */

        $request->user()->fill($validated);

        /*
        |--------------------------------------------------------------------------
        | RESET EMAIL VERIFICATION
        |--------------------------------------------------------------------------
        */

        if ($request->user()->isDirty('email')) {

            $request->user()->email_verified_at = null;

        }

        /*
        |--------------------------------------------------------------------------
        | SAVE
        |--------------------------------------------------------------------------
        */

        $request->user()->save();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return Redirect::route('profile.edit')

            ->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATE PASSWORD
        |--------------------------------------------------------------------------
        */

        $request->validateWithBag('userDeletion', [

            'password' => ['required', 'current_password'],

        ]);

        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | LOGOUT
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        /*
        |--------------------------------------------------------------------------
        | DELETE USER
        |--------------------------------------------------------------------------
        */

        $user->delete();

        /*
        |--------------------------------------------------------------------------
        | INVALIDATE SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return Redirect::to('/');
    }
}