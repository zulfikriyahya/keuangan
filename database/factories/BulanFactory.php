<?php

namespace Database\Factories;

use App\Models\Bulan;
use Illuminate\Database\Eloquent\Factories\Factory;

class BulanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bulan::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
        ];
    }
}
