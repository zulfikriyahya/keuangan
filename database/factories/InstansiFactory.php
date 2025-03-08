<?php

namespace Database\Factories;

use App\Models\Bendahara;
use App\Models\Instansi;
use App\Models\Pimpinan;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstansiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Instansi::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'npsn' => $this->faker->word(),
            'nss' => $this->faker->word(),
            'logo' => $this->faker->word(),
            'email' => $this->faker->safeEmail(),
            'telepon' => $this->faker->word(),
            'website' => $this->faker->word(),
            'alamat' => $this->faker->word(),
            'kode_pos' => $this->faker->word(),
            'pimpinan_id' => Pimpinan::factory(),
            'bendahara_id' => Bendahara::factory(),
            'nama_bank' => $this->faker->word(),
            'nama_rekening' => $this->faker->word(),
            'nomor_rekening' => $this->faker->word(),
        ];
    }
}
