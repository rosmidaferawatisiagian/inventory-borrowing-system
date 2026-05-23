<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<title>Masuk | Inventaris D3 Teknologi Komputer</title>
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
			--danger: #ef4444;
		}
		* { box-sizing: border-box; }
		html, body { height: 100%; margin: 0; }
		body {
			font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
			color: var(--ink);
			background: var(--surface);
		}

		.auth-wrap {
			display: grid;
			grid-template-columns: 1fr 1fr;
			min-height: 100vh;
		}

		/* ===== Brand side ===== */
		.auth-brand {
			background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #ec4899 100%);
			color: #fff;
			padding: 56px 60px;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			position: relative;
			overflow: hidden;
		}
		.auth-brand::before {
			content: '';
			position: absolute; inset: 0;
			background-image:
				radial-gradient(circle at 20% 30%, rgba(255,255,255,0.18) 0%, transparent 40%),
				radial-gradient(circle at 80% 70%, rgba(255,255,255,0.12) 0%, transparent 40%);
		}
		.auth-brand > * { position: relative; z-index: 1; }
		.brand-top {
			display: flex; align-items: center; gap: 12px;
			color: #fff; text-decoration: none; font-weight: 700;
		}
		.brand-logo {
			width: 44px; height: 44px;
			border-radius: 11px;
			background: rgba(255,255,255,0.2);
			backdrop-filter: blur(8px);
			display: flex; align-items: center; justify-content: center;
			font-size: 20px;
		}
		.brand-text small {
			display: block;
			opacity: .85;
			font-weight: 500;
			font-size: 12px;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}
		.brand-hero h2 {
			font-size: 36px;
			font-weight: 800;
			line-height: 1.15;
			margin: 0 0 16px;
			letter-spacing: -0.02em;
		}
		.brand-hero p { opacity: .9; font-size: 16px; line-height: 1.6; max-width: 440px; }
		.brand-features {
			list-style: none; padding: 0; margin: 28px 0 0;
		}
		.brand-features li {
			display: flex; align-items: flex-start; gap: 12px;
			margin-bottom: 14px; font-size: 14px; opacity: .92;
		}
		.brand-features .ico {
			width: 28px; height: 28px; border-radius: 8px;
			background: rgba(255,255,255,0.2);
			display: flex; align-items: center; justify-content: center;
			flex-shrink: 0; font-size: 12px;
		}
		.brand-foot { font-size: 13px; opacity: .75; }

		/* ===== Form side ===== */
		.auth-form-side {
			background: #fff;
			padding: 56px 60px;
			display: flex; flex-direction: column;
			justify-content: center;
			position: relative;
		}
		.auth-back {
			position: absolute; top: 24px; left: 24px;
			color: var(--muted);
			text-decoration: none;
			font-size: 14px; font-weight: 500;
			display: inline-flex; align-items: center; gap: 6px;
		}
		.auth-back:hover { color: var(--brand); text-decoration: none; }

		.auth-form { max-width: 420px; width: 100%; margin: 0 auto; }
		.auth-form h1 {
			font-size: 28px; font-weight: 700;
			margin: 0 0 8px; letter-spacing: -0.01em;
		}
		.auth-form .sub {
			color: var(--muted); margin-bottom: 32px; font-size: 14px;
		}

		.field { margin-bottom: 18px; }
		.field label {
			display: block;
			font-size: 13px; font-weight: 600;
			color: var(--ink);
			margin-bottom: 6px;
		}
		.input-wrap {
			position: relative;
		}
		.input-wrap .fa {
			position: absolute; left: 14px; top: 50%;
			transform: translateY(-50%);
			color: var(--muted); font-size: 14px;
		}
		.field input {
			width: 100%;
			padding: 11px 14px 11px 40px;
			border: 1px solid var(--border);
			border-radius: 9px;
			font-size: 14px;
			font-family: inherit;
			background: #fff;
			transition: all .15s;
		}
		.field input:focus {
			outline: none;
			border-color: var(--brand);
			box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
		}
		.toggle-pw {
			position: absolute; right: 12px; top: 50%;
			transform: translateY(-50%);
			background: none; border: none;
			color: var(--muted); cursor: pointer;
			padding: 4px 6px; font-size: 14px;
		}
		.toggle-pw:hover { color: var(--brand); }

		.btn-submit {
			width: 100%;
			padding: 12px;
			background: var(--brand);
			color: #fff;
			border: none;
			border-radius: 9px;
			font-weight: 600;
			font-size: 15px;
			cursor: pointer;
			transition: all .15s;
			margin-top: 8px;
			font-family: inherit;
		}
		.btn-submit:hover { background: var(--brand-dark); transform: translateY(-1px); box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25); }
		.btn-submit i { margin-right: 6px; }

		.auth-footer {
			margin-top: 24px;
			text-align: center;
			font-size: 14px;
			color: var(--muted);
		}
		.auth-footer a {
			color: var(--brand); font-weight: 600; text-decoration: none;
		}
		.auth-footer a:hover { text-decoration: underline; }

		.divider {
			display: flex; align-items: center; gap: 12px;
			margin: 24px 0;
			color: var(--muted); font-size: 12px;
		}
		.divider::before, .divider::after {
			content: ''; flex: 1; height: 1px; background: var(--border);
		}

		.demo-hint {
			background: var(--brand-light);
			border: 1px dashed rgba(79, 70, 229, 0.3);
			border-radius: 8px;
			padding: 10px 14px;
			font-size: 12px;
			color: var(--brand-dark);
			margin-bottom: 20px;
		}
		.demo-hint code {
			background: rgba(255,255,255,0.7);
			padding: 1px 6px; border-radius: 4px;
			color: var(--brand-dark); font-size: 11px;
		}

		@media (max-width: 900px) {
			.auth-wrap { grid-template-columns: 1fr; }
			.auth-brand { display: none; }
			.auth-form-side { padding: 80px 24px 40px; }
		}
	</style>
