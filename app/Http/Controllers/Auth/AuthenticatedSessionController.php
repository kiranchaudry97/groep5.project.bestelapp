<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Toon loginformulier.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Verwerk de login-aanvraag.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Authenticatie mislukt.']);
        }

        // ✅ Redirect op basis van rol
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('technieker')) {
            return redirect()->route('technieker.dashboard');
        }

        // ❌ Geen rol toegekend
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('error', 'Geen geldige rol gekoppeld aan je account.');
    }

    /**
     * Uitloggen.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('logout', true);
    }
}
