# FANBook

FANBook adalah aplikasi web berbasis Laravel untuk berbagi dan mencari buku secara publik, lengkap dengan fitur autentikasi, manajemen buku, filter, dan rating.

---

## ✨ Fitur Utama

- **Autentikasi Pengguna**  
  Register, login, verifikasi email, dan manajemen profil.
- **Manajemen Buku**  
  CRUD buku (tambah, edit, hapus), upload thumbnail, rating, dan filter berdasarkan penulis/rating.
- **Dashboard & Daftar Buku Publik**  
  Landing page menampilkan koleksi buku publik dengan filter dan pagination.
- **UI/UX Modern**  
  Responsive, clean, dan mudah digunakan.
- **Pengujian Otomatis**  
  Unit test & feature test untuk autentikasi dan manajemen buku.

---

## 🚀 Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/salimnrkhsn17/projectFAN_fdtest.git
   cd project_fan
   ```

2. **Install dependency**
   ```bash
   composer install
   npm install && npm run build	
   php artisan storage:link (agar foto muncul)
   ```

3. **Copy file environment**
   ```bash
   cp .env.example .env
   ```

4. **Generate key aplikasi**
   ```bash
   php artisan key:generate
   ```

5. **Atur konfigurasi database**  
   Edit `.env` dan sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD sesuai Database (PostgreSQL).
   Database name : dbfan_fdtest

   Table :
   users
   books
  bisa langsung jalankan migrate

6. **Jalankan migrasi dan seeder (opsional)**
   ```bash
   php artisan migrate --seed
   ```
   Atau jika ingin reset:
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Jalankan server lokal**
   ```bash
   php artisan serve
   ```
   Akses di [http://localhost:8000](http://localhost:8000)

---

## 🛠️ Cara Kerja & Alur

1. **Register & Verifikasi Email**
   - User mendaftar, lalu menerima email verifikasi.
   - Setelah klik link verifikasi, user bisa login dan akses fitur utama.

2. **Manajemen Buku**
   - User login dapat menambah, mengedit, dan menghapus buku.
   - Buku dapat diberi rating dan thumbnail.

3. **Landing Page**
   - Semua pengunjung dapat melihat daftar buku publik.
   - Fitur filter berdasarkan penulis, rating, dan urutan terbaru.

4. **Dashboard & Profil**
   - Setelah login dan verifikasi, user dapat mengelola profil dan password.

5. **Pengujian Otomatis**
   - Jalankan `php artisan test` untuk memastikan semua fitur utama berjalan baik.

---

## 🧪 Pengujian

Jalankan semua test:
```bash
php artisan test
```
Test akan berjalan di database khusus (tidak menghapus data utama).

---

## 📦 Struktur Folder Penting

- `app/Models/Book.php` — Model buku
- `app/Http/Controllers/BookController.php` — Logika CRUD buku
- `resources/views/landing.blade.php` — Landing page publik
- `resources/views/auth/` — Halaman autentikasi
- `tests/Feature/` — Pengujian fitur utama

---

## 📧 Konfigurasi Email

1. Gunakan Akun Gmail Khusus 
Karena Gmail punya batasan rate-limit harian (misal 500 email/hari), sebaiknya:

Gunakan akun Gmail yang hanya untuk testing

Atau aktifkan App Passwords jika pakai 2FA

2. Aktifkan 2FA (jika belum) di Gmail
Buka akun Google

Masuk ke https://myaccount.google.com/security

Aktifkan "2-Step Verification"

3. Buat App Password
Jika 2FA aktif:

Masuk ke https://myaccount.google.com/apppasswords

Pilih App: Email → Device: Other (Laravel)

Akan diberikan 16-digit password


Agar fitur verifikasi email berjalan, atur SMTP di `.env`:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls

MAIL_FROM_ADDRESS=your@email.com
MAIL_FROM_NAME="FANBook"
```


