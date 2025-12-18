<?php
    // Konfigurasi koneksi ke database
    $host = "localhost";  // Host database
    $username = "root";  // Nama pengguna database
    $password = "";  // Kata sandi database
    $database = "pa_1";  // Nama database

    // Buat koneksi ke database
    $connect = mysqli_connect($host, $username, $password, $database);

    // Periksa koneksi
    if (!$connect) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Mengatur zona waktu
    date_default_timezone_set('Asia/Jakarta');
?>
