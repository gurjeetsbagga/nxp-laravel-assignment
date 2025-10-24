<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        // In this exercise we allow the request.
        // In production, check that the authenticated user can place orders for provider_id.
        return true;
    }

    public function rules(): array
    {
        return [
            'provider_id' => ['required','exists:providers,id'],
            'items' => ['required','array','min:1'],
            'items.*.product_id' => ['required','exists:products,id'],
            'items.*.quantity' => ['required','integer','min:1'],
        ];
    }
}
