<?php
	include '../config.php';
	include '../_security.php';
	require_admin();

	if (!isset($_GET['id'])) {
		header('Location: permintaan-kembali.php');
		exit;
	}

	$id = as_int($_GET['id']);

	// Bug lama: query ini tidak punya WHERE — akhirnya selalu ambil baris pertama.
	$query_search_req_kembali = mysqli_query($connect, "SELECT * FROM tbl_req_kembali WHERE id=$id LIMIT 1");
	$data_req_kembali         = $query_search_req_kembali ? mysqli_fetch_array($query_search_req_kembali) : null;

	if (!$data_req_kembali) {
		echo "Data permintaan kembali tidak ditemukan";
		exit;
	}

	$nama_barang = $data_req_kembali['nama_barang'];
	$peminjam    = $data_req_kembali['peminjam'];
	$level       = $data_req_kembali['level'];
	$jml_barang  = as_int($data_req_kembali['jml_barang']);
	$tgl_pinjam  = $data_req_kembali['tgl_pinjam'];
	$tgl_kembali = $data_req_kembali['tgl_kembali'];

	$nb_e  = db_escape($nama_barang);
	$pm_e  = db_escape($peminjam);
	$lvl_e = db_escape($level);
	$tp_e  = db_escape($tgl_pinjam);
	$tk_e  = db_escape($tgl_kembali);

	$query_search_barang = mysqli_query($connect, "SELECT * FROM tbl_barang WHERE nama_barang='$nb_e' LIMIT 1");
	$data_search_barang  = $query_search_barang ? mysqli_fetch_array($query_search_barang) : null;

	if (!$data_search_barang) {
		echo "Barang tidak ditemukan di inventaris";
		exit;
	}

	$stok_barang_baru = as_int($data_search_barang['stok_barang']) + $jml_barang;

	if (!mysqli_query($connect, "UPDATE tbl_barang SET stok_barang=$stok_barang_baru WHERE nama_barang='$nb_e'")) {
		echo "Gagal update stok barang"; exit;
	}

	if (!mysqli_query($connect,
		"INSERT INTO tbl_transaksi (nama_barang, peminjam, level, jml_barang, tgl_pinjam, tgl_kembali)
		 VALUES ('$nb_e', '$pm_e', '$lvl_e', $jml_barang, '$tp_e', '$tk_e')")) {
		echo "Gagal insert ke tbl_transaksi"; exit;
	}

	if (!mysqli_query($connect, "DELETE FROM tbl_req_kembali WHERE id=$id")) {
		echo "Gagal hapus dari tbl_req_kembali"; exit;
	}

	$konten   = "Permintaan Pengembalian Barang Anda Telah Diterima. " . $jml_barang . " buah " . $nama_barang . ". Username: " . $peminjam;
	$konten_e = db_escape($konten);

	if (!mysqli_query($connect, "INSERT INTO pemberitahuan (username, konten, status) VALUES ('$pm_e', '$konten_e', 'kembali')")) {
		echo "Gagal menambah pemberitahuan"; exit;
	}

	echo "<script>alert('Berhasil Memproses Pengembalian Barang');window.location='barang-dipinjam.php';</script>";
?>
