# Lab8Web - Praktikum 8: PHP dan Database MySQL

**Nama:** (Lia Mulyati)
**NIM:** (312510167)
**Kelas:** (I251D)

## Tujuan
1. Memahami konsep dasar database.
2. Memahami konsep dasar CRUD menggunakan PHP.
3. Membuat program CRUD sederhana menggunakan PHP.

> CRUD = **C**reate (tambah), **R**ead (lihat), **U**pdate (ubah), **D**elete (hapus).

---

## Langkah 1 - Menjalankan MySQL Server
Buka **XAMPP Control Panel**, lalu klik **Start** pada **Apache** dan **MySQL** sampai tulisannya jadi hijau.
Apache = "pelayan web", MySQL = "lemari tempat menyimpan data".

<img width="475" height="141" alt="image" src="https://github.com/user-attachments/assets/4dce83f4-f3e2-40fe-aae6-35f9f9f30f6b" />


## Langkah 2 - Membuka phpMyAdmin
Buka browser, ketik `http://localhost/phpmyadmin/`. Ini adalah "layar" untuk mengatur lemari data (MySQL) tanpa perlu mengetik di terminal.


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

<img width="318" height="212" alt="image" src="https://github.com/user-attachments/assets/4384d6e7-d70d-4d80-91da-f78cd0320def" />


## Langkah 4 - Menambahkan Data Awal

```sql
INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok)
VALUES ('Elektronik', 'HP Samsung Android', 'hp_samsung.jpg', 2000000, 2400000, 5),
('Elektronik', 'HP Xiaomi Android', 'hp_xiaomi.jpg', 1000000, 1400000, 5),
('Elektronik', 'HP OPPO Android', 'hp_oppo.jpg', 1800000, 2300000, 5);
```
Artinya: masukkan 3 barang ke dalam rak `data_barang`.

<img width="634" height="249" alt="image" src="https://github.com/user-attachments/assets/f07167f5-aad0-4751-9c21-e53877cf6567" />


> Semua perintah SQL di atas juga ada di file `database.sql`.

## Langkah 5 - Membuat Folder Project
Buat folder `lab8_php_database` di dalam `C:\xampp\htdocs` (atau `d:\xampp\htdocs`).
Buka di browser: `http://localhost/lab8_php_database/`.
Di dalam folder itu juga ada folder `gambar` untuk menyimpan foto barang.

<img width="247" height="143" alt="image" src="https://github.com/user-attachments/assets/be2a0ad5-9b9a-4414-b3ce-af5f077357e6" />


## Langkah 6 - File koneksi.php
File ini adalah "kunci" untuk masuk ke database. Isinya: alamat server (`localhost`), user (`root`), password (kosong), dan nama database (`latihan1`). `mysqli_connect()` dipakai untuk menyambung. Kalau gagal, tampil pesan "Koneksi ke server gagal."

Untuk tes: hapus tanda `#` di depan `echo "Koneksi berhasil"`, lalu buka `koneksi.php` di browser.

<img width="242" height="181" alt="koneksi" src="https://github.com/user-attachments/assets/5ca2119b-a341-4c78-8596-b6bfbb423672" />

<img width="126" height="29" alt="koneksi (2)" src="https://github.com/user-attachments/assets/669c7787-11c9-499b-8075-63bf2e07345a" />

## Langkah 7 - index.php (READ / Lihat Data)
- `include("koneksi.php")` = pinjam kunci database.
- `SELECT * FROM data_barang` = "ambil semua barang dari rak".
- `while(...)` = ulangi untuk setiap barang, lalu tampilkan sebagai satu baris tabel.
- Ada link **Tambah Barang**, serta **Ubah** dan **Hapus** di setiap baris.

<img width="273" height="425" alt="index" src="https://github.com/user-attachments/assets/2c901117-e22e-4450-b822-f08a6a4c360c" />


