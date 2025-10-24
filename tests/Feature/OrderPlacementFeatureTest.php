<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderPlacementFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_provider_can_place_order_happy_path(): void
    {
        $this->seed(\Database\Seeders\DemoSeeder::class);

        $provider = Provider::first();
        $product = Product::first();

        $payload = [
            'provider_id' => $provider->id,
            'items' => [
                ['product_id' => $product->id, 'quantity' => 1],
            ],
        ];

        $response = $this->postJson('/api/provider/orders', $payload);

        $response->assertStatus(200)->assertJson(['ok' => true]);

        $this->assertDatabaseHas('orders', ['provider_id' => $provider->id, 'status' => 'completed']);
    }

    public function test_fails_when_not_enough_inventory(): void
    {
        $this->seed(\Database\Seeders\DemoSeeder::class);

        $provider = Provider::first();
        $product = Product::first();

        $payload = [
            'provider_id' => $provider->id,
            'items' => [
                ['product_id' => $product->id, 'quantity' => 9999],
            ],
        ];

        $response = $this->postJson('/api/provider/orders', $payload);

        // We return 422 for domain/business validation failures
        $response->assertStatus(422)
            ->assertJson(['ok' => false]);
    }
}
