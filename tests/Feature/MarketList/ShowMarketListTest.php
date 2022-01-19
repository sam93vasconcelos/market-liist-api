<?php

namespace Tests\Feature\MarketList;

use App\Models\MarketList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowMarketListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_an_user_can_show_your_list()
    {
        $this->seed();

        $authResponse = $this->post('/api/auth/login', [
            "email" => "teste@teste.com",
            "password" => "password"
        ]);


        $response = $this->get('/api/market-lists/' . 1, [
            'Authorization' => 'Bearer ' . $authResponse['access_token']
        ]);

        $response->assertStatus(200);
    }

    public function test_an_unauthenticated_user_cannot_show_lists()
    {
        $this->seed();

        $response = $this->get('/api/market-lists/' . 1, [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }

    public function test_an_user_can_only_show_your_own_list()
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


        $response = $this->get('/api/market-lists/' . $list->id, [
            'Authorization' => 'Bearer ' . $authResponse['access_token']
        ]);

        $response->assertStatus(403);
    }
}
