<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MarketListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MarketList::factory(1)->create();
    }
}
