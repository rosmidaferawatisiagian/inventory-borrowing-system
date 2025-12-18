<?php
    include 'config.php';

    // Periksa apakah parameter id_barang ada dalam URL
    if(isset($_GET['id_barang'])) {
        // Dapatkan nilai id_barang dari parameter URL
        $id_barang = $_GET['id_barang'];

        // Query database untuk mendapatkan detail barang berdasarkan id_barang
        $query = mysqli_query($connect, "SELECT * FROM tbl_barang WHERE id = '$id_barang'");
        $data = mysqli_fetch_array($query);

        // Periksa apakah data barang ditemukan
        if($data) {
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Kode CSS dan head -->
    <title>Detail Barang - <?php echo $data['nama_barang']; ?></title>
    <link rel="stylesheet" type="text/css" href="tambahan/bootstrap-4.1.3/dist/css/bootstrap.css">
    <!-- Tambahkan CSS khusus untuk halaman detail barang -->
    <style>
        /* CSS khusus untuk halaman detail barang */
        /* Tambahkan gaya sesuai kebutuhan Anda */
    </style>
</head>
<body>
    <main role="main">
        <!-- Tambahkan konten halaman detail barang -->
        <div class="container">
            <h2><?php echo $data['nama_barang']; ?></h2>
            <!-- Tampilkan informasi barang lainnya -->
        </div>
    </main>
    <script type="text/javascript" src="tambahan/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="tambahan/bootstrap-4.1.3/dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="tambahan/bootstrap-4.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php
        } else {
            echo "Barang tidak ditemukan.";
        }
    } else {
        echo "ID Barang tidak tersedia.";
    }
?>
