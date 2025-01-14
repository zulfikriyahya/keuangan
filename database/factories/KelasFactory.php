<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Jurusan;
use App\Models\Kelas;

class KelasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kelas::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'tingkat' => $this->faker->randomElement(["PAUD","TK","1","2","3","4","5","6","7","8","9","10","11","12"]),
            'jenjang' => $this->faker->randomElement(["PAUD","TK","SD","SMP","SMA"]),
            'jurusan_id' => Jurusan::factory(),
        ];
    }
}
