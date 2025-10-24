<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\PlaceOrderService; // ensure this service exists
use App\Http\Requests\PlaceOrderRequest; // optional, if you use FormRequest

class ProviderOrderController extends Controller
{
    protected PlaceOrderService $placeOrderService;

    public function __construct(PlaceOrderService $placeOrderService)
    {
        $this->placeOrderService = $placeOrderService;
    }

    // If you used route with {provider} param, accept it: store(Request $request, $provider)

    /**
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();

        // minimal validation if you don't have PlaceOrderRequest
        if (empty($data['items']) || !is_array($data['items'])) {
            return response()->json(['ok' => false, 'message' => 'items required'], 422);
        }

        $providerId = $data['provider_id'] ?? null; // or get from route param
        if (! $providerId) {
            return response()->json(['ok' => false, 'message' => 'provider_id required'], 422);
        }

        $order = $this->placeOrderService->placeOrder((int)$providerId, $data['items']);

        return response()->json([
            'ok' => true,
            'order_id' => $order->id,
            'message' => 'Order placed'
        ], 200);
    }
}
