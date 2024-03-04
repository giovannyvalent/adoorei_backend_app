<?php

namespace Tests\Feature;

use App\Models\Sales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SalesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_sales_endpoint_get()
    {
        $response = $this->getJson('/api/sales/all');
        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json){
            $json->whereType('0.sales_id', 'integer');
            $json->whereType('0.store_id', 'integer');
            $json->whereType('0.price_total', 'integer');
        });
    }
}
