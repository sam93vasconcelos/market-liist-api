<?php

namespace Tests\Feature\MarketLists;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_new_list()
    {
        $this->seed();

        $authResponse = $this->post('/api/auth/login', [
            "email" => "teste@teste.com",
            "password" => "password"
        ]);


        $response = $this->post('/api/market-lists', [
            'name' => 'Test',
            'user_id' => $authResponse['user']['id']
        ], [
            'Authorization' => 'Bearer ' . $authResponse['access_token']
        ]);

        $response->assertStatus(201);
    }
}
