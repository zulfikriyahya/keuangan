<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\User;
use App\Models\Bulan;
use App\Models\Kelas;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tahun;
use App\Models\Jurusan;
use App\Models\JenisPemasukan;
use App\Models\JenisPembayaran;
use Illuminate\Database\Seeder;
use App\Models\JenisPengeluaran;

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
            'nama' => 'Pembayaran SPP Bulanan',
            'kode' => 'PMB-SPP',
            'kategori' => 'Pembayaran',
            'deskripsi' => 'Deskripsi Pembayaran',
        ]);
        Akun::create([
            'nama' => 'Pembayaran Lainnya',
            'kode' => 'PMB-L',
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
        // SPP 2022
        JenisPembayaran::create([
            'nama' => 'SPP Reguler',
            'akun_id' => 1,
            'tahun_id' => 1,
            'kode' => 'SPP-R-2022',
            'jurusan_id' => 2,
            'nominal' => 60000,
            'deskripsi' => '',
        ]);
        JenisPembayaran::create([
            'nama' => 'SPP Unggulan',
            'akun_id' => 1,
            'tahun_id' => 1,
            'kode' => 'SPP-U-2022',
            'jurusan_id' => 1,
            'nominal' => 100000,
            'deskripsi' => '',
        ]);
        // SPP 2023
        JenisPembayaran::create([
            'nama' => 'SPP Reguler',
            'akun_id' => 1,
            'tahun_id' => 2,
            'kode' => 'SPP-R-2023',
            'jurusan_id' => 2,
            'nominal' => 60000,
            'deskripsi' => '',
        ]);
        JenisPembayaran::create([
            'nama' => 'SPP Unggulan',
            'akun_id' => 1,
            'tahun_id' => 2,
            'kode' => 'SPP-U-2023',
            'jurusan_id' => 1,
            'nominal' => 100000,
            'deskripsi' => '',
        ]);
        // SPP 2024
        JenisPembayaran::create([
            'nama' => 'SPP Reguler',
            'akun_id' => 1,
            'tahun_id' => 3,
            'kode' => 'SPP-R-2024',
            'jurusan_id' => 2,
            'nominal' => 60000,
            'deskripsi' => '',
        ]);
        JenisPembayaran::create([
            'nama' => 'SPP Unggulan',
            'akun_id' => 1,
            'tahun_id' => 3,
            'kode' => 'SPP-U-2024',
            'jurusan_id' => 1,
            'nominal' => 100000,
            'deskripsi' => '',
        ]);
        // SPP 2025
        JenisPembayaran::create([
            'nama' => 'SPP Reguler',
            'akun_id' => 1,
            'tahun_id' => 4,
            'kode' => 'SPP-R-2025',
            'jurusan_id' => 2,
            'nominal' => 20000,
            'deskripsi' => '',
        ]);
        JenisPembayaran::create([
            'nama' => 'SPP Unggulan',
            'akun_id' => 1,
            'tahun_id' => 4,
            'kode' => 'SPP-U-2025',
            'jurusan_id' => 1,
            'nominal' => 50000,
            'deskripsi' => '',
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
