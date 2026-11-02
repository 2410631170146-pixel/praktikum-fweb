# Praktikum Framework Web

Repository ini saya gunakan untuk menyimpan hasil pengerjaan tugas mata kuliah Framework Web. Proyek yang dikerjakan menggunakan framework Laravel dan dikembangkan secara bertahap sesuai materi praktikum.

## Identitas

- **Nama:** Lameina Regan
- **NIM:** 2410631170146
- **Program Studi:** Sistem Informasi
- **Universitas:** Universitas Singaperbangsa Karawang
- **Mata Kuliah:** Framework Web

## Daftar Praktikum

### Praktikum 11 – Pengelolaan Produk dan Kategori

Pada praktikum ini, saya mengerjakan fitur pengelolaan data produk dan kategori. Fitur yang dibuat mencakup penambahan data, menampilkan daftar data, mengedit, serta menghapus data yang sudah tidak diperlukan.

Lokasi dokumentasi: `docs/Praktikum-11/`

### Praktikum 12 – Point of Sale (POS)

Pada praktikum ini, saya melanjutkan pengembangan aplikasi dengan membuat fitur kasir atau Point of Sale (POS). Fitur yang dikerjakan meliputi proses transaksi, penyimpanan detail pembelian, melihat riwayat transaksi, dan menampilkan struk pembayaran.

Lokasi dokumentasi: `docs/Praktikum-12/`

## Teknologi

Beberapa teknologi yang digunakan dalam pengerjaan proyek ini:

- PHP
- Laravel
- JavaScript
- Tailwind CSS
- Database

## Susunan Folder

Berikut gambaran susunan folder dokumentasi praktikum:

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

## Cara Menjalankan Project

Untuk menjalankan aplikasi Laravel ini, langkah yang dilakukan adalah:

1. Clone repository ke komputer.
2. Buka folder project melalui Terminal.
3. Jalankan `composer install`.
4. Salin file `.env.example` menjadi `.env`.
5. Atur koneksi database pada file `.env`.
6. Jalankan `php artisan key:generate`.
7. Jalankan migrasi database jika diperlukan.
8. Jalankan aplikasi menggunakan `php artisan serve`.

## Penutup

Repository ini dibuat sebagai tempat pengumpulan hasil praktikum Framework Web. Melalui repository ini, source code dan dokumentasi Praktikum 11 serta Praktikum 12 dapat dilihat kembali dan digunakan sebagai bahan pemeriksaan tugas oleh dosen saat UAS.
