<?php

namespace Database\Factories;

use App\Models\JenisPengeluaran;
use App\Models\Pengeluaran;
use App\Models\Periode;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengeluaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pengeluaran::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'kode' => $this->faker->word(),
            'tanggal' => $this->faker->date(),
            'periode_id' => Periode::factory(),
            'nominal' => $this->faker->numberBetween(-10000, 10000),
            'kwitansi' => $this->faker->word(),
            'jenis_pengeluaran_id' => JenisPengeluaran::factory(),
            'deskripsi' => $this->faker->word(),
        ];
    }
}
