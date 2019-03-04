<?php

namespace Tests\Unit;

use Leroy\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    //test UPDATE, "api/v1/products
    public function test_can_update_product() {
        $product = factory(Product::class)->create();
        $data = [
            'description' => 'faker',
            'name'        => 'faker',
        ];
        $response = $this->json('PUT', "api/v1/products/{$product->id}", $data);
        $this->assertEquals(200, $response->status());
    }

    //test SHOW, "api/v1/products/{id}
    public function test_can_show_product() {
        $product = factory(Product::class)->create();
        $response = $this->json('GET', 'api/v1/products', ['product' => $product->id]);
        $this->assertEquals(200, $response->status());
    }

    //test DELETE, "api/v1/products/{id}
    public function test_can_delete_product() {
        $product = factory(Product::class)->create();
        $response = $this->json('DELETE', "api/v1/products/{$product->id}");
        $this->assertEquals(204, $response->status());
    }

    //test INDEX, "api/v1/products
    public function test_can_list_product() {
        $product = factory(Product::class,2)->create();
        $response = $this->json('GET', 'api/v1/products');
        $this->assertEquals(200, $response->status());
    }
}
