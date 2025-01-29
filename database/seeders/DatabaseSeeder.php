<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\User;
use App\Models\Bulan;
use App\Models\Tahun;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Jurusan;
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
        Jurusan::create([
            'nama' => 'Non Jurusan',
            'kode' => 'NON',
        ]);
        Jurusan::create([
            'nama' => 'Ilmu Pengetahuan Alam',
            'kode' => 'IPA',
        ]);
        Jurusan::create([
            'nama' => 'Ilmu Pengetahuan Sosial',
            'kode' => 'IPS',
        ]);
        Jurusan::create([
            'nama' => 'Unggulan',
            'kode' => 'UNG',
        ]);
        Jurusan::create([
            'nama' => 'Reguler',
            'kode' => 'REG',
        ]);
        Akun::create([
            'nama' => 'Pemasukan',
            'kode' => 'PMS',
            'deskripsi' => 'Deskripsi Pemasukan',
        ]);
        Akun::create([
            'nama' => 'Pembayaran',
            'kode' => 'PMB',
            'deskripsi' => 'Deskripsi Pembayaran',
        ]);
        Akun::create([
            'nama' => 'Pengeluaran',
            'kode' => 'PNG',
            'deskripsi' => 'Deskripsi Pengeluaran',
        ]);
    }
}
