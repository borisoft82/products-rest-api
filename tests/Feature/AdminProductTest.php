<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_user_can_not_add_product(): void
    {
        $response = $this->postJson('/api/v1/admin/products');

        $response->assertStatus(401);
    }

    public function test_non_admin_user_can_not_add_product(): void
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', 'editor')->value('id'));

        $response = $this->actingAs($user)->postJson('/api/v1/admin/products');

        $response->assertStatus(403);
    }

    public function test_admin_user_can_add_product_providing_validated_data(): void
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', 'admin')->value('id'));

        $response = $this->actingAs($user)->postJson('/api/v1/admin/products', [
            'name' => 'New product'
        ]);

        $response->assertStatus(422);

        $response = $this->actingAs($user)->postJson('/api/v1/admin/products', [
            'name' => 'New product',
            'description' => 'New description',
            'price' => 50000
        ]);

        $response->assertStatus(201);
        
        $response = $this->get('/api/v1/products');
        $response->assertJsonFragment(['name' => 'New product']);

    }
}
