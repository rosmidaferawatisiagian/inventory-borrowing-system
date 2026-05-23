<?php
	include 'config.php';
	include '_security.php';
	require_login();

	if (!isset($_GET['id'])) {
		header('Location: index.php');
		exit;
	}

	$id = as_int($_GET['id']);

	$query_search_pinjam = mysqli_query($connect, "SELECT * FROM tbl_pinjam WHERE id=$id LIMIT 1");
	if (!$query_search_pinjam || mysqli_num_rows($query_search_pinjam) === 0) {
		echo "<script>alert('Data pinjaman tidak ditemukan.');window.location='index.php';</script>";
		exit;
	}
	$data_pinjam = mysqli_fetch_array($query_search_pinjam);

	// Authorization: peminjam hanya boleh request kembali atas pinjamannya sendiri
	if ($data_pinjam['peminjam'] !== current_user()) {
		echo "<script>alert('Anda tidak berhak mengembalikan pinjaman ini.');window.location='index.php';</script>";
		exit;
	}

	$nama_barang  = db_escape($data_pinjam['nama_barang']);
	$peminjam     = db_escape($data_pinjam['peminjam']);
	$level        = db_escape($data_pinjam['level']);
	$jml_barang   = as_int($data_pinjam['jml_barang']);
	$tgl_pinjam   = db_escape($data_pinjam['tgl_pinjam']);
	$tgl_kembali  = db_escape($data_pinjam['tgl_kembali']);

	$query_request_kembali = mysqli_query($connect,
		"INSERT INTO tbl_req_kembali (nama_barang, peminjam, level, jml_barang, tgl_pinjam, tgl_kembali)
		 VALUES ('$nama_barang', '$peminjam', '$level', $jml_barang, '$tgl_pinjam', '$tgl_kembali')");

	if (!$query_request_kembali) {
		die('Gagal insert ke tbl_req_kembali');
	}

	$query_delete_pinjam = mysqli_query($connect, "DELETE FROM tbl_pinjam WHERE id=$id");
	if (!$query_delete_pinjam) {
		die('Gagal delete tbl_pinjam');
	}

	echo "<script>alert('Berhasil Request Pengembalian Barang');window.location='barang-dipinjam.php?username=" . urlencode($data_pinjam['peminjam']) . "';</script>";
?>
