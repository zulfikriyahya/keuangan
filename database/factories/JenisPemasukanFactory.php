<?php

namespace Database\Factories;

use App\Models\Akun;
use App\Models\JenisPemasukan;
use Illuminate\Database\Eloquent\Factories\Factory;

class JenisPemasukanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JenisPemasukan::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'akun_id' => Akun::factory(),
            'kode' => $this->faker->word(),
            'deskripsi' => $this->faker->word(),
        ];
    }
}
