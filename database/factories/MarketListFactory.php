<?php

namespace Database\Factories;

use App\Models\MarketList;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MarketList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'user_id' => 1
        ];
    }
}
