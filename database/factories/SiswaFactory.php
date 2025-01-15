<?php

namespace Database\Factories;

use App\Models\Kela;
use App\Models\Kelas;
use App\Models\KelasTahun;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Siswa::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'diterima_tanggal' => $this->faker->date(),
            'diterima_dikelas' => Kela::factory()->create()->diterima_dikelas,
            'kelas_tahun_id' => KelasTahun::factory(),
            'status' => $this->faker->randomElement(['Aktif', 'Nonaktif']),
            'foto' => $this->faker->word(),
            'alamat' => $this->faker->word(),
            'nama_ibu' => $this->faker->word(),
            'nama_ayah' => $this->faker->word(),
            'telepon' => $this->faker->word(),
            'kelas_id' => Kelas::factory(),
        ];
    }
}
