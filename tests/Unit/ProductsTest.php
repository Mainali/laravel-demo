<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
class ProductsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostProduct(){
        Session::start();
        $response = $this->json('POST', '/products/store', ['_token' => csrf_token(),'name' => 'someproduct','quantity' => 10, 'price' => 5]);

        $response
            ->assertStatus(200)
            ->assertJson(['name' => 'someproduct','quantity' => 10, 'price' => 5]);

    }

    public function testGetProducts(){
        Session::start();
        $this->json('POST', '/products/store', ['_token' => csrf_token(),'name' => 'someproduct','quantity' => 10, 'price' => 5]);

        $response = $this->json('GET', '/products');

        $response
            ->assertStatus(200);
    }

    public function testLandingPage(){
        $response = $this->json('GET', '/');
        $response->assertViewIs('welcome');
    }
}
