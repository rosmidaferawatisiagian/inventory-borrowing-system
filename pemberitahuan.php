<?php
	include 'config.php';
	include '_security.php';
	require_login();

	$username = current_user();
	$username_esc = db_escape($username);
	$query = mysqli_query($connect, "SELECT * FROM pemberitahuan WHERE username='$username_esc' ORDER BY timestamp DESC");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pemberitahuan | Peminjaman Barang Inventarisasi Laboratorium D3 Teknologi Komputer</title>
	<link rel="stylesheet" type="text/css" href="tambahan/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="tambahan/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="tambahan/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="assets/css/register-style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body style="background-image: url('') !important;">
	<div class="container">
		<div class='row'>
			<div class="col-md-3" style="padding-top: 20px;"></div>
			<div class="col-md-5 form-register-container">
				<?php
				if (mysqli_num_rows($query) > 0) {
					while ($data = mysqli_fetch_array($query)) {
						$alert = 'info';
						if ($data['status'] === 'terima')      $alert = 'success';
						else if ($data['status'] === 'tolak')  $alert = 'danger';
						else if ($data['status'] === 'kembali') $alert = 'info';
						?>
						<div class="alert alert-<?php echo e($alert); ?>">
							<?php echo e($data['konten']); ?><br>
							<strong><?php echo e($data['timestamp']); ?></strong>
						</div>
						<?php
					}
				} else {
					?>
					<div class="alert alert-info">Belum Ada Pemberitahuan</div>
					<?php
				}
				?>

				<a href="index.php" class="btn btn-success">KEMBALI</a>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="tambahan/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="tambahan/bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="tambahan/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
