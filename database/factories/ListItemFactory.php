<?php

namespace Database\Factories;

use App\Models\ListItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ListItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'qty' => rand(1, 10),
            'done' => rand(0, 1),
            'market_list_id' => 1,
        ];
    }
}
