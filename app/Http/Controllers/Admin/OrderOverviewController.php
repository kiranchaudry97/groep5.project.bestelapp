<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderOverviewController extends Controller
{
    /**
     * Toon het overzicht van alle bestellingen + statistieken.
     */
    public function index()
    {
        $bestellingen = Order::with(['user', 'items.material'])->latest()->get();

        // ✅ Statistieken verzamelen
        $stats = [
            'totaal' => $bestellingen->count(),
            'in_behandeling' => $bestellingen->where('status', 'in_behandeling')->count(),
            'verzonden' => $bestellingen->where('status', 'verzonden')->count(),
            'afgehandeld' => $bestellingen->where('status', 'afgehandeld')->count(),
        ];

        return view('admin.orders.index', compact('bestellingen', 'stats'));
    }

    /**
     * Verwerk de wijziging van de status van een bestelling.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:in_behandeling,verzonden,afgehandeld',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('status', 'Status van bestelling bijgewerkt.');
    }
}