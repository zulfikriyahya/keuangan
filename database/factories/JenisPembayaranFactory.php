<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Akun;
use App\Models\JenisPembayaran;
use App\Models\Jurusan;

class JenisPembayaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JenisPembayaran::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'akun_id' => Akun::factory(),
            'kode' => $this->faker->word(),
            'jurusan_id' => Jurusan::factory(),
            'deskripsi' => $this->faker->word(),
        ];
    }
}
