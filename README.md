# Lab8Web - Praktikum 8: PHP dan Database MySQL

**Nama:** (isi namamu)
**NIM:** (isi NIM-mu)
**Kelas:** (isi kelasmu)

## Tujuan
1. Memahami konsep dasar database.
2. Memahami konsep dasar CRUD menggunakan PHP.
3. Membuat program CRUD sederhana menggunakan PHP.

> CRUD = **C**reate (tambah), **R**ead (lihat), **U**pdate (ubah), **D**elete (hapus).

---

## Langkah 1 - Menjalankan MySQL Server
Buka **XAMPP Control Panel**, lalu klik **Start** pada **Apache** dan **MySQL** sampai tulisannya jadi hijau.
Apache = "pelayan web", MySQL = "lemari tempat menyimpan data".

![XAMPP Control](screenshots/01_xampp.png)

## Langkah 2 - Membuka phpMyAdmin
Buka browser, ketik `http://localhost/phpmyadmin/`. Ini adalah "layar" untuk mengatur lemari data (MySQL) tanpa perlu mengetik di terminal.

![phpMyAdmin](screenshots/02_phpmyadmin.png)

## Langkah 3 - Membuat Database dan Tabel
Di tab **SQL**, jalankan:

```sql
CREATE DATABASE latihan1;
```
Artinya: bikin satu "lemari" bernama `latihan1`.

Lalu pilih database `latihan1` dan jalankan:

```sql
CREATE TABLE data_barang (
    id_barang int(10) auto_increment Primary Key,
    kategori varchar(30),
    nama varchar(50),
    gambar varchar(100),
    harga_beli decimal(10,0),
    harga_jual decimal(10,0),
    stok int(4)
);
```
Artinya: bikin satu "rak" bernama `data_barang` dengan kolom-kolom (id, kategori, nama, gambar, harga beli, harga jual, stok). `auto_increment` = nomor id naik sendiri (1, 2, 3, ...). `Primary Key` = tanda pengenal unik tiap barang.

![Buat tabel](screenshots/03_buat_tabel.png)

## Langkah 4 - Menambahkan Data Awal

```sql
INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok)
VALUES ('Elektronik', 'HP Samsung Android', 'hp_samsung.jpg', 2000000, 2400000, 5),
('Elektronik', 'HP Xiaomi Android', 'hp_xiaomi.jpg', 1000000, 1400000, 5),
('Elektronik', 'HP OPPO Android', 'hp_oppo.jpg', 1800000, 2300000, 5);
```
Artinya: masukkan 3 barang ke dalam rak `data_barang`.

![Data barang](screenshots/04_data_barang.png)

> Semua perintah SQL di atas juga ada di file `database.sql`.

## Langkah 5 - Membuat Folder Project
Buat folder `lab8_php_database` di dalam `C:\xampp\htdocs` (atau `d:\xampp\htdocs`).
Buka di browser: `http://localhost/lab8_php_database/`.
Di dalam folder itu juga ada folder `gambar` untuk menyimpan foto barang.

![Folder](screenshots/05_folder.png)

## Langkah 6 - File koneksi.php
File ini adalah "kunci" untuk masuk ke database. Isinya: alamat server (`localhost`), user (`root`), password (kosong), dan nama database (`latihan1`). `mysqli_connect()` dipakai untuk menyambung. Kalau gagal, tampil pesan "Koneksi ke server gagal."

Untuk tes: hapus tanda `#` di depan `echo "Koneksi berhasil"`, lalu buka `koneksi.php` di browser.

![Tes koneksi](screenshots/06_tes_koneksi.png)

## Langkah 7 - index.php (READ / Lihat Data)
- `include("koneksi.php")` = pinjam kunci database.
- `SELECT * FROM data_barang` = "ambil semua barang dari rak".
- `while(...)` = ulangi untuk setiap barang, lalu tampilkan sebagai satu baris tabel.
- Ada link **Tambah Barang**, serta **Ubah** dan **Hapus** di setiap baris.

![Index](screenshots/07_index.png)

## Langkah 8 - tambah.php (CREATE / Tambah Data)
- Menampilkan form (nama, kategori, harga jual, harga beli, stok, gambar).
- Saat tombol **Simpan** ditekan, data diambil dari `$_POST`, file gambar dari `$_FILES`.
- Gambar dipindahkan ke folder `gambar/` memakai `move_uploaded_file()`.
- Data disimpan dengan `INSERT INTO ...`, lalu halaman kembali ke `index.php`.
- `enctype="multipart/form-data"` wajib ada supaya form bisa mengirim file.

![Tambah](screenshots/08_tambah.png)

## Langkah 9 - ubah.php (UPDATE / Ubah Data)
- Alamatnya seperti `ubah.php?id=1`, angka `id` diambil dengan `$_GET['id']`.
- Data lama diambil dengan `SELECT ... WHERE id_barang = ...` lalu ditaruh di form.
- Saat **Simpan**, dijalankan `UPDATE data_barang SET ... WHERE id_barang = ...`.
- Kalau tidak memilih gambar baru, gambar lama tidak diubah.
- Fungsi `is_select()` dipakai supaya pilihan kategori otomatis sesuai data lama.

![Ubah](screenshots/09_ubah.png)

## Langkah 10 - hapus.php (DELETE / Hapus Data)
Mengambil `id` dari alamat, lalu menjalankan `DELETE FROM data_barang WHERE id_barang = ...`. Setelah itu kembali ke `index.php`. Di `index.php` ada konfirmasi "Yakin mau hapus?" supaya tidak terhapus tidak sengaja.

![Hapus](screenshots/10_hapus.png)

## Catatan Perbaikan dari Modul
Beberapa hal diperbaiki dari kode di modul agar program berjalan benar dan aman:
1. Urutan kolom di tabel `index.php` disamakan dengan urutan data (Harga Beli, Harga Jual).
2. Ditambah link **Tambah Barang** dan tombol **Ubah / Hapus** di setiap baris.
3. Kolom `gambar` hanya menyimpan nama file (mis. `hp_oppo.jpg`) supaya cocok dengan data awal dan `src="gambar/..."`.
4. Typo `multipart/formdata` di `ubah.php` diperbaiki menjadi `multipart/form-data`.
5. Fungsi `is_select()` di `ubah.php` dibandingkan dengan nilai yang benar (Komputer / Elektronik / Hand Phone).
6. Query memakai *prepared statement* agar aman dari SQL Injection.

## Cara Menjalankan
1. Start Apache dan MySQL di XAMPP.
2. Import `database.sql` lewat phpMyAdmin.
3. Salin folder `lab8_php_database` ke `htdocs`.
4. Buka `http://localhost/lab8_php_database/`.
