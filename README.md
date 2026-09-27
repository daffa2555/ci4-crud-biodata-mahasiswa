# Laporan Pengerjaan Tugas 2 - Proyek Mini: CRUD Read & Create
**Mata Kuliah:** Pemrograman Web Framework (CodeIgniter 4)  
**Institusi:** Universitas Muhammadiyah Mataram (UMMAT)  
**Topik:** Implementasi Pola Arsitektur MVC (Route -> Controller -> Model -> View) untuk Fitur Read dan Create Biodata Mahasiswa.

---

## 1. Ringkasan Arsitektur Sistem

Proyek mini ini mengimplementasikan alur kerja penuh framework **CodeIgniter 4** dengan pembagian tanggung jawab sebagai berikut:

1. **Route (`app/Config/Routes.php`)**:
   - `GET /mahasiswa` : Mengarahkan request ke Controller `Mahasiswa::index` untuk menampilkan tabel biodata (Read).
   - `GET /mahasiswa/create` : Mengarahkan request ke Controller `Mahasiswa::create` untuk menampilkan formulir pendaftaran mahasiswa baru (Create Form).
   - `POST /mahasiswa/store` : Mengarahkan data form hasil submit ke Controller `Mahasiswa::store` untuk validasi dan penyimpanan ke basis data (Create Action).

2. **Model (`app/Models/MahasiswaModel.php`)**:
   - Mengelola tabel `mahasiswa` di database MySQL.
   - Atribut yang dilindungi (`$allowedFields`): `nim`, `nama`, `jenis_kelamin`, `prodi`, `alamat`.
   - Mengaktifkan fitur otomatis timestamp (`created_at`, `updated_at`).
   - Menyertakan aturan validasi data (`validationRules` & `validationMessages`) untuk integritas data.

3. **Controller (`app/Controllers/Mahasiswa.php`)**:
   - `index()`: Mengambil seluruh data mahasiswa dari Model secara descending (`orderBy('created_at', 'DESC')`) lalu mengirimkannya ke view `index.php`.
   - `create()`: Mempersiapkan session dan service validasi untuk view form `create.php`.
   - `store()`: Memvalidasi input (NIM unik, nama minimal 3 karakter, jenis kelamin wajib, prodi wajib). Jika validasi lolos, menyimpan record baru ke basis data dan mengirim flashdata notifikasi sukses.

4. **View (`app/Views/mahasiswa/`)**:
   - `index.php` (Read): Antarmuka tabel responsif modern menggunakan **Bootstrap 5** dengan badge status, nomor urut otomatis, dan tombol navigasi tambah data.
   - `create.php` (Create): Antarmuka formulir input dengan CSRF protection (`<?= csrf_field(); ?>`), umpan balik validasi error interaktif (`is-invalid`), dan tombol simpan data.

5. **Database (`database.sql`)**:
   - Skrip SQL lengkap pembuatan database `db_biodata_kampus`, tabel `mahasiswa`, serta data dummy awal.

---

## 2. Langkah-Langkah Pengujian Sistem

1. **Import Database**:
   - Buka phpMyAdmin (`http://localhost/phpmyadmin`).
   - Import file `database.sql` yang tersedia.

2. **Konfigurasi Environment**:
   - Salin file `env` menjadi `.env`.
   - Sesuaikan konfigurasi koneksi MySQL (`database.default.database = db_biodata_kampus`, user, dan password).

3. **Jalankan Server Lokal**:
   ```bash
   php spark serve
   ```
   Aplikasi dapat diakses di peramban pada URL: `http://localhost:8080/mahasiswa`

4. **Pengujian Fitur**:
   - **Fitur Read**: Buka halaman utama `http://localhost:8080/mahasiswa`. Seluruh data mahasiswa tampil dengan rapi di dalam tabel.
   - **Fitur Create**: Klik tombol **Tambah Mahasiswa Baru**, isi formulir secara lengkap, lalu klik **Simpan Biodata**. Data akan tersimpan ke database dan sistem akan mengalihkan kembali ke tabel utama dengan notifikasi sukses berwarna hijau.
