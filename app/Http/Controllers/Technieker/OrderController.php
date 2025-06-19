<?php

namespace App\Http\Controllers\Technieker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Normalizer;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::query();

        // ✅ Case-insensitive zoeken
        if ($request->filled('search')) {
            $searchTerm = strtolower($request->search);
            $query->whereRaw('LOWER(naam) LIKE ?', ['%' . $searchTerm . '%']);
        }

        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        $materials = $query->orderBy('naam')->get();

        $allCategories = Material::pluck('categorie')
            ->map(function ($cat) {
                $cleaned = trim(preg_replace('/\s+/', ' ', $cat));
                return normalizer_normalize($cleaned, Normalizer::FORM_C);
            })
            ->unique()
            ->sort()
            ->values();

        return view('technieker.materials.index', compact('materials', 'allCategories'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'aantal' => 'required|integer|min:1',
        ]);

        $material = Material::findOrFail($request->material_id);
        $aantal = $request->aantal;

        if ($aantal > $material->voorraad) {
            return back()->with('error', 'Niet genoeg voorraad beschikbaar.');
        }

        $material->voorraad -= $aantal;
        $material->save();

        $cart = session()->get('cart', []);
        $cart[$material->id] = ($cart[$material->id] ?? 0) + $aantal;
        session()->put('cart', $cart);

        return back()->with('status', 'Materiaal toegevoegd aan winkelmand.');
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
        ]);

        $cart = session()->get('cart', []);
        unset($cart[$request->material_id]);
        session()->put('cart', $cart);

        return back()->with('status', 'Materiaal verwijderd uit winkelmand.');
    }

    public function cart()
    {
        $cart = session('cart', []);
        $materials = Material::whereIn('id', array_keys($cart))->get();

        return view('technieker.cart.index', compact('materials', 'cart'));
    }

    public function submitOrder(Request $request)
    {
        $request->validate([
            'leverdatum' => 'required|date|after_or_equal:today',
            'adres' => 'required|string|max:255',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Je winkelmand is leeg.');
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'in_behandeling',
                'leverdatum' => $request->leverdatum,
                'adres' => $request->adres,
            ]);

            foreach ($cart as $materialId => $aantal) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'material_id' => $materialId,
                    'aantal' => $aantal,
                ]);
            }

            session()->forget('cart');
            DB::commit();

            return redirect()->route('technieker.cart.view')->with('status', '✅ Bestelling succesvol geplaatst!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Er ging iets mis bij het plaatsen van je bestelling.');
        }
    }

    public function orders()
    {
        $orders = Order::with('items.material')
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();

        return view('technieker.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.material')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('technieker.orders.show', compact('order'));
    }

    public function cancel($id)
    {
        $order = Order::where('user_id', auth()->id())->findOrFail($id);

        if ($order->status !== 'in_behandeling') {
            return back()->with('error', 'Deze bestelling kan niet worden geannuleerd.');
        }

        foreach ($order->items as $item) {
            $material = $item->material;
            $material->voorraad += $item->aantal;
            $material->save();
        }

        $order->update(['status' => 'geannuleerd']);

        return back()->with('status', 'Bestelling is geannuleerd en voorraad hersteld.');
    }
}