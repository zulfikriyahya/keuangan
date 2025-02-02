<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\User;
use App\Models\Bulan;
use App\Models\Kelas;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tahun;
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
            'role' => 'super_admin',
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
            'nama' => 'Unggulan',
            'kode' => 'UNG',
        ]);
        Jurusan::create([
            'nama' => 'Reguler',
            'kode' => 'REG',
        ]);
        Akun::create([
            'nama' => 'Pembayaran',
            'kode' => 'PMB',
            'kategori' => 'Pembayaran',
            'deskripsi' => 'Deskripsi Pembayaran',
        ]);
        Akun::create([
            'nama' => 'Pemasukan',
            'kode' => 'PMS',
            'kategori' => 'Pemasukan',
            'deskripsi' => 'Deskripsi Pemasukan',
        ]);
        Akun::create([
            'nama' => 'Pengeluaran',
            'kode' => 'PNG',
            'kategori' => 'Pengeluaran',
            'deskripsi' => 'Deskripsi Pengeluaran',
        ]);
        Kelas::create([
            'nama' => 'VII A',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '7',
            'jurusan_id' => 1,
        ]);
        Kelas::create([
            'nama' => 'VII B',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '7',
            'jurusan_id' => 1,
        ]);
        Kelas::create([
            'nama' => 'VII C',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '7',
            'jurusan_id' => 1,
        ]);
        Kelas::create([
            'nama' => 'VII D',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '7',
            'jurusan_id' => 1,
        ]);
        Kelas::create([
            'nama' => 'VII E',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '7',
            'jurusan_id' => 1,
        ]);

        Kelas::create([
            'nama' => 'VII F',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '7',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'VII G',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '7',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'VII H',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '7',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'VII I',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '7',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'VII J',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '7',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'VII K',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '7',
            'jurusan_id' => 2,
        ]);


        Kelas::create([
            'nama' => 'VIII A',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '8',
            'jurusan_id' => 1,
        ]);
        Kelas::create([
            'nama' => 'VIII B',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '8',
            'jurusan_id' => 1,
        ]);
        Kelas::create([
            'nama' => 'VIII C',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '8',
            'jurusan_id' => 1,
        ]);
        Kelas::create([
            'nama' => 'VIII D',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '8',
            'jurusan_id' => 1,
        ]);
        Kelas::create([
            'nama' => 'VIII E',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '8',
            'jurusan_id' => 1,
        ]);

        Kelas::create([
            'nama' => 'VIII F',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '8',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'VIII G',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '8',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'VIII H',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '8',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'VIII I',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '8',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'VIII J',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '8',
            'jurusan_id' => 2,
        ]);

        Kelas::create([
            'nama' => 'IX A',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '9',
            'jurusan_id' => 1,
        ]);
        Kelas::create([
            'nama' => 'IX B',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '9',
            'jurusan_id' => 1,
        ]);
        Kelas::create([
            'nama' => 'IX C',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '9',
            'jurusan_id' => 1,
        ]);
        Kelas::create([
            'nama' => 'IX D',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '9',
            'jurusan_id' => 1,
        ]);
        Kelas::create([
            'nama' => 'IX E',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '9',
            'jurusan_id' => 1,
        ]);

        Kelas::create([
            'nama' => 'IX F',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '9',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'IX G',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '9',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'IX H',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '9',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'IX I',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '9',
            'jurusan_id' => 2,
        ]);
        Kelas::create([
            'nama' => 'IX J',
            'jenjang' => 'SMP/MTS',
            'tingkat' => '9',
            'jurusan_id' => 2,
        ]);
    }
}
