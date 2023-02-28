<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * @test
     * To run the Feature, it is required to run npm run dev in order to resolve Vite manifest not found
     */
    public function application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_add_item__to_cart()
    {
        $response = $this->post('/add-to-cart',[
            'name' => 'iPhone 14 Pro Max',
            'amount' => '999'
        ]);

        $items = session()->get('items');
        $response->assertStatus(302);
        $this->assertEquals([[
            'name' => 'iPhone 14 Pro Max',
            'amount' => '999'
        ]], $items);
    }
}
