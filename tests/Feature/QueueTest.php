<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Leroy\Jobs\CreateProductsFromXls;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class QueueTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    /**
     * This test, assert queue of products.
     *
     * @return void
     */
    public function test_queue_products()
    {

        Queue::fake();
        $file = UploadedFile::fake()->create('planilha.xlsx');
        $pathProductsXls = Storage::putFileAs('uploads', $file, $file->getClientOriginalName());

        CreateProductsFromXls::dispatch($pathProductsXls);

        Queue::assertPushed(CreateProductsFromXls::class, function ($job) use ($pathProductsXls) {
        });

        Storage::delete($pathProductsXls);

    }

}
