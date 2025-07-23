
📦 UAS-KSI: Sistem Manajemen Data Karyawan (Laravel + Docker)

Proyek ini merupakan sistem manajemen data karyawan berbasis Laravel 12, dilengkapi dengan fitur keamanan, pengelolaan gaji, dan manajemen peran pengguna. Aplikasi berjalan di atas Docker menggunakan layanan Nginx, PHP-FPM, dan MySQL.

⸻

📁 Struktur Direktori

.
├── docker-compose.yml
├── nginx/
│   └── default.conf
├── php/
│   └── Dockerfile
├── src/
│   └── (Laravel app ada di sini)


⸻

🚀 Fitur Utama
	•	CRUD Data Karyawan
	•	Manajemen Gaji Karyawan
	•	Manajemen Divisi
	•	Role-based Access Control (RBAC) menggunakan Spatie
	•	Panel Admin menggunakan Filament 3
	•	Otentikasi Laravel
	•	Proteksi CSRF, Middleware, Validasi Input
	•	Konfigurasi container terpisah via Docker

⸻

⚙️ Cara Menjalankan Proyek

1. Clone Repo

git clone https://github.com/LJiEunX/UAS-KSI.git
cd UAS-KSI

2. Build dan Jalankan Docker

docker-compose up -d --build

3. Masuk ke Container Laravel

docker exec -it laravel_app bash

4. Setup Laravel

cd /var/www/html
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate

Jika pakai role permission:

php artisan db:seed

5. Akses di Browser

http://localhost

Filament admin (jika ada):

http://localhost/admin


⸻

🔐 Fitur Keamanan yang Diimplementasikan
	•	CSRF Protection
	•	Validasi input form
	•	Otentikasi via Laravel Auth
	•	Middleware auth & role
	•	Hak akses berbasis peran (Spatie Permission)
	•	Environment variables tersimpan aman di .env

⸻

🛠️ Konfigurasi Database (dalam .env)

DB_CONNECTION=mysql
DB_HOST=laravel_db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root


⸻

🐳 Service Docker

Service	Container Name	Port
Nginx	laravel_nginx	80
PHP (Laravel)	laravel_app	–
MySQL	laravel_db	3306


⸻


