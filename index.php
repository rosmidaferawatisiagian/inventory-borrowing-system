<?php
	session_start();
	include 'config.php';

	$is_logged_in = isset($_SESSION['username']);
	$username = $is_logged_in ? $_SESSION['username'] : '';

	$search = isset($_GET['q']) ? trim($_GET['q']) : '';
	$where = '';
	if ($search !== '') {
		$s = mysqli_real_escape_string($connect, $search);
		$where = "WHERE nama_barang LIKE '%$s%'";
	}

	$stats = mysqli_fetch_assoc(mysqli_query($connect,
		"SELECT COUNT(*) AS jenis, COALESCE(SUM(stok_barang),0) AS stok FROM tbl_barang"));
	$baik = mysqli_fetch_assoc(mysqli_query($connect,
		"SELECT COUNT(*) AS c FROM tbl_barang WHERE kondisi_barang='Baik'"));

	$query = mysqli_query($connect, "SELECT * FROM tbl_barang $where ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<title>Dashboard - Peminjaman Inventaris D3 Teknologi Komputer</title>
	<link rel="stylesheet" type="text/css" href="tambahan/bootstrap-4.1.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="tambahan/font-awesome/css/font-awesome.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<style>
		:root {
			--brand: #4f46e5;
			--brand-dark: #4338ca;
			--brand-light: #eef2ff;
			--ink: #0f172a;
			--muted: #64748b;
			--surface: #f8fafc;
			--border: #e2e8f0;
			--success: #10b981;
			--warning: #f59e0b;
			--danger: #ef4444;
		}
		* { box-sizing: border-box; }
		body {
			font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
			background: var(--surface);
			color: var(--ink);
			margin: 0;
		}

		/* ===== Navbar ===== */
		.topbar {
			background: #fff;
			border-bottom: 1px solid var(--border);
			padding: 14px 0;
			position: sticky;
			top: 0;
			z-index: 1020;
			box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
		}
		.topbar .brand {
			display: flex;
			align-items: center;
			gap: 12px;
			color: var(--ink);
			text-decoration: none;
			font-weight: 700;
		}
		.topbar .brand-logo {
			width: 40px; height: 40px;
			border-radius: 10px;
			background: linear-gradient(135deg, var(--brand), #7c3aed);
			color: #fff;
			display: flex; align-items: center; justify-content: center;
			font-size: 18px;
		}
		.topbar .brand-text { line-height: 1.1; }
		.topbar .brand-text small {
			display: block; color: var(--muted);
			font-weight: 500; font-size: 11px; text-transform: uppercase;
			letter-spacing: 0.5px;
		}
		.user-chip {
			display: inline-flex; align-items: center; gap: 10px;
			padding: 6px 14px 6px 6px;
			background: var(--brand-light);
			border-radius: 999px;
			color: var(--brand-dark);
			font-weight: 600; font-size: 14px;
		}
		.user-chip .avatar {
			width: 28px; height: 28px; border-radius: 50%;
			background: var(--brand); color: #fff;
			display: inline-flex; align-items: center; justify-content: center;
			font-size: 12px; font-weight: 700;
		}
		.btn-ghost {
			color: var(--ink); background: transparent;
			border: 1px solid var(--border);
			padding: 7px 16px; border-radius: 8px; font-weight: 500;
			text-decoration: none; font-size: 14px;
			transition: all .15s;
		}
		.btn-ghost:hover { background: var(--surface); color: var(--ink); text-decoration: none; }
		.btn-primary-c {
			background: var(--brand); color: #fff;
			border: 1px solid var(--brand);
			padding: 7px 16px; border-radius: 8px; font-weight: 600;
			text-decoration: none; font-size: 14px;
			transition: all .15s;
		}
		.btn-primary-c:hover { background: var(--brand-dark); color: #fff; text-decoration: none; }

		/* ===== Hero ===== */
		.hero {
			background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #ec4899 100%);
			color: #fff;
			padding: 56px 0 80px;
			position: relative;
			overflow: hidden;
		}
		.hero::before {
			content: ''; position: absolute; inset: 0;
			background-image: radial-gradient(circle at 20% 30%, rgba(255,255,255,0.15) 0%, transparent 40%),
				radial-gradient(circle at 80% 70%, rgba(255,255,255,0.1) 0%, transparent 40%);
		}
		.hero .container { position: relative; z-index: 1; }
		.hero h1 {
			font-size: 38px; font-weight: 800;
			line-height: 1.15; margin: 12px 0 16px;
			letter-spacing: -0.02em;
		}
		.hero .lead { font-size: 17px; opacity: .92; max-width: 640px; }
		.hero .eyebrow {
			display: inline-block;
			background: rgba(255,255,255,0.18);
			backdrop-filter: blur(8px);
			padding: 6px 14px; border-radius: 999px;
			font-size: 12px; font-weight: 600;
			text-transform: uppercase; letter-spacing: 1px;
		}

		/* ===== Stat cards (overlap hero) ===== */
		.stats-row { margin-top: -48px; position: relative; z-index: 2; }
		.stat-card {
			background: #fff;
			border-radius: 14px;
			padding: 22px 24px;
			box-shadow: 0 4px 16px rgba(15, 23, 42, 0.06), 0 1px 3px rgba(15, 23, 42, 0.04);
			display: flex; align-items: center; gap: 16px;
			height: 100%;
		}
		.stat-icon {
			width: 48px; height: 48px; border-radius: 12px;
			display: flex; align-items: center; justify-content: center;
			font-size: 20px; flex-shrink: 0;
		}
		.stat-icon.indigo { background: #eef2ff; color: #4f46e5; }
		.stat-icon.emerald { background: #ecfdf5; color: #10b981; }
		.stat-icon.amber { background: #fffbeb; color: #f59e0b; }
		.stat-card .label { font-size: 12px; color: var(--muted); font-weight: 500; text-transform: uppercase; letter-spacing: .5px; }
		.stat-card .value { font-size: 26px; font-weight: 700; color: var(--ink); line-height: 1.1; }

		/* ===== Toolbar ===== */
		.toolbar {
			background: #fff;
			border: 1px solid var(--border);
			border-radius: 12px;
			padding: 16px 20px;
			margin-top: 28px;
			display: flex; align-items: center; justify-content: space-between;
			gap: 16px; flex-wrap: wrap;
		}
		.toolbar h4 { margin: 0; font-size: 18px; font-weight: 700; }
		.toolbar h4 small { color: var(--muted); font-weight: 500; font-size: 13px; margin-left: 8px; }
		.search-box { position: relative; min-width: 280px; }
		.search-box input {
			width: 100%;
			padding: 9px 14px 9px 38px;
			border: 1px solid var(--border);
			border-radius: 8px;
			font-size: 14px;
			background: var(--surface);
			transition: all .15s;
		}
		.search-box input:focus {
			outline: none; background: #fff;
			border-color: var(--brand);
			box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
		}
		.search-box .fa {
			position: absolute; left: 14px; top: 50%;
			transform: translateY(-50%); color: var(--muted);
		}

		/* ===== Product cards ===== */
		.products { padding: 24px 0 60px; }
		.product-card {
			background: #fff;
			border: 1px solid var(--border);
			border-radius: 14px;
			overflow: hidden;
			transition: all .2s ease;
			display: flex; flex-direction: column;
			height: 100%;
		}
		.product-card:hover {
			transform: translateY(-4px);
			box-shadow: 0 12px 32px rgba(15, 23, 42, 0.08);
			border-color: transparent;
		}
		.product-img {
			height: 200px;
			background: var(--surface);
			display: flex; align-items: center; justify-content: center;
			overflow: hidden;
			position: relative;
		}
		.product-img img {
			width: 100%; height: 100%; object-fit: cover;
		}
		.product-badge {
			position: absolute; top: 12px; right: 12px;
			padding: 4px 10px; border-radius: 999px;
			font-size: 11px; font-weight: 600;
			background: rgba(255,255,255,0.95);
			color: var(--ink);
			backdrop-filter: blur(8px);
		}
		.product-badge.good { color: var(--success); }
		.product-badge.broken { color: var(--danger); }
		.product-body { padding: 16px 18px 18px; flex: 1; display: flex; flex-direction: column; }
		.product-title {
			font-size: 15px; font-weight: 600;
			color: var(--ink); margin: 0 0 8px;
			line-height: 1.35;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;
			min-height: 41px;
		}
		.product-meta {
			display: flex; align-items: center; gap: 14px;
			color: var(--muted); font-size: 13px;
			margin-bottom: 14px;
		}
		.product-meta .fa { margin-right: 4px; }
		.btn-detail {
			display: block; text-align: center;
			padding: 9px;
			background: var(--brand-light);
			color: var(--brand-dark);
			border-radius: 8px;
			font-weight: 600; font-size: 14px;
			text-decoration: none;
			transition: all .15s;
			margin-top: auto;
		}
		.btn-detail:hover {
			background: var(--brand); color: #fff;
			text-decoration: none;
		}

		.empty {
			text-align: center; padding: 60px 20px;
			color: var(--muted);
		}
		.empty .fa { font-size: 48px; margin-bottom: 16px; opacity: .4; }

		/* ===== Quick actions (logged in) ===== */
		.quick-actions {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 14px; margin-top: 24px;
		}
		.quick-action {
			background: #fff;
			border: 1px solid var(--border);
			border-radius: 12px;
			padding: 18px;
			text-decoration: none;
			color: var(--ink);
			display: flex; align-items: center; gap: 14px;
			transition: all .15s;
		}
		.quick-action:hover {
			text-decoration: none; color: var(--ink);
			border-color: var(--brand);
			box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1);
			transform: translateY(-2px);
		}
		.quick-action .icon {
			width: 42px; height: 42px; border-radius: 10px;
			display: flex; align-items: center; justify-content: center;
			font-size: 17px; flex-shrink: 0;
		}
		.qa-warn { background: #fffbeb; color: #f59e0b; }
		.qa-info { background: #ecfeff; color: #06b6d4; }
		.qa-primary { background: #eef2ff; color: #4f46e5; }
		.qa-success { background: #ecfdf5; color: #10b981; }
		.quick-action .title { font-weight: 600; font-size: 14px; line-height: 1.2; }
		.quick-action .desc { font-size: 12px; color: var(--muted); margin-top: 2px; }

		@media (max-width: 768px) {
			.hero { padding: 40px 0 70px; }
			.hero h1 { font-size: 28px; }
			.quick-actions { grid-template-columns: repeat(2, 1fr); }
			.toolbar { flex-direction: column; align-items: stretch; }
			.search-box { min-width: 0; width: 100%; }
		}

		/* ===== Footer ===== */
		.site-footer {
			background: #0f172a;
			color: #cbd5e1;
			padding: 40px 0 24px;
			margin-top: 40px;
		}
		.site-footer h5 { color: #fff; font-weight: 700; margin-bottom: 14px; font-size: 15px; }
		.site-footer p, .site-footer a { color: #94a3b8; font-size: 14px; line-height: 1.7; text-decoration: none; }
		.site-footer a:hover { color: #fff; }
		.footer-bottom {
			border-top: 1px solid #1e293b;
			margin-top: 28px; padding-top: 18px;
			color: #64748b; font-size: 13px; text-align: center;
		}
	</style>
</head>
<body>

	<!-- ===== Top navbar ===== -->
	<nav class="topbar">
		<div class="container d-flex align-items-center justify-content-between">
			<a href="index.php" class="brand">
				<div class="brand-logo"><i class="fa fa-cube"></i></div>
				<div class="brand-text">
					<div>Inventaris D3 TK</div>
					<small>Peminjaman Lab</small>
				</div>
			</a>
			<div class="d-flex align-items-center" style="gap: 10px;">
				<?php if ($is_logged_in): ?>
					<span class="user-chip d-none d-sm-inline-flex">
						<span class="avatar"><?php echo strtoupper(substr($username, 0, 1)); ?></span>
						<?php echo htmlspecialchars($username); ?>
					</span>
					<a href="logout.php" class="btn-ghost"><i class="fa fa-sign-out"></i> Logout</a>
				<?php else: ?>
					<a href="login.php" class="btn-ghost">Masuk</a>
					<a href="register.php" class="btn-primary-c">Daftar</a>
				<?php endif; ?>
			</div>
		</div>
	</nav>

	<!-- ===== Hero ===== -->
	<section class="hero">
		<div class="container">
			<span class="eyebrow"><i class="fa fa-flask"></i> Laboratorium D3 Teknologi Komputer</span>
			<h1>
				<?php if ($is_logged_in): ?>
					Halo, <?php echo htmlspecialchars($username); ?> &mdash; mari pinjam alat untuk eksperimenmu.
				<?php else: ?>
					Peminjaman Barang Inventaris jadi lebih mudah.
				<?php endif; ?>
			</h1>
			<p class="lead">
				Telusuri katalog alat &amp; bahan praktikum, ajukan peminjaman dalam hitungan detik,
				dan pantau status barang yang sedang kamu pinjam &mdash; semua di satu dasbor.
			</p>
		</div>
	</section>

	<div class="container">

		<!-- ===== Stat cards overlapping hero ===== -->
		<div class="row stats-row no-gutters" style="gap: 0;">
			<div class="col-md-4 pr-md-3 mb-3 mb-md-0">
				<div class="stat-card">
					<div class="stat-icon indigo"><i class="fa fa-archive"></i></div>
					<div>
						<div class="label">Jenis Barang</div>
						<div class="value"><?php echo (int)$stats['jenis']; ?></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 px-md-2 mb-3 mb-md-0">
				<div class="stat-card">
					<div class="stat-icon emerald"><i class="fa fa-cubes"></i></div>
					<div>
						<div class="label">Total Stok Tersedia</div>
						<div class="value"><?php echo (int)$stats['stok']; ?></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 pl-md-3">
				<div class="stat-card">
					<div class="stat-icon amber"><i class="fa fa-check-circle"></i></div>
					<div>
						<div class="label">Kondisi Baik</div>
						<div class="value"><?php echo (int)$baik['c']; ?></div>
					</div>
				</div>
			</div>
		</div>

		<?php if ($is_logged_in): ?>
		<!-- ===== Quick actions ===== -->
		<div class="quick-actions">
			<a href="data-request.php?username=<?php echo urlencode($username); ?>" class="quick-action">
				<div class="icon qa-warn"><i class="fa fa-question"></i></div>
				<div>
					<div class="title">Permintaan</div>
					<div class="desc">Daftar pengajuan</div>
				</div>
			</a>
			<a href="pemberitahuan.php?username=<?php echo urlencode($username); ?>" class="quick-action">
				<div class="icon qa-info"><i class="fa fa-bell"></i></div>
				<div>
					<div class="title">Pemberitahuan</div>
					<div class="desc">Notifikasi terbaru</div>
				</div>
			</a>
			<a href="barang-dipinjam.php?username=<?php echo urlencode($username); ?>" class="quick-action">
				<div class="icon qa-primary"><i class="fa fa-shopping-cart"></i></div>
				<div>
					<div class="title">Sedang Dipinjam</div>
					<div class="desc">Barang aktif</div>
				</div>
			</a>
			<a href="barang-dikembalikan.php?username=<?php echo urlencode($username); ?>" class="quick-action">
				<div class="icon qa-success"><i class="fa fa-check"></i></div>
				<div>
					<div class="title">Dikembalikan</div>
					<div class="desc">Riwayat pengembalian</div>
				</div>
			</a>
		</div>
		<?php endif; ?>

		<!-- ===== Toolbar with search ===== -->
		<div class="toolbar">
			<h4>Katalog Barang <small>pilih barang yang ingin dipinjam</small></h4>
			<form method="get" class="search-box">
				<i class="fa fa-search"></i>
				<input type="text" name="q" placeholder="Cari nama barang..." value="<?php echo htmlspecialchars($search); ?>">
			</form>
		</div>

		<!-- ===== Product grid ===== -->
		<div class="products">
			<div class="row">
				<?php
					$found = false;
					while ($data = mysqli_fetch_array($query)):
						$found = true;
						$kondisi = $data['kondisi_barang'];
						$kondisi_class = ($kondisi === 'Baik') ? 'good' : 'broken';
						$stok = (int)$data['stok_barang'];
				?>
				<div class="col-md-4 col-sm-6 mb-4">
					<div class="product-card">
						<div class="product-img">
							<img src="assets/img/uploads/<?php echo htmlspecialchars($data['gambar_barang']); ?>"
								 alt="<?php echo htmlspecialchars($data['nama_barang']); ?>"
								 onerror="this.style.display='none'; this.parentNode.innerHTML='<i class=\'fa fa-image\' style=\'font-size:42px;color:#cbd5e1\'></i>'+this.parentNode.innerHTML;">
							<span class="product-badge <?php echo $kondisi_class; ?>">
								<i class="fa fa-circle" style="font-size:8px;"></i> <?php echo htmlspecialchars($kondisi); ?>
							</span>
						</div>
						<div class="product-body">
							<h6 class="product-title"><?php echo htmlspecialchars($data['nama_barang']); ?></h6>
							<div class="product-meta">
								<span><i class="fa fa-cubes"></i> Stok: <strong><?php echo $stok; ?></strong></span>
								<span><i class="fa fa-hashtag"></i> ID: <?php echo (int)$data['id']; ?></span>
							</div>
							<a href="proses-pinjam.php?username=<?php echo urlencode($username); ?>&id_barang=<?php echo (int)$data['id']; ?>"
							   class="btn-detail">
								<i class="fa fa-eye"></i> Lihat Detail
							</a>
						</div>
					</div>
				</div>
				<?php endwhile; ?>

				<?php if (!$found): ?>
					<div class="col-12">
						<div class="empty">
							<i class="fa fa-search"></i>
							<h5>Tidak ada barang ditemukan</h5>
							<p>Coba kata kunci lain atau <a href="index.php">tampilkan semua barang</a>.</p>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>

	</div>

	<!-- ===== Footer ===== -->
	<footer class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6 mb-4 mb-md-0">
					<h5>Tentang Aplikasi</h5>
					<p>
						Peminjaman Barang Inventaris D3 Teknologi Komputer adalah aplikasi berbasis web
						untuk mempermudah penanganan sarana &amp; prasarana laboratorium,
						sejalan dengan perkembangan teknologi informasi.
					</p>
				</div>
				<div class="col-md-3 mb-4 mb-md-0">
					<h5>Tautan</h5>
					<p>
						<a href="index.php"><i class="fa fa-home"></i> Beranda</a><br>
						<?php if ($is_logged_in): ?>
							<a href="barang-dipinjam.php?username=<?php echo urlencode($username); ?>"><i class="fa fa-shopping-cart"></i> Dipinjam</a><br>
							<a href="logout.php"><i class="fa fa-sign-out"></i> Keluar</a>
						<?php else: ?>
							<a href="login.php"><i class="fa fa-sign-in"></i> Masuk</a><br>
							<a href="register.php"><i class="fa fa-user-plus"></i> Daftar</a>
						<?php endif; ?>
					</p>
				</div>
				<div class="col-md-3">
					<h5>Kontak</h5>
					<p>
						<i class="fa fa-phone"></i> +62 821 6338 7810<br>
						<i class="fa fa-envelope"></i> rosmidaferawatisiagian@gmail.com
					</p>
				</div>
			</div>
			<div class="footer-bottom">
				&copy; <?php echo date('Y'); ?> Kelompok 8 &mdash; PAI Inventarisasi D3 Teknologi Komputer
			</div>
		</div>
	</footer>

	<script src="tambahan/jquery/dist/jquery.min.js"></script>
	<script src="tambahan/bootstrap-4.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
