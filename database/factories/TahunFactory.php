<?php

namespace Database\Factories;

use App\Models\Tahun;
use Illuminate\Database\Eloquent\Factories\Factory;

class TahunFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tahun::class;

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
