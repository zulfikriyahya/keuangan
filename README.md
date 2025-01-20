<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Tentang Aplikasi Keuangan

Aplikasi Keuangan adalah sebuah platform digital yang dirancang untuk memudahkan proses pengelolaan keuangan pribadi atau bisnis. Dengan berbagai fitur yang komprehensif, aplikasi ini menjadi solusi terbaik untuk mengelola keuangan Anda secara efisien dan akurat.

## Fitur

- **Pelacakan Pengeluaran dan Pemasukan**  
  Fitur ini memungkinkan pengguna untuk mencatat dan memonitor setiap transaksi pengeluaran dan pemasukan yang dilakukan. Pengguna dapat mengkategorikan setiap transaksi untuk analisis yang lebih mendetail.

- **Laporan Keuangan Harian, Mingguan, dan Bulanan**  
  Aplikasi ini menyediakan laporan keuangan yang lengkap dan akurat dalam berbagai periode waktu. Laporan ini membantu pengguna untuk memahami kondisi keuangan mereka dengan lebih baik.

- **Grafik dan Diagram untuk Visualisasi Data Keuangan**  
  Data keuangan akan disajikan dalam bentuk grafik dan diagram yang mudah dipahami. Visualisasi ini memudahkan pengguna untuk melihat tren dan pola pengeluaran serta pemasukan.

- **Pengingat Pembayaran Tagihan**  
  Pengguna dapat mengatur pengingat untuk berbagai tagihan yang harus dibayar. Fitur ini memastikan tidak ada tagihan yang terlewatkan dan membantu menghindari denda keterlambatan.

- **Dukungan Multi-User**  
  Aplikasi ini mendukung penggunaan oleh beberapa pengguna dengan akun yang terpisah. Fitur ini cocok untuk keluarga atau bisnis yang ingin mengelola keuangan bersama-sama.

>Dengan aplikasi Keuangan, proses pengelolaan keuangan menjadi lebih mudah, cepat, dan akurat. Fitur-fitur yang disediakan dirancang untuk memenuhi kebutuhan berbagai jenis pengguna, memastikan bahwa setiap transaksi keuangan tercatat dengan baik.


## Peran

- **Administrator**  
  Bertanggung jawab mengelola seluruh sistem aplikasi Keuangan. Mereka memiliki akses penuh untuk konfigurasi, manajemen pengguna, serta pemeliharaan data dan sistem. Administrator juga bertugas memastikan semua fitur berjalan dengan baik dan melakukan pembaruan jika diperlukan.

- **Pengguna**  
  Dapat mengakses dan mengelola data keuangan mereka melalui aplikasi Keuangan. Mereka dapat mencatat transaksi, melihat laporan keuangan, mengatur pengingat pembayaran, dan memanfaatkan fitur-fitur lainnya yang tersedia.

## Persyaratan

- Web Server
- PHP 8.3
- MySQL
- Composer
- Git

## Kerangka Kerja

- Laravel

## Instalasi

Berikut adalah langkah-langkah untuk menginstal aplikasi Keuangan:

1. **Clone repositori**

    ```sh
    git clone https://github.com/zulfikriyahya/keuangan.git
    ```

2. **Masuk ke direktori proyek**

    ```sh
    cd keuangan
    ```

3. **Instal dependensi menggunakan Composer**

    ```sh
    composer install
    ```

4. **Salin file konfigurasi**

    ```sh
    cp .env-example .env
    ```

5. **Generate kunci aplikasi**

    ```sh
    php artisan key:generate
    ```

6. **Migrasi database**

    ```sh
    php artisan migrate:fresh
    ```

7. **Buat pengguna Filament**

    ```sh
    php artisan make:filament-user
    ```

8. **Jalankan server aplikasi**

    ```sh
    php artisan serve
    ```

Setelah mengikuti langkah-langkah di atas, aplikasi Keuangan siap digunakan. Pastikan semua konfigurasi dan dependensi telah terinstal dengan benar.

## Lisensi

Aplikasi Keuangan adalah perangkat lunak sumber terbuka yang dilisensikan di bawah [lisensi MIT](https://github.com/zulfikriyahya/keuangan?tab=MIT-1-ov-file).
