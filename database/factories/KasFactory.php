<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Kas;
use App\Models\Pemasukan;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Periode;

class KasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kas::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'pembayaran_id' => Pembayaran::factory(),
            'pengeluaran_id' => Pengeluaran::factory(),
            'pemasukan_id' => Pemasukan::factory(),
            'saldo' => $this->faker->numberBetween(-10000, 10000),
            'periode_id' => Periode::factory(),
        ];
    }
}
