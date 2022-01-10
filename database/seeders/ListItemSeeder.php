<?php

namespace Database\Seeders;

use App\Models\ListItem;
use Illuminate\Database\Seeder;

class ListItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListItem::factory(10)->create();
    }
}
