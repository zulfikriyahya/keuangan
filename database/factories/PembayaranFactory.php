<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\JenisPembayaran;
use App\Models\Pembayaran;
use App\Models\Periode;
use App\Models\Siswa;

class PembayaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pembayaran::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'kode' => $this->faker->word(),
            'tanggal' => $this->faker->date(),
            'jenis_pembayaran_id' => JenisPembayaran::factory(),
            'deskripsi' => $this->faker->word(),
            'periode_id' => Periode::factory(),
            'nominal' => $this->faker->numberBetween(-10000, 10000),
            'kwitansi' => $this->faker->word(),
            'status' => $this->faker->randomElement(["Lunas","Terhutang"]),
            'siswa_id' => Siswa::factory(),
        ];
    }
}
