<?php
	include '../config.php';
	include '../_security.php';
	require_admin();

	if (empty($_GET['mode']) || !isset($_GET['id'])) {
		header('Location: permintaan.php');
		exit;
	}

	$id   = as_int($_GET['id']);
	$mode = $_GET['mode'];

	$search_request = mysqli_query($connect, "SELECT * FROM tbl_request WHERE id=$id LIMIT 1");
	$data_request   = $search_request ? mysqli_fetch_array($search_request) : null;

	if (!$data_request) {
		echo "Permintaan tidak ditemukan";
		exit;
	}

	$id_request          = as_int($data_request['id']);
	$nama_barang_request = $data_request['nama_barang'];
	$peminjam_request    = $data_request['peminjam'];
	$level_request       = $data_request['level'];
	$jml_barang_request  = as_int($data_request['jml_barang']);
	$tgl_pinjam_request  = $data_request['tgl_pinjam'];
	$tgl_kembali_request = $data_request['tgl_kembali'];

	$nb_e   = db_escape($nama_barang_request);
	$pm_e   = db_escape($peminjam_request);
	$lvl_e  = db_escape($level_request);
	$tp_e   = db_escape($tgl_pinjam_request);
	$tk_e   = db_escape($tgl_kembali_request);

	if ($mode === 'terima') {
		$query_search_barang = mysqli_query($connect, "SELECT * FROM tbl_barang WHERE nama_barang='$nb_e' LIMIT 1");
		$data_search_barang  = $query_search_barang ? mysqli_fetch_array($query_search_barang) : null;

		if (!$data_search_barang) {
			echo "Barang tidak ditemukan";
			exit;
		}

		$stok_barang_baru = as_int($data_search_barang['stok_barang']) - $jml_barang_request;
		if ($stok_barang_baru < 0) {
			echo "<script>alert('Stok tidak mencukupi');window.history.back();</script>";
			exit;
		}

		$update_stok = mysqli_query($connect, "UPDATE tbl_barang SET stok_barang=$stok_barang_baru WHERE nama_barang='$nb_e'");
		if (!$update_stok) { echo "Gagal update stok barang"; exit; }

		if (!mysqli_query($connect,
			"INSERT INTO tbl_pinjam (nama_barang, peminjam, level, jml_barang, tgl_pinjam, tgl_kembali)
			 VALUES ('$nb_e', '$pm_e', '$lvl_e', $jml_barang_request, '$tp_e', '$tk_e')")) {
			echo "Gagal menambah ke tbl_pinjam"; exit;
		}

		if (!mysqli_query($connect, "DELETE FROM tbl_request WHERE id=$id_request")) {
			echo "Gagal menghapus dari tbl_request"; exit;
		}

		$konten = "Permintaan Peminjaman Barang Anda Telah Diterima. " . $jml_barang_request . " buah " . $nama_barang_request . ". Username: " . $peminjam_request . ". Silahkan ke bagian Sarpras untuk mengambil barang";
		$konten_e = db_escape($konten);
		if (!mysqli_query($connect, "INSERT INTO pemberitahuan (username, konten, status) VALUES ('$pm_e', '$konten_e', 'terima')")) {
			echo "Gagal menambah pemberitahuan"; exit;
		}

		echo "<script>alert('Berhasil Menerima Permintaan');window.history.back();</script>";
		exit;

	} else if ($mode === 'tolak') {
		if (!mysqli_query($connect, "DELETE FROM tbl_request WHERE id=$id_request")) {
			echo "Gagal menghapus dari tbl_request"; exit;
		}

		$konten = "Maaf! Permintaan Peminjaman Barang Anda Ditolak. " . $jml_barang_request . " buah " . $nama_barang_request . ". Username: " . $peminjam_request;
		$konten_e = db_escape($konten);
		if (!mysqli_query($connect, "INSERT INTO pemberitahuan (username, konten, status) VALUES ('$pm_e', '$konten_e', 'tolak')")) {
			echo "Gagal menambah pemberitahuan"; exit;
		}

		echo "<script>alert('Berhasil Menolak Permintaan');window.history.back();</script>";
		exit;

	} else {
		echo "Mode tidak dikenali";
		exit;
	}
?>
