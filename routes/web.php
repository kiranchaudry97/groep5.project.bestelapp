<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\OrderOverviewController;
use App\Http\Controllers\Admin\TechniekerAccountController;
use App\Http\Controllers\Technieker\OrderController;

/*
|--------------------------------------------------------------------------
| Redirect root naar login
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Dashboard met rol-afhandeling
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('technieker')) {
        return redirect()->route('technieker.dashboard');
    } else {
        abort(403);
    }
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Materiaalbeheer
    Route::resource('materials', MaterialController::class);

    // Bestellingenbeheer
    Route::get('bestellingen', [OrderOverviewController::class, 'index'])->name('bestellingen.index');
    Route::post('bestellingen/{order}/status', [OrderOverviewController::class, 'updateStatus'])->name('bestellingen.status');

    // Techniekerbeheer
    Route::get('techniekers', [TechniekerAccountController::class, 'index'])->name('techniekers.index');
    Route::get('techniekers/create', [TechniekerAccountController::class, 'create'])->name('techniekers.create');
    Route::post('techniekers', [TechniekerAccountController::class, 'store'])->name('techniekers.store');

    // Optionele alias voor compatibiliteit met oude views
    Route::get('users', [TechniekerAccountController::class, 'index'])->name('users.index');
});

/*
|--------------------------------------------------------------------------
| Technieker Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('technieker')->name('technieker.')->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->user()->hasRole('technieker')) abort(403);
        return view('technieker.dashboard');
    })->name('dashboard');

    // Materialen en winkelmand
    Route::get('materials', [OrderController::class, 'index'])->name('materials.index');
    Route::post('cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
    Route::get('cart', [OrderController::class, 'cart'])->name('cart.view');
    Route::post('cart/submit', [OrderController::class, 'submitOrder'])->name('cart.submit');
    Route::post('cart/remove', [OrderController::class, 'removeFromCart'])->name('cart.remove');

    // Bestellingen
    Route::get('orders', [OrderController::class, 'orders'])->name('orders.index');
    Route::post('orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

/*
|--------------------------------------------------------------------------
| Profielbeheer (voor admin & technieker)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth routes (Laravel Breeze / Jetstream / Fortify)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';