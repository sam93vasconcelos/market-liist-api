<?php

namespace Tests\Feature\MarketList;

use App\Models\MarketList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteMarketListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_an_unauthenticated_users_cannot_delete_a_market_list()
    {
        $this->seed();

        $response = $this->delete('/api/market-lists/1', [], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }

    public function test_a_user_can_delete_a_market_list()
    {
        $this->seed();

        $authResponse = $this->post('/api/auth/login', [
            "email" => "teste@teste.com",
            "password" => "password"
        ]);

        $response = $this->delete('/api/market-lists/1', [], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $authResponse['access_token']
        ]);

        $response->assertStatus(204);
    }

    public function test_a_user_can_only_delete_your_own_market_list()
    {
        $this->seed();

        $authResponse = $this->post('/api/auth/login', [
            "email" => "teste@teste.com",
            "password" => "password"
        ]);

        User::create([
            'name' => 'test',
            'email' => 'a@a.c',
            'password' => 'laslsdknalsdf'
        ]);

        MarketList::create([
            'name' => 'test',
            'user_id' => 2
        ]);

        $response = $this->delete('/api/market-lists/2', [], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $authResponse['access_token']
        ]);

        $response->assertStatus(403);
    }
}
