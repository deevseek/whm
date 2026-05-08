# WMH - Website Mental Healthy (Demo)

Aplikasi web untuk layanan kesehatan mental yang simple dan user-friendly. Dijalankan di XAMPP (Apache + PHP + MySQL).

## 📋 Fitur

- **Home** - Halaman utama dengan informasi tentang layanan
- **Tes Kesehatan Mental** - Quiz untuk deteksi awal stres, kecemasan, dan depresi (40 pertanyaan)
- **Buat Janji** - Form untuk membuat janji konsultasi (disimpan ke database)
- **Artikel** - Artikel tentang kesehatan mental
- **Video** - Video edukasi kesehatan mental (embed YouTube)
- **Buku** - Rekomendasi buku tentang kesehatan mental
- **Admin** - Dashboard admin untuk melihat data janji dan hasil tes

## 🚀 Cara Menjalankan

### 1. Prasyarat
- XAMPP sudah terinstal dan berjalan
- MySQL service aktif
- PHP 7.4 atau lebih tinggi

### 2. Setup Database

Database sudah otomatis terbuat saat migrasi. Jika perlu membuat ulang:

**Via CLI:**
```bash
cd C:\xampp\htdocs\teman
php migrate.php
```

**Via Browser:**
Buka `http://localhost/teman/migrate.php` di browser.

### 3. Akses Aplikasi

Buka browser dan akses:
```
http://localhost/teman/
atau
http://127.0.0.1/teman/
```

## 🔐 Login Admin

**URL:** `http://localhost/teman/admin.php`

**Default Credentials:**
- Username: `admin`
- Password: `admin123`

### Mengubah Password Admin

**Via CLI:**
```bash
php set_admin_password.php newpassword
```

**Via Browser:**
```
http://localhost/teman/set_admin_password.php?password=newpassword
```

## 📁 Struktur Folder

```
teman/
├── index.php              # Halaman utama
├── test.php               # Tes kesehatan mental
├── appointment.php        # Form janji konsultasi
├── articles.php           # Artikel
├── videos.php             # Video edukasi
├── books.php              # Rekomendasi buku
├── admin.php              # Dashboard admin
├── config.php             # Konfigurasi database
├── migrate.php            # Script migrasi database
├── set_admin_password.php # Script untuk ubah password
├── schema.sql             # Database schema
├── appointments.json      # File cadangan janji (legacy)
├── api_save_test.php      # API untuk menyimpan hasil tes
├── assets/
│   ├── css/
│   │   └── style.css      # Stylesheet
│   └── js/
│       └── app.js         # JavaScript untuk quiz
└── data/
    └── appointments.json  # Data janji (format JSON)
```

## 🗄️ Database

**Database Name:** `teman`

**Tables:**
1. **appointments** - Menyimpan janji konsultasi
2. **users** - Menyimpan akun admin
3. **mental_test_results** - Menyimpan hasil tes kesehatan mental

## 🔧 Konfigurasi Database

Edit file `config.php` jika perlu mengubah kredensial database:

```php
define('DB_HOST', '127.0.0.1');      // Host MySQL
define('DB_NAME', 'teman');           // Nama database
define('DB_USER', 'root');            // Username MySQL
define('DB_PASS', '');                // Password MySQL
```

## 📊 Fitur Admin

Di dashboard admin Anda dapat:
- Melihat daftar semua janji konsultasi
- Melihat hasil tes kesehatan mental dari pengunjung
- Menghapus/kosongkan semua janji

## ⚠️ Catatan Keamanan

**PENTING:** Ini adalah demo sederhana untuk tujuan pembelajaran. Sebelum digunakan di production, pastikan:

1. ✅ Ubah password admin default
2. ✅ Hapus file `set_admin_password.php` setelah konfigurasi
3. ✅ Gunakan HTTPS (SSL/TLS)
4. ✅ Tambahkan validasi dan sanitasi input yang lebih ketat
5. ✅ Implementasikan rate limiting
6. ✅ Gunakan prepared statements (sudah diterapkan)
7. ✅ Tambahkan logging dan monitoring
8. ✅ Backup database secara berkala

## 🐛 Troubleshooting

### Database tidak tersambung
- Pastikan MySQL service berjalan
- Periksa konfigurasi di `config.php`
- Pastikan username dan password MySQL benar

### File CSS/JS tidak muncul
- Pastikan folder `assets/css` dan `assets/js` sudah ada
- Periksa permissions folder

### Migration gagal
- Pastikan MySQL sudah berjalan
- Pastikan user `root` MySQL memiliki permission CREATE DATABASE
- Cek error message di output

## 📞 Kontak & Support

Untuk pertanyaan atau masalah, hubungi admin aplikasi.

---

**Last Updated:** 2026-05-08
**Version:** 1.0 (Fixed & Complete)
