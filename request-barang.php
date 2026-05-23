<?php
	include 'config.php';
	include '_security.php';
	require_login();

	if (!isset($_POST['request-pinjam'])) {
		header('Location: index.php');
		exit;
	}

	// Username dari session, bukan dari POST — cegah impersonasi
	$username      = current_user();
	$nama_peminjam = db_escape($_POST['nama_peminjam'] ?? '');
	$level         = db_escape($_POST['level'] ?? '');
	$nama_barang   = db_escape($_POST['nama_barang'] ?? '');
	$jml_barang    = as_int($_POST['jml_barang'] ?? 0);
	$tgl_pinjam    = db_escape($_POST['tgl_pinjam'] ?? '');
	$tgl_kembali   = db_escape($_POST['tgl_kembali'] ?? '');
	$username_esc  = db_escape($username);

	if ($jml_barang <= 0) {
		echo "<script>alert('Jumlah barang harus lebih dari 0.');window.history.back();</script>";
		exit;
	}

	$query_insert_req = mysqli_query($connect,
		"INSERT INTO tbl_request (nama_barang, peminjam, level, jml_barang, tgl_pinjam, tgl_kembali)
		 VALUES ('$nama_barang', '$username_esc', '$level', $jml_barang, '$tgl_pinjam', '$tgl_kembali')");

	if (!$query_insert_req) {
		echo "Gagal mengirim permintaan: " . htmlspecialchars(mysqli_error($connect));
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Request berhasil | Peminjaman Barang Inventarisasi Laboratorium D3 Teknologi Komputer</title>
	<link rel="stylesheet" type="text/css" href="tambahan/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="tambahan/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="tambahan/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="assets/css/register-style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body style="background-image: url('') !important;">
	<div class="container">
		<div class='row'>
			<div class="col-md-3"></div>
			<div class="col-md-6 form-register-container">
				<div class="alert alert-success" style="text-transform: capitalize;">
					Anda Berhasil mengirim permintaan peminjaman barang. Harap tunggu konfirmasi dari admin. Silahkan Cek Menu <a href="pemberitahuan.php?username=<?php echo e($username); ?>">Pemberitahuan</a>
				</div>
				<table class="table table-bordered table-super-condensed">
					<tbody>
						<tr><td>username</td><td><?php echo e($username); ?></td></tr>
						<tr><td>peminjam</td><td><?php echo e($_POST['nama_peminjam'] ?? ''); ?></td></tr>
						<tr><td>Kelas Peminjam</td><td><?php echo e($_POST['level'] ?? ''); ?></td></tr>
						<tr><td>nama barang</td><td><?php echo e($_POST['nama_barang'] ?? ''); ?></td></tr>
						<tr><td>jumlah barang</td><td><?php echo (int)($_POST['jml_barang'] ?? 0); ?></td></tr>
						<tr><td>Tgl pinjam</td><td><?php echo e($_POST['tgl_pinjam'] ?? ''); ?></td></tr>
						<tr><td>Tgl kembali</td><td><?php echo e($_POST['tgl_kembali'] ?? ''); ?></td></tr>
					</tbody>
				</table>
				<a href="index.php" class="btn btn-success">KEMBALI</a>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="tambahan/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="tambahan/bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="tambahan/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
