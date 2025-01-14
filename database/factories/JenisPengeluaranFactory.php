<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Akun;
use App\Models\JenisPengeluaran;

class JenisPengeluaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JenisPengeluaran::class;

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