</head>
<body>

<div class="auth-wrap">

	<!-- ===== Left: Brand panel ===== -->
	<aside class="auth-brand">
		<a href="index.php" class="brand-top">
			<div class="brand-logo"><i class="fa fa-cube"></i></div>
			<div class="brand-text">
				<div>Inventaris D3 TK</div>
				<small>Peminjaman Lab</small>
			</div>
		</a>

		<div class="brand-hero">
			<h2>Selamat datang kembali.</h2>
			<p>Masuk untuk mengelola peminjaman alat, melihat status barang, dan menerima pemberitahuan terbaru.</p>
			<ul class="brand-features">
				<li><span class="ico"><i class="fa fa-check"></i></span> Katalog alat &amp; bahan real-time</li>
				<li><span class="ico"><i class="fa fa-check"></i></span> Pantau status pinjaman dalam satu dasbor</li>
				<li><span class="ico"><i class="fa fa-check"></i></span> Notifikasi otomatis pengembalian</li>
			</ul>
		</div>

		<div class="brand-foot">&copy; <?php echo date('Y'); ?> Kelompok 8 &mdash; PAI Inventarisasi</div>
	</aside>

	<!-- ===== Right: Login form ===== -->
	<main class="auth-form-side">
		<a href="index.php" class="auth-back"><i class="fa fa-arrow-left"></i> Kembali</a>

		<div class="auth-form">
			<h1>Masuk ke akunmu</h1>
			<p class="sub">Belum punya akun? <a href="register.php" style="color: var(--brand); font-weight:600; text-decoration:none;">Daftar di sini</a></p>

			<div class="demo-hint">
				<i class="fa fa-info-circle"></i> Akun admin demo: <code>admin</code> / <code>admin</code>
			</div>

			<form action="proses-login.php" method="post" autocomplete="on">
				<div class="field">
					<label for="username">Username</label>
					<div class="input-wrap">
						<i class="fa fa-user"></i>
						<input id="username" type="text" name="username" placeholder="Masukkan username" required autofocus>
					</div>
				</div>

				<div class="field">
					<label for="email">Email</label>
					<div class="input-wrap">
						<i class="fa fa-envelope"></i>
						<input id="email" type="email" name="email" placeholder="nama@email.com" required>
					</div>
				</div>

				<div class="field">
					<label for="password">Password</label>
					<div class="input-wrap">
						<i class="fa fa-lock"></i>
						<input id="password" type="password" name="password" placeholder="Masukkan password" required>
						<button type="button" class="toggle-pw" onclick="togglePw('password', this)" aria-label="Tampilkan password">
							<i class="fa fa-eye"></i>
						</button>
					</div>
				</div>

				<button type="submit" name="login" class="btn-submit">
					<i class="fa fa-sign-in"></i> Masuk
				</button>
			</form>

			<div class="auth-footer">
				Tidak punya akun? <a href="register.php">Daftar sekarang</a>
			</div>
		</div>
	</main>

</div>

<script>
	function togglePw(id, btn) {
		var input = document.getElementById(id);
		var icon = btn.querySelector('i');
		if (input.type === 'password') {
			input.type = 'text';
			icon.classList.remove('fa-eye');
			icon.classList.add('fa-eye-slash');
		} else {
			input.type = 'password';
			icon.classList.remove('fa-eye-slash');
			icon.classList.add('fa-eye');
		}
	}
</script>
</body>
</html>
