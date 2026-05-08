# WMH - Website Mental Healthy (Demo)

Simple demo website untuk kesehatan mental, dibuat untuk dijalankan di XAMPP (Apache + PHP).

Lokasi file: `C:\xampp\htdocs\kesmen`

Halaman yang tersedia:
- `index.php` - Home
- `test.php` - Tes Kesehatan Mental (quiz singkat, berbasis JS)
- `appointment.php` - Form Buat Janji (disimpan ke `data/appointments.json`)
- `articles.php` - Artikel
- `videos.php` - Video edukasi (embed YouTube)
- `books.php` - Rekomendasi buku
- `admin.php` - Halaman admin sederhana untuk melihat janji (password demo: `admin123`)

Database & migration
1. Pastikan MySQL (Apache/XAMPP) berjalan.
2. Anda dapat menjalankan `schema.sql` pada database server atau menjalankan `migrate.php` untuk membuat database, tabel, dan akun admin default.

Menjalankan migrasi (CLI dari folder proyek):
```
php migrate.php
```

Default admin setelah migrasi: username `admin`, password `admin123`.
Jika Anda menggunakan XAMPP default dan ingin mengubah kredensial database, edit `config.php`.

Instruksi menjalankan (Windows + XAMPP):
1. Pastikan XAMPP terpasang dan Apache berjalan.
2. Tempatkan folder `kesmen` di `C:\xampp\htdocs\` (sudah otomatis jika Anda mengikuti langkah ini).
3. Buka browser: `http://localhost/kesmen/` atau `http://127.0.0.1/kesmen/`.
4. Untuk melihat janji yang masuk, buka `http://localhost/kesmen/admin.php` lalu login dengan password demo di README.

Catatan keamanan: Ini adalah demo sederhana. Jangan gunakan password hardcoded di lingkungan produksi. Tambahkan validasi, sanitasi, dan autentikasi yang sesuai sebelum digunakan publik.
