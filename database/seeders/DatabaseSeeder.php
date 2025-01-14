<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Bulan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tahun;
use App\Models\Periode;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
        ]);
        Tahun::create([
            'nama' => '2022',
        ]);
        Tahun::create([
            'nama' => '2023',
        ]);
        Tahun::create([
            'nama' => '2024',
        ]);
        Tahun::create([
            'nama' => '2025',
        ]);
        Tahun::create([
            'nama' => '2026',
        ]);

        Bulan::create([
            'nama' => 'Januari',
        ]);
        Bulan::create([
            'nama' => 'Februari',
        ]);
        Bulan::create([
            'nama' => 'Maret',
        ]);
        Bulan::create([
            'nama' => 'April',
        ]);
        Bulan::create([
            'nama' => 'Mei',
        ]);
        Bulan::create([
            'nama' => 'Juni',
        ]);
        Bulan::create([
            'nama' => 'Juli',
        ]);
        Bulan::create([
            'nama' => 'Agustus',
        ]);
        Bulan::create([
            'nama' => 'September',
        ]);
        Bulan::create([
            'nama' => 'Oktober',
        ]);
        Bulan::create([
            'nama' => 'November',
        ]);
        Bulan::create([
            'nama' => 'Desember',
        ]);

        Periode::create([
            'tahun_id' => '1',
            'bulan_id' => '1',
        ]);
        Periode::create([
            'tahun_id' => '1',
            'bulan_id' => '2',
        ]);
        Periode::create([
            'tahun_id' => '1',
            'bulan_id' => '3',
        ]);
        Periode::create([
            'tahun_id' => '1',
            'bulan_id' => '4',
        ]);
        Periode::create([
            'tahun_id' => '1',
            'bulan_id' => '5',
        ]);
        Periode::create([
            'tahun_id' => '1',
            'bulan_id' => '6',
        ]);
        Periode::create([
            'tahun_id' => '1',
            'bulan_id' => '7',
        ]);
        Periode::create([
            'tahun_id' => '1',
            'bulan_id' => '8',
        ]);
        Periode::create([
            'tahun_id' => '1',
            'bulan_id' => '9',
        ]);
        Periode::create([
            'tahun_id' => '1',
            'bulan_id' => '10',
        ]);
        Periode::create([
            'tahun_id' => '1',
            'bulan_id' => '11',
        ]);
        Periode::create([
            'tahun_id' => '1',
            'bulan_id' => '12',
        ]);

        Periode::create([
            'tahun_id' => '2',
            'bulan_id' => '1',
        ]);
        Periode::create([
            'tahun_id' => '2',
            'bulan_id' => '2',
        ]);
        Periode::create([
            'tahun_id' => '2',
            'bulan_id' => '3',
        ]);
        Periode::create([
            'tahun_id' => '2',
            'bulan_id' => '4',
        ]);
        Periode::create([
            'tahun_id' => '2',
            'bulan_id' => '5',
        ]);
        Periode::create([
            'tahun_id' => '2',
            'bulan_id' => '6',
        ]);
        Periode::create([
            'tahun_id' => '2',
            'bulan_id' => '7',
        ]);
        Periode::create([
            'tahun_id' => '2',
            'bulan_id' => '8',
        ]);
        Periode::create([
            'tahun_id' => '2',
            'bulan_id' => '9',
        ]);
        Periode::create([
            'tahun_id' => '2',
            'bulan_id' => '10',
        ]);
        Periode::create([
            'tahun_id' => '2',
            'bulan_id' => '11',
        ]);
        Periode::create([
            'tahun_id' => '2',
            'bulan_id' => '12',
        ]);

        Periode::create([
            'tahun_id' => '3',
            'bulan_id' => '1',
        ]);
        Periode::create([
            'tahun_id' => '3',
            'bulan_id' => '2',
        ]);
        Periode::create([
            'tahun_id' => '3',
            'bulan_id' => '3',
        ]);
        Periode::create([
            'tahun_id' => '3',
            'bulan_id' => '4',
        ]);
        Periode::create([
            'tahun_id' => '3',
            'bulan_id' => '5',
        ]);
        Periode::create([
            'tahun_id' => '3',
            'bulan_id' => '6',
        ]);
        Periode::create([
            'tahun_id' => '3',
            'bulan_id' => '7',
        ]);
        Periode::create([
            'tahun_id' => '3',
            'bulan_id' => '8',
        ]);
        Periode::create([
            'tahun_id' => '3',
            'bulan_id' => '9',
        ]);
        Periode::create([
            'tahun_id' => '3',
            'bulan_id' => '10',
        ]);
        Periode::create([
            'tahun_id' => '3',
            'bulan_id' => '11',
        ]);
        Periode::create([
            'tahun_id' => '3',
            'bulan_id' => '12',
        ]);

        Periode::create([
            'tahun_id' => '4',
            'bulan_id' => '1',
        ]);
        Periode::create([
            'tahun_id' => '4',
            'bulan_id' => '2',
        ]);
        Periode::create([
            'tahun_id' => '4',
            'bulan_id' => '3',
        ]);
        Periode::create([
            'tahun_id' => '4',
            'bulan_id' => '4',
        ]);
        Periode::create([
            'tahun_id' => '4',
            'bulan_id' => '5',
        ]);
        Periode::create([
            'tahun_id' => '4',
            'bulan_id' => '6',
        ]);
        Periode::create([
            'tahun_id' => '4',
            'bulan_id' => '7',
        ]);
        Periode::create([
            'tahun_id' => '4',
            'bulan_id' => '8',
        ]);
        Periode::create([
            'tahun_id' => '4',
            'bulan_id' => '9',
        ]);
        Periode::create([
            'tahun_id' => '4',
            'bulan_id' => '10',
        ]);
        Periode::create([
            'tahun_id' => '4',
            'bulan_id' => '11',
        ]);
        Periode::create([
            'tahun_id' => '4',
            'bulan_id' => '12',
        ]);

        Periode::create([
            'tahun_id' => '5',
            'bulan_id' => '1',
        ]);
        Periode::create([
            'tahun_id' => '5',
            'bulan_id' => '2',
        ]);
        Periode::create([
            'tahun_id' => '5',
            'bulan_id' => '3',
        ]);
        Periode::create([
            'tahun_id' => '5',
            'bulan_id' => '4',
        ]);
        Periode::create([
            'tahun_id' => '5',
            'bulan_id' => '5',
        ]);
        Periode::create([
            'tahun_id' => '5',
            'bulan_id' => '6',
        ]);
        Periode::create([
            'tahun_id' => '5',
            'bulan_id' => '7',
        ]);
        Periode::create([
            'tahun_id' => '5',
            'bulan_id' => '8',
        ]);
        Periode::create([
            'tahun_id' => '5',
            'bulan_id' => '9',
        ]);
        Periode::create([
            'tahun_id' => '5',
            'bulan_id' => '10',
        ]);
        Periode::create([
            'tahun_id' => '5',
            'bulan_id' => '11',
        ]);
        Periode::create([
            'tahun_id' => '5',
            'bulan_id' => '12',
        ]);
    }
}
