<?php

namespace Tests\Unit;

use Leroy\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    public function test_can_create_post() {
        $data = [
            '' => 'faker',
            '' => 'faker',
        ];

        $this->product(route('product'), $data)
            ->assertStatus(201)
            ->assertJson($data);

    }
    public function test_can_update_product() {
        $product = factory(Product::class)->create();
        $data = [
            '' => 'faker',
            '' => 'faker',
        ];
        $this->put(route('product', $product->id), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }
    public function test_can_show_product() {
        $product = factory(Product::class)->create();
        $this->get(route('product', $product->id))
            ->assertStatus(200);
    }
    public function test_can_delete_product() {
        $product = factory(Product::class)->create();
        $this->delete(route('product', $product->id))
            ->assertStatus(200);
    }
    public function test_can_list_product() {
        $product = factory(Product::class, 2)->create()->map(function ($product) {
            return $product->only(['id', 'title', 'content']);
        });
        $this->get(route('product'))
            ->assertStatus(200)
            ->assertJson($product->toArray())
            ->assertJsonStructure([
                '*' => [ 'id', 'title', 'content' ],
            ]);
    }
}
