<?php

namespace Tests\Feature\ListItem;

use App\Models\ListItem;
use App\Models\MarketList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteListItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_an_unauthenticated_user_cannot_delete_a_list_item()
    {
        $this->seed();

        $response = $this->delete('/api/list-items/1', [], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(401);
    }

    public function test_a_user_can_delete_a_list_item()
    {
        $this->seed();

        $authResponse = $this->post('/api/auth/login', [
            "email" => "teste@teste.com",
            "password" => "password"
        ]);

        $response = $this->delete('/api/list-items/1', [], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $authResponse['access_token']
        ]);



        $response->assertStatus(204);
    }

    public function test_a_user_can_only_delete_your_own_list_item()
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

        $marketList = MarketList::create([
            'title' => 'test',
            'user_id' => 2
        ]);

        $listItem = ListItem::create([
            'name' => 'test',
            'market_list_id' => $marketList->id
        ]);

        $response = $this->delete('/api/list-items/' . $listItem->id, [], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $authResponse['access_token']
        ]);

        $response->assertStatus(403);
    }
}
