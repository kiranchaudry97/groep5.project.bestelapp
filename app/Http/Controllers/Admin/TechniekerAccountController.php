<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TechniekerAccountController extends Controller
{
    /**
     * Toon een overzicht van alle techniekers.
     */
    public function index()
    {
        $users = User::role('technieker')->orderByDesc('created_at')->get();

        return view('admin.techniekers.index', compact('users'));
    }

    /**
     * Toon het formulier om een nieuwe technieker aan te maken.
     */
    public function create()
    {
        return view('admin.techniekers.create');
    }

    /**
     * Sla een nieuwe technieker op in de database met standaard wachtwoord.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make('tech123'), // standaard wachtwoord
        ]);

        $user->assignRole('technieker');

        return redirect()->route('admin.techniekers.index')
                         ->with('status', 'Technieker aangemaakt met wachtwoord "tech123".');
    }
}