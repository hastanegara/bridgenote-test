<?php

namespace Database\Factories;

use App\Models\UserPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPosition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'position' => $this->faker->words(2, true)
        ];
    }
}
