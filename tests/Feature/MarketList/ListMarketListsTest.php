<?php

namespace Tests\Feature\MarketList;

use App\Models\MarketList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListMarketListsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_list_all_your_lists()
    {
        $this->seed();

        $authResponse = $this->post('/api/auth/login', [
            "email" => "teste@teste.com",
            "password" => "password"
        ]);

        MarketList::create([
            'name' => 'Test',
            'user_id' => $authResponse['user']['id']
        ]);

        $response = $this->get('/api/market-lists', [
            'Authorization' => 'Bearer ' . $authResponse['access_token']
        ]);

        $response->assertStatus(200);
    }
}
