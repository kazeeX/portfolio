# Portfolio Website - Dhaffa Almuhar Dwi Setiawan

Website portofolio pribadi modern dan responsif yang dibangun menggunakan **Native PHP (tanpa framework)**, **Bootstrap 5 (via CDN)**, dan **PostgreSQL (via PDO)**.

🌐 **Live**: [https://paiport.my.id](https://paiport.my.id)

---

## 👤 Informasi Pengembang

- **Nama**: Dhaffa Almuhar Dwi Setiawan (Dhaffa)
- **Status**: Pelajar Kelas 12, Rekayasa Perangkat Lunak (RPL)
- **Sekolah**: SMK Taruna Bangsa, Kota Bekasi
- **Minat**: Backend Development & Web Development
- **Keahlian (Sedang dipelajari)**: PHP, HTML, CSS, Bootstrap 5, PostgreSQL, Git
- **Kontak & Sosial Media**:
  - Email: [dpaimuse@gmail.com](mailto:dpaimuse@gmail.com)
  - GitHub: [https://github.com/kazeeX](https://github.com/kazeeX)
  - Instagram: [https://instagram.com/kazelll08](https://instagram.com/kazelll08)
  - LinkedIn: Dhaffa Almuhar Dwi S

---

## 📁 Struktur Direktori

```text
c:\laragon\www\portfolio\
├── assets\
│   ├── css\
│   │   └── style.css            # Styling custom & visual modern
│   ├── js\
│   │   └── main.js              # Client-side Bootstrap validation & tooltip
│   └── img\
│       ├── profile.jpg          # Foto profil
│       ├── avatar.svg           # Favicon situs
│       ├── project1.svg         # Aset gambar proyek (opsional)
│       └── ...
├── config\
│   ├── database.php             # Koneksi PDO PostgreSQL & penanganan error (tidak di-push, ada di .gitignore)
│   └── database.example.php     # Template konfigurasi database (versi yang di-push ke repo)
├── database\
│   └── database.sql             # Skema tabel PostgreSQL (projects + contact_messages)
├── includes\
│   ├── header.php               # HTML head, Bootstrap 5 CDN & navbar responsif
│   └── footer.php               # Bootstrap 5 JS CDN & footer tautan sosial
├── pages\
│   ├── home.php                 # Halaman beranda (Hero, biodata, keahlian)
│   ├── about.php                # Halaman tentang saya (Bio, keahlian, riwayat belajar)
│   ├── projects.php             # Halaman proyek (Mengambil data PostgreSQL / empty-state)
│   └── contact.php              # Halaman kontak (Formulir validasi, pesan disimpan ke database)
├── .gitignore                   # Ignore file konfigurasi berisi kredensial
├── index.php                    # Front controller / router whitelist
└── README.md                    # Dokumentasi & panduan
```

---

## 📬 Formulir Kontak

Pesan dari formulir kontak **disimpan ke database** PostgreSQL (tabel `contact_messages`), bukan dikirim sebagai email.

Alasannya: paket hosting gratis yang dipakai situs ini memblokir SMTP eksternal, jadi pengiriman email dari server tidak dapat dilakukan. Pesan yang masuk dibaca secara manual melalui pgAdmin / phpPgAdmin:

```sql
SELECT * FROM contact_messages ORDER BY created_at DESC;
```

Lalu dibalas secara manual melalui email pengirim yang tercantum di pesan.

---

## 🗄️ Basis Data PostgreSQL

### Konfigurasi Database
Konfigurasi koneksi tersimpan di `config/database.php`:

| Parameter | Nilai Default | Keterangan |
| :--- | :--- | :--- |
| `DB_HOST` | `localhost` | Host server PostgreSQL |
| `DB_PORT` | `5432` | Port PostgreSQL |
| `DB_NAME` | `portfolio_db` | Nama database |
| `DB_USER` | `postgres` | Username database |
| `DB_PASS` | *(diisi sendiri)* | Password database lokal — jangan pernah ditulis di repo |

> **Keamanan:** `config/database.php` yang asli **tidak** ikut ter-push ke GitHub (terdaftar di `.gitignore`). Yang ada di repo hanya `config/database.example.php` sebagai template berisi placeholder.

### Menjalankan Skema Database
File `database/database.sql` membuat **kedua** tabel yang dibutuhkan aplikasi (`projects` dan `contact_messages`). Gunakan `psql` atau pgAdmin Query Tool:

```sql
-- Buat database jika belum ada
CREATE DATABASE portfolio_db;

-- Hubungkan ke database
\c portfolio_db;

-- Jalankan skema
\i c:/laragon/www/portfolio/database/database.sql
```

### Mengosongkan Tabel Proyek
Jika Anda ingin mengosongkan seluruh data proyek di tabel PostgreSQL kapan saja, jalankan:

```sql
DELETE FROM projects;
```

Ketika tabel `projects` kosong, halaman Proyek akan menampilkan pesan ramah:
> *"Proyek pertama saya sedang dalam pengerjaan. Kembali lagi nanti!"*

---

## 🚀 Deployment

Setiap `push` ke branch `main` otomatis men-deploy situs ke hosting melalui **GitHub Actions** (upload SFTP ke server WebHostMost). File `config/database.php` dikecualikan dari deploy agar konfigurasi database di server tidak tertimpa versi lokal.

---

## 💻 Menjalankan Aplikasi di Laragon

1. Pastikan folder ini berada di `c:\laragon\www\portfolio`.
2. Buka Laragon dan klik **Start All** (Apache & PostgreSQL).
3. Buka browser dan akses:
   - `http://localhost/portfolio/` atau `http://portfolio.test/`
