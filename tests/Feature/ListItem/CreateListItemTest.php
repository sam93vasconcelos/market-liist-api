<?php

namespace Tests\Feature\ListItem;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateListItemTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_an_user_can_create_a_list_item()
    {
        $this->seed();

        $authResponse = $this->post('/api/auth/login', [
            "email" => "teste@teste.com",
            "password" => "password"
        ]);

        $response = $this->post('/api/list-items', [
            'name' => 'test',
            'qty' => 5,
            'market_list_id' => 1
        ], [
            'Authorization' => 'Bearer ' . $authResponse['access_token']
        ]);

        $response->assertStatus(200);
    }

    public function test_an_unauthenticated_user_cannot_create_a_list_item()
    {
        $this->seed();

        $response = $this->post('/api/list-items', [
            'name' => 'test',
            'qty' => 5,
            'market_list_id' => 1
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }
}
