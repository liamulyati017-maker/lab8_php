<?php
// Data untuk masuk ke MySQL (bawaan XAMPP)
$host = "localhost";
$user = "root";
$pass = "";
$db   = "latihan1";

// Mencoba menyambung ke database
$conn = mysqli_connect($host, $user, $pass, $db);

// Kalau gagal, tampilkan pesan lalu berhenti
if ($conn == false) {
    echo "Koneksi ke server gagal.";
    die();
}
// Hapus tanda # di depan baris di bawah untuk tes koneksi:
#echo "Koneksi berhasil";

mysqli_set_charset($conn, "utf8mb4");
?>