## Langkah 8 - tambah.php (CREATE / Tambah Data)
- Menampilkan form (nama, kategori, harga jual, harga beli, stok, gambar).
- Saat tombol **Simpan** ditekan, data diambil dari `$_POST`, file gambar dari `$_FILES`.
- Gambar dipindahkan ke folder `gambar/` memakai `move_uploaded_file()`.
- Data disimpan dengan `INSERT INTO ...`, lalu halaman kembali ke `index.php`.
- `enctype="multipart/form-data"` wajib ada supaya form bisa mengirim file.

<img width="620" height="445" alt="tambah php" src="https://github.com/user-attachments/assets/3b7aa96d-995f-4f62-b183-7558c51a48eb" />

<img width="301" height="399" alt="tambah 2" src="https://github.com/user-attachments/assets/7ad19a7b-8ec7-445b-9416-4904364acf2d" />

<img width="293" height="242" alt="tambah barang" src="https://github.com/user-attachments/assets/ed2f9664-db24-4cbe-97cb-963726251ec4" />

## Langkah 9 - ubah.php (UPDATE / Ubah Data)
- Alamatnya seperti `ubah.php?id=1`, angka `id` diambil dengan `$_GET['id']`.
- Data lama diambil dengan `SELECT ... WHERE id_barang = ...` lalu ditaruh di form.
- Saat **Simpan**, dijalankan `UPDATE data_barang SET ... WHERE id_barang = ...`.
- Kalau tidak memilih gambar baru, gambar lama tidak diubah.
- Fungsi `is_select()` dipakai supaya pilihan kategori otomatis sesuai data lama.

<img width="659" height="380" alt="ubah php 1" src="https://github.com/user-attachments/assets/741dac27-e67b-4b4a-a9a6-a9e74b49741b" />

<img width="646" height="392" alt="ubah php 2" src="https://github.com/user-attachments/assets/1581e6e1-9f1f-47be-8f8f-111ac248d025" />

<img width="421" height="405" alt="ubah 3" src="https://github.com/user-attachments/assets/1f0aba95-6338-46d6-b9f2-3a200ed548bc" />

<img width="300" height="227" alt="ubah barang" src="https://github.com/user-attachments/assets/f4b97473-a5f9-4bd0-b7fe-e5a5ac7cf49d" />

## Langkah 10 - hapus.php (DELETE / Hapus Data)
Mengambil `id` dari alamat, lalu menjalankan `DELETE FROM data_barang WHERE id_barang = ...`. Setelah itu kembali ke `index.php`. Di `index.php` ada konfirmasi "Yakin mau hapus?" supaya tidak terhapus tidak sengaja.

<img width="591" height="217" alt="hapus php" src="https://github.com/user-attachments/assets/46d54379-7635-4faf-8e5e-6f16357122f5" />

<img width="487" height="145" alt="hapus barang" src="https://github.com/user-attachments/assets/ada55b39-3cb6-4a9d-972f-37694152078b" />

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

## KESIMPULAN

Berdasarkan praktikum yang telah dilakukan, dapat disimpulkan bahwa PHP dapat digunakan untuk membuat aplikasi web yang terhubung dengan database MySQL. Melalui koneksi antara PHP dan MySQL, data dapat disimpan dan dikelola secara dinamis melalui halaman web.

Pada praktikum ini telah berhasil dibuat aplikasi pengelolaan data barang yang menerapkan konsep CRUD, yaitu menambahkan data melalui tambah.php, menampilkan data melalui index.php, mengubah data melalui ubah.php, dan menghapus data melalui hapus.php.

Praktikum ini juga memberikan pemahaman mengenai pembuatan database dan tabel, penggunaan query SQL seperti INSERT, SELECT, UPDATE, dan DELETE, serta penggunaan form PHP untuk mengirim data ke database. Dengan demikian, praktikum PHP dan Database MySQL dapat membantu memahami dasar pembuatan aplikasi web yang mampu mengelola data secara terstruktur dan dinamis.
