<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Toon het profiel bewerkformulier van de gebruiker.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Werk de profielgegevens van de gebruiker bij.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        // ✅ Optioneel wachtwoord bijwerken indien ingevuld
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // ✅ Reset e-mailverificatie als e-mail werd aangepast
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Verwijder het account van de gebruiker.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}