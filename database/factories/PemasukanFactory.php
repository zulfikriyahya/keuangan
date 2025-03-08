<?php

namespace Database\Factories;

use App\Models\JenisPemasukan;
use App\Models\Pemasukan;
use App\Models\Periode;
use Illuminate\Database\Eloquent\Factories\Factory;

class PemasukanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pemasukan::class;

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
            'jenis_pemasukan_id' => JenisPemasukan::factory(),
            'deskripsi' => $this->faker->word(),
        ];
    }
}
