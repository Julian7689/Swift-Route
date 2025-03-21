<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [PedidoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // 🔥 Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🔥 CRUD de Pedidos con nombres de rutas definidos
    Route::prefix('pedidos')->name('pedidos.')->group(function () {
        Route::get('/pdf', [PedidoController::class, 'download'])->name('pdf'); 
        
        Route::get('/', [PedidoController::class, 'index'])->name('index');
        Route::get('/create', [PedidoController::class, 'create'])->name('create');
        Route::post('/', [PedidoController::class, 'store'])->name('store');
        Route::get('/{pedido}', [PedidoController::class, 'show'])->name('show'); 
        Route::get('/{pedido}/edit', [PedidoController::class, 'edit'])->name('edit');
        Route::put('/{pedido}', [PedidoController::class, 'update'])->name('update');
        Route::delete('/{pedido}', [PedidoController::class, 'destroy'])->name('destroy');
    });
    // Alternativa con Route::resource
    // Route::resource('pedidos', PedidoController::class);
});

require __DIR__.'/auth.php';
