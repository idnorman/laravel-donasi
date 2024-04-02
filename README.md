# Web Donasi Sederhana Dengan Laravel

Project web donasi sederhana yang dibuat dengan Laravel dengan fitur login melalui Google dan menggunakan Midtrans sebagai payment gateway dan RajaOngkir sebagai perhitungan ongkir (fitur merchandise).

## Requirements

-   PHP 8+
-   Composer
-   MySQL
-   Google OAuth, Midtrans key

## Panduan Instalasi:

1. Buka terminal, jalankan `git clone https://github.com/idnorman/laravel-donasi.git`
2. Buka direktori hasil klon, jalankan `composer install`
3. Setelah composer selesai, jalankan perintah `cp .env.example .env` atau `copy .env.example .env`
4. Jalankan perintah `php artisan key:generate`
5. Jalankan perintah `php artisan migrate --seed`
6. Jalankan perintah `php artisan serve`

Pastikan variabel untuk Google OAuth, Midtrans telah diatur didalam file `.env`

## Catatan

-   Ubah `APP_URL` didalam `.env` menjadi URL aktif secara publik (bisa memanfaatkan layanan tunneling gratis seperti ngrok, localtunnel atau lainnya). Ini diperlukan untuk override url endpoint untuk Midtrans mengirim callback notifikasi update status transaksi.
    Alternatifnya atur callback url di dashboard Midtrans dan ubah code di `app\Http\Controllers\Main\DonationController.php` untuk menghapus override url.
-   Seeder diisi dengan data random (kebanyakannya) menggunakan Faker, silakan buat seeder sendiri untuk data yang lebih baik :) :).

## TO DO

-   Refactor code (implement service, split request validation, implement queue and maybe caching etc.)
-   Complete features and/or add more features (merchandise, donation message, etc.)
-   Dunno Yet 😄😄, just "etc."
