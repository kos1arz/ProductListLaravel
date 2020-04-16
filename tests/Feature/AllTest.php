<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Product;
use App\Price;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AllTest extends TestCase
{
    use RefreshDatabase;

    // Registar

    public function testNoAuthUserCanEnterToRegisterTest()
    {
        $response = $this->get('/register')->assertRedirect('/login');
    }

    // Price

    public function testAuthUserCreatePriceTest()
    {
        $this->actingAs(factory(User::class)->create());
        $price = $this->post('prices/1',[
            'amount' => 10
        ]);

        $this->assertCount(1, Price::all());
    }

    public function testNoAuthUserCreatePriceTest()
    {
        $price = $this->post('prices',[
            'amount' => 10.99
        ]);

        $this->assertCount(0, Price::all());
    }

    // Product

    public function testNoAuthUserCanEnterToProductsCreateTest()
    {
        $response = $this->get('/products/create')->assertRedirect('/login');
    } 

    public function testAuthUserCanEnterToProductsCreateTest()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/products/create')->assertOk();
    }

    public function testAuthUserCreateProductTest()
    {
        $this->actingAs(factory(User::class)->create());
        $this->post('products',[
            'name' => 'Toy',
            'description' => 'Lorem'
        ]);

        $this->assertCount(1, Product::all());
    }

    public function testNoAuthUserCreateProductTest()
    {  
        $this->post('products',[
            'name' => 'Toy',
            'description' => 'Lorem'
        ]);

        $this->assertCount(0, Product::all());
    }
}
