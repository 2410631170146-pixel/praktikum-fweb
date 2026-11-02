# PRAKTIKUM FRAMEWORK WEB

Repository ini merupakan dokumentasi dan tempat penyimpanan source code tugas praktikum mata kuliah Framework Web menggunakan Laravel.

## Identitas Mahasiswa

- **Nama:** Lameina Regan
- **NIM:** 2410631170146
- **Program Studi:** Sistem Informasi
- **Universitas:** Universitas Singaperbangsa Karawang
- **Mata Kuliah:** Framework Web

## Daftar Praktikum

### Praktikum 11 — Pengelolaan Data

Berisi source code dan dokumentasi pengelolaan data produk dan kategori, termasuk fitur tambah, tampil, ubah, dan hapus data.

Folder dokumentasi: `docs/Praktikum-11/`

### Praktikum 12 — Point of Sale (POS)

Berisi source code dan dokumentasi aplikasi kasir, meliputi transaksi penjualan, detail transaksi, riwayat transaksi, dan struk pembayaran.

Folder dokumentasi: `docs/Praktikum-12/`

## Teknologi yang Digunakan

- PHP
- Laravel
- JavaScript
- Tailwind CSS
- Database sesuai konfigurasi proyek

## Struktur Repository

```text
belajar-laravel/
├── app/
├── bootstrap/
├── config/
├── database/
├── docs/
│   ├── Praktikum-11/
│   │   ├── Tugas/
│   │   └── Screenshot/
│   └── Praktikum-12/
│       ├── Tugas/
│       └── Screenshot/
├── public/
├── resources/
├── routes/
├── tests/
├── README.md
├── composer.json
└── package.json
```

## Cara Menjalankan Aplikasi

1. Clone repository.
2. Jalankan `composer install`.
3. Salin `.env.example` menjadi `.env`.
4. Sesuaikan konfigurasi database.
5. Jalankan `php artisan key:generate`.
6. Jalankan migrasi database sesuai kebutuhan.
7. Jalankan `php artisan serve`.

## Tujuan Repository

Repository ini digunakan untuk menyimpan hasil pengerjaan praktikum Framework Web sebagai dokumentasi pembelajaran dan bahan pemeriksaan tugas oleh dosen pada saat Ujian Akhir Semester (UAS).
