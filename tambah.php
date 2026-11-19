<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

// CREATE: jalan kalau tombol Simpan ditekan
if (isset($_POST['submit'])) {
    $nama       = $_POST['nama'];
    $kategori   = $_POST['kategori'];
    $harga_jual = (int) $_POST['harga_jual'];
    $harga_beli = (int) $_POST['harga_beli'];
    $stok       = (int) $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;

    // Kalau ada file gambar yang dipilih
    if ($file_gambar['error'] == 0) {
        // Ganti spasi dengan _ dan buang karakter aneh
        $filename = preg_replace('/[^A-Za-z0-9._-]/', '_', str_replace(' ', '_', $file_gambar['name']));
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $boleh = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $destination = dirname(__FILE__) . '/gambar/' . $filename;

        if (in_array($ext, $boleh) && move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = $filename;
        }
    }

    // Prepared statement = cara aman memasukkan data
    $stmt = mysqli_prepare($conn,
        "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssiiis", $nama, $kategori, $harga_jual, $harga_beli, $stok, $gambar);
    mysqli_stmt_execute($stmt);

    header('location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Tambah Barang</title>
</head>
<body>
<div class="container">
    <h1>Tambah Barang</h1>
    <div class="main">
        <form method="post" action="tambah.php" enctype="multipart/form-data">
            <div class="input">
                <label>Nama Barang</label>
                <input type="text" name="nama" required />
            </div>
            <div class="input">
                <label>Kategori</label>
                <select name="kategori">
                    <option value="Komputer">Komputer</option>
                    <option value="Elektronik">Elektronik</option>
                    <option value="Hand Phone">Hand Phone</option>
                </select>
            </div>
            <div class="input">
                <label>Harga Jual</label>
                <input type="text" name="harga_jual" />
            </div>
            <div class="input">
                <label>Harga Beli</label>
                <input type="text" name="harga_beli" />
            </div>
            <div class="input">
                <label>Stok</label>
                <input type="text" name="stok" />
            </div>
            <div class="input">
                <label>File Gambar</label>
                <input type="file" name="file_gambar" />
            </div>
            <div class="submit">
                <input type="submit" name="submit" value="Simpan" />
            </div>
        </form>
    </div>
</div>
</body>
</html>
