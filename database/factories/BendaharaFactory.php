<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Bendahara;

class BendaharaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bendahara::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'foto' => $this->faker->word(),
            'nip' => $this->faker->word(),
            'periode_awal' => $this->faker->date(),
            'periode_akhir' => $this->faker->date(),
            'status' => $this->faker->randomElement(["Aktif","Nonaktif"]),
            'tte' => $this->faker->word(),
            'telepon' => $this->faker->word(),
        ];
    }
}
