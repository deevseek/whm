# Panduan Instalasi di XAMPP (Windows)

Dokumentasi ini menjelaskan cara instalasi dan menjalankan aplikasi **WMH (Website Mental Healthy)** menggunakan XAMPP.

## 1) Prasyarat

Pastikan komponen berikut sudah tersedia:
- XAMPP (Apache + MySQL)
- PHP 7.4 atau lebih baru (sudah termasuk di XAMPP terbaru)
- Browser (Chrome/Edge/Firefox)

## 2) Menempatkan Proyek ke Folder XAMPP

1. Buka folder instalasi XAMPP, biasanya:
   `C:\xampp\htdocs\`
2. Salin folder proyek ini ke dalam `htdocs`.
3. Nama folder disarankan: `teman`

Contoh hasil akhir:
`C:\xampp\htdocs\teman\`

## 3) Menjalankan Service XAMPP

1. Buka **XAMPP Control Panel**.
2. Klik **Start** pada:
   - **Apache**
   - **MySQL**
3. Pastikan keduanya berstatus **Running**.

## 4) Setup Database

Aplikasi menggunakan database bernama `teman`.

### Opsi A (Direkomendasikan): Migrasi Otomatis via CLI

Buka Command Prompt, lalu jalankan:

```bash
cd C:\xampp\htdocs\teman
php migrate.php
```

### Opsi B: Migrasi via Browser

Buka URL berikut:

`http://localhost/teman/migrate.php`

### Opsi C: Import Manual via phpMyAdmin

1. Buka `http://localhost/phpmyadmin`
2. Buat database baru: `teman`
3. Klik tab **Import**
4. Pilih file `schema.sql`
5. Klik **Go**

## 5) Konfigurasi Database (Jika Diperlukan)

Jika kredensial MySQL Anda berbeda dari default XAMPP, edit file `config.php`:

```php
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'teman');
define('DB_USER', 'root');
define('DB_PASS', '');
```

## 6) Menjalankan Aplikasi

Setelah Apache dan MySQL aktif, buka:

- `http://localhost/teman/`
- atau `http://127.0.0.1/teman/`

## 7) Login Admin

- URL: `http://localhost/teman/admin.php`
- Username default: `admin`
- Password default: `admin123`

> Demi keamanan, ubah password admin setelah instalasi.

### Mengubah Password Admin

Via CLI:

```bash
php set_admin_password.php password_baru_anda
```

Via browser:

`http://localhost/teman/set_admin_password.php?password=password_baru_anda`

## 8) Troubleshooting

### Apache tidak bisa start
- Pastikan port 80/443 tidak dipakai aplikasi lain (IIS/Skype/dll)
- Jika bentrok, ubah port Apache dari XAMPP Config

### MySQL tidak bisa start
- Cek apakah port 3306 sedang dipakai
- Tutup service MySQL lain yang aktif di Windows

### Gagal konek database
- Pastikan MySQL sudah Running
- Verifikasi pengaturan `DB_HOST`, `DB_USER`, `DB_PASS` di `config.php`

### Halaman kosong atau error PHP
- Cek log di `C:\xampp\php\logs\php_error_log`
- Pastikan versi PHP kompatibel (minimal 7.4)

## 9) Catatan Keamanan

Ini masih aplikasi demo. Sebelum dipakai di production:
- Ganti password default admin
- Hapus atau batasi akses ke `set_admin_password.php`
- Aktifkan HTTPS
- Tambahkan validasi dan proteksi keamanan tambahan

---

Dokumentasi ini terakhir diperbarui pada **2026-05-08**.
