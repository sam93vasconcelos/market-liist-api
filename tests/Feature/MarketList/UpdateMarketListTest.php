<?php

namespace Tests\Feature\MarketList;

use App\Models\MarketList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateMarketListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_an_user_can_update_your_own_list()
    {
        $this->seed();

        $authResponse = $this->post('/api/auth/login', [
            "email" => "teste@teste.com",
            "password" => "password"
        ]);

        $list = MarketList::where('user_id', $authResponse['user']['id'])->first();

        $this->put('/api/market-lists/' . $list->id, [
            'title' => 'Updated Test'
        ], [
            'Authorization' => 'Bearer ' . $authResponse['access_token']
        ]);

        $this->assertDatabaseHas('market_lists', [
            'id' => $list->id,
            'title' => 'Updated Test'
        ]);
    }

    public function test_an_unauthenticated_user_cannot_update_a_list()
    {
        $this->seed();

        $list = MarketList::first();

        $response = $this->put('/api/market-lists/' . $list->id, [
            'name' => 'Updated Test'
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }

    public function test_an_user_can_only_update_your_own_list()
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

        $list = MarketList::create([
            'title' => 'test',
            'user_id' => 2
        ]);

        $response = $this->put('/api/market-lists/' . $list->id, [
            'title' => 'Updated Test'
        ], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $authResponse['access_token']
        ]);

        $response->assertStatus(403);
    }
}
