<?php

namespace App\Services;

use App\Events\OrderPlaced;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repositories\InventoryRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use RuntimeException;
use Throwable;

class PlaceOrderService
{
    public function __construct(
        protected InventoryRepository $inventoryRepo,
        protected DatabaseManager $db
    )
    {
        //
    }

    /**
     * @param int $providerId
     * @param array $items
     * @return Order
     * @throws Throwable
     */
    public function placeOrder(int $providerId, array $items): Order
    {
        return $this->db->transaction(function () use ($providerId, $items) {
            $order = Order::create([
                'provider_id' => $providerId,
                'status' => 'pending',
                'total' => 0,
            ]);

            $total = 0;

            foreach ($items as $item) {
                $product = Product::find($item['product_id']);
                if (! $product) {
                    throw new RuntimeException("Product {$item['product_id']} not found");
                }

                $quantity = (int) $item['quantity'];
                if ($quantity <= 0) {
                    throw new RuntimeException("Invalid quantity for product {$product->id}");
                }

                // Inventory: load and check via repository (repository will throw if insufficient)
                $inventory = $this->inventoryRepo->getForProviderAndProduct($providerId, $product->id);

                // Decrement (will throw if insufficient)
                $this->inventoryRepo->decrement($inventory, $quantity);

                $lineTotal = $product->price * $quantity;

                $orderItem = new OrderItem([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'line_total' => $lineTotal,
                ]);

                $order->items()->save($orderItem);

                $total += $lineTotal;
            }

            $order->total = $total;
            $order->status = 'completed';
            $order->save();

            // Fire event (wired to job/listener)
            event(new OrderPlaced($order));

            return $order;
        });
    }
}
