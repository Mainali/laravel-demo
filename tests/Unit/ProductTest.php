<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function TestPostProduct(){
            $response = $this->json('POST', '/products/store', ['name' => 'someproduct','quantity' => 10, 'price' => 5]);

            $response
                ->assertStatus(200)
                ->assertJson(['name' => 'someproduct','quantity' => 10, 'price' => 5]);

    }

    public function TestGetProducts(){
        $this->json('POST', '/products/store', ['name' => 'someproduct','quantity' => 10, 'price' => 5]);
        $this->json('POST', '/products/store', ['name' => 'nextproduct','quantity' => 20, 'price' => 6]);

        $response = $this->json('GET', '/products');

        $response
            ->assertStatus(200)
            ->assertExactJson([
                ['name' => 'someproduct','quantity' => 10, 'price' => 5],
                ['name' => 'nextproduct','quantity' => 20, 'price' => 6]
            ]);

    }
}
