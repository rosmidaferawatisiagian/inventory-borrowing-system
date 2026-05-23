<?php
    include 'config.php';
    include '_security.php';

    if (!isset($_GET['id_barang'])) {
        echo "ID Barang tidak tersedia.";
        exit;
    }

    $id_barang = as_int($_GET['id_barang']);
    $query = mysqli_query($connect, "SELECT * FROM tbl_barang WHERE id = $id_barang LIMIT 1");
    $data = $query ? mysqli_fetch_array($query) : null;

    if (!$data) {
        echo "Barang tidak ditemukan.";
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Barang - <?php echo e($data['nama_barang']); ?></title>
    <link rel="stylesheet" type="text/css" href="tambahan/bootstrap-4.1.3/dist/css/bootstrap.css">
</head>
<body>
    <main role="main">
        <div class="container">
            <h2><?php echo e($data['nama_barang']); ?></h2>
        </div>
    </main>
    <script type="text/javascript" src="tambahan/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="tambahan/bootstrap-4.1.3/dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="tambahan/bootstrap-4.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
