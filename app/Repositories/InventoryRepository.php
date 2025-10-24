<?php

namespace App\Repositories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RuntimeException;

class InventoryRepository
{
    public function getForProviderAndProduct(int $providerId, int $productId): Inventory
    {
        return Inventory::firstWhere(['provider_id' => $providerId, 'product_id' => $productId])
            ?? throw new ModelNotFoundException("Inventory not found for provider {$providerId} and product {$productId}");
    }

    /**
     * Decrement inventory or throw if not enough quantity.
     *
     * @throws RuntimeException
     */
    public function decrement(Inventory $inventory, int $qty): Inventory
    {
        if ($qty <= 0) {
            return $inventory;
        }

        if ($inventory->quantity < $qty) {
            throw new RuntimeException("Not enough inventory for product_id {$inventory->product_id}");
        }

        $inventory->quantity -= $qty;
        $inventory->save();

        return $inventory;
    }
}
