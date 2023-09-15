<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_price_is_shown_correctly(): void
    {
        $product = Product::factory()->create([ 
            'price' => 333.79
        ]);

        $response = $this->get('/api/v1/products/' . $product->id);

        $response->assertStatus(200);
        $response->assertJsonFragment(['price' => json_encode($product->price)]);
    }
}
