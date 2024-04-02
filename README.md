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

Pastikan variabel untuk Google OAuth, Midtrans telah diatur didalam file **.env**

## TO DO

-   Refactor code (implement service, split request validation, etc.)
-   Complete features and/or add more features (merchandise, donation message, etc.)
-   Dunno Yet 😄😄, just "etc."
