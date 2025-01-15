<?php

namespace Database\Factories;

use App\Models\Bulan;
use App\Models\Periode;
use App\Models\Tahun;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeriodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Periode::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tahun_id' => Tahun::factory(),
            'bulan_id' => Bulan::factory(),
        ];
    }
}
