# Portfolio Website - Dhaffa Almuhar Dwi Setiawan

Website portofolio pribadi modern dan responsif yang dibangun menggunakan **Native PHP (tanpa framework)**, **Bootstrap 5 (via CDN)**, dan **PostgreSQL (via PDO)**.

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
│       ├── avatar.svg           # Placeholder foto profil
│       ├── project1.svg         # Aset gambar proyek (opsional)
│       └── ...
├── config\
│   ├── database.php             # Koneksi PDO PostgreSQL & penanganan error
│   └── mail.php                 # Konfigurasi PHPMailer via Gmail SMTP
├── database\
│   └── database.sql             # Skema tabel PostgreSQL
├── includes\
│   ├── header.php               # HTML head, Bootstrap 5 CDN & navbar responsif
│   └── footer.php               # Bootstrap 5 JS CDN & footer tautan sosial
├── pages\
│   ├── home.php                 # Halaman beranda (Hero, biodata, keahlian)
│   ├── about.php                # Halaman tentang saya (Bio, keahlian, riwayat belajar)
│   ├── projects.php             # Halaman proyek (Mengambil data PostgreSQL / empty-state)
│   └── contact.php              # Halaman kontak (Formulir validasi, kirim email via SMTP)
├── vendor\                      # Composer dependencies (PHPMailer)
├── composer.json                # Dependensi proyek
├── .gitignore                   # Ignore vendor & environment files
├── index.php                    # Front controller / router whitelist
└── README.md                    # Dokumentasi & panduan
```

---

## 📧 Konfigurasi Email (PHPMailer via Gmail SMTP)

Pengiriman pesan formulir kontak menggunakan **PHPMailer** melalui **Gmail SMTP**.

### Konfigurasi SMTP di `config/mail.php`

| Parameter | Default | Keterangan |
| :--- | :--- | :--- |
| `SMTP_HOST` | `smtp.gmail.com` | Host server SMTP Gmail |
| `SMTP_PORT` | `587` | Port SMTP (STARTTLS) |
| `SMTP_SECURE`| `tls` | Enkripsi STARTTLS |
| `SMTP_USER` | `dpaimuse@gmail.com` | Akun Gmail pengirim |
| `SMTP_PASS` | `''` (kosong) | **16-karakter Gmail App Password** |

> **Catatan Penting:** Untuk keamanan, gunakan **App Password** 16 karakter dari Google Account (bukan password akun biasa):
> 1. Aktifkan **2-Step Verification** di akun Google Anda.
> 2. Buka menu **Security** &rarr; **App passwords**.
> 3. Buat App Password baru untuk "Mail / Portfolio".
> 4. Set App Password tersebut melalui environment variable `SMTP_PASS` atau di `config/mail.php`. Jangan pernah mempublikasikan password asli ke public repository.

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
| `DB_PASS` | `postgres123` | Password database |

### Menjalankan Skema Database
Gunakan `psql` atau pgAdmin Query Tool:

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

## 💻 Menjalankan Aplikasi di Laragon

1. Pastikan folder ini berada di `c:\laragon\www\portfolio`.
2. Buka Laragon dan klik **Start All** (Apache & PostgreSQL).
3. Buka browser dan akses:
   - `http://localhost/portfolio/` atau `http://portfolio.test/`
