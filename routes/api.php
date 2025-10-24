<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProviderOrderController;

Route::post('provider/orders', [ProviderOrderController::class, 'store'])->name('provider.orders.store');
Route::get('ping', function () {
    return response()->json(['pong' => true]);
});
// Optional: route with provider id in path
// Route::post('providers/{provider}/orders', [ProviderOrderController::class, 'store'])->name('provider.orders.store');
