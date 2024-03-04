<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostSalesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_sales_endpoint_post()
    {
        // $sale = [
        //     'customer_id'    => 1,
        //     'store_id'       => 1,
        //     'payment_method' => "débito",
        //     'status_pay'     => "efetuado",
        //     'status_delivery'=> "pendente",
        //     'products' => [
        //         'sale_id' => 1,
        //         'product_id' => 1,
        //         'amount' => 1,
        //         'price' => 1000
        //     ]
        // ];

        // $response = $this->post('/api/sales/register-batch', $sale);
        // $response->assertStatus(201);
        // $this->assertDatabaseHas('sales', $sale);
    }
}
