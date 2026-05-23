<?php
	include 'config.php';
	$reg_error = '';
	if(isset($_POST['daftar'])){
		$nama        = mysqli_real_escape_string($connect, $_POST['nama']);
		$nim         = mysqli_real_escape_string($connect, $_POST['nim']);
		$username    = mysqli_real_escape_string($connect, $_POST['username']);
		$email       = mysqli_real_escape_string($connect, $_POST['email']);
		$mobilephone = mysqli_real_escape_string($connect, $_POST['MobilePhone']);
		$level       = mysqli_real_escape_string($connect, $_POST['level']);
		$password    = md5($_POST['password']);

		$check = mysqli_query($connect, "SELECT id FROM user WHERE username='$username' LIMIT 1");
		if (mysqli_num_rows($check) > 0) {
			$reg_error = 'Username sudah terdaftar. Coba username lain.';
		} else {
			$sql = "INSERT INTO user (nama, username, password, level, Email, MobilePhone, NIM)
			        VALUES ('$nama', '$username', '$password', '$level', '$email', '$mobilephone', '$nim')";
			if (mysqli_query($connect, $sql)) {
				echo "<script>alert('Berhasil Daftar! Silakan login.');window.location='login.php';</script>";
				exit;
			} else {
				$reg_error = 'Gagal mendaftar: ' . mysqli_error($connect);
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<title>Daftar | Inventaris D3 Teknologi Komputer</title>
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
			grid-template-columns: 1fr 1.2fr;
			min-height: 100vh;
		}

		.auth-brand {
			background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #ec4899 100%);
			color: #fff;
			padding: 56px 60px;
			display: flex; flex-direction: column;
			justify-content: space-between;
			position: relative;
			overflow: hidden;
		}
		.auth-brand::before {
			content: ''; position: absolute; inset: 0;
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
			display: block; opacity: .85;
			font-weight: 500; font-size: 12px;
			text-transform: uppercase; letter-spacing: 0.5px;
		}
		.brand-hero h2 {
			font-size: 34px; font-weight: 800;
			line-height: 1.15; margin: 0 0 14px;
			letter-spacing: -0.02em;
		}
		.brand-hero p { opacity: .9; font-size: 15px; line-height: 1.6; max-width: 420px; }
		.brand-steps {
			margin-top: 28px;
			counter-reset: step;
			list-style: none; padding: 0;
		}
		.brand-steps li {
			counter-increment: step;
			display: flex; align-items: flex-start; gap: 14px;
			margin-bottom: 16px;
			font-size: 14px; opacity: .92;
		}
		.brand-steps li::before {
			content: counter(step);
			width: 28px; height: 28px; flex-shrink: 0;
			border-radius: 50%;
			background: rgba(255,255,255,0.22);
			display: flex; align-items: center; justify-content: center;
			font-weight: 700; font-size: 13px;
		}
		.brand-foot { font-size: 13px; opacity: .75; }

		.auth-form-side {
			background: #fff;
			padding: 48px 60px;
			display: flex; flex-direction: column;
			justify-content: center;
			position: relative;
			overflow-y: auto;
		}
		.auth-back {
			position: absolute; top: 24px; left: 24px;
			color: var(--muted);
			text-decoration: none;
			font-size: 14px; font-weight: 500;
			display: inline-flex; align-items: center; gap: 6px;
		}
		.auth-back:hover { color: var(--brand); text-decoration: none; }

		.auth-form { max-width: 540px; width: 100%; margin: 0 auto; }
		.auth-form h1 {
			font-size: 28px; font-weight: 700;
			margin: 0 0 8px; letter-spacing: -0.01em;
		}
		.auth-form .sub {
			color: var(--muted); margin-bottom: 28px; font-size: 14px;
		}

		.form-grid {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 14px 16px;
		}
		.field { margin-bottom: 4px; }
		.field.full { grid-column: 1 / -1; }
		.field label {
			display: block;
			font-size: 13px; font-weight: 600;
			color: var(--ink);
			margin-bottom: 6px;
		}
		.input-wrap { position: relative; }
		.input-wrap .fa {
			position: absolute; left: 14px; top: 50%;
			transform: translateY(-50%);
			color: var(--muted); font-size: 14px;
		}
		.field input, .field select {
			width: 100%;
			padding: 11px 14px 11px 40px;
			border: 1px solid var(--border);
			border-radius: 9px;
			font-size: 14px;
			font-family: inherit;
			background: #fff;
			transition: all .15s;
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
		}
		.field input:focus, .field select:focus {
			outline: none;
			border-color: var(--brand);
			box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
		}
		.field select {
			background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3e%3cpolyline points='6 9 12 15 18 9'/%3e%3c/svg%3e");
			background-repeat: no-repeat;
			background-position: right 14px center;
			padding-right: 36px;
			cursor: pointer;
		}
		.toggle-pw {
			position: absolute; right: 12px; top: 50%;
			transform: translateY(-50%);
			background: none; border: none;
			color: var(--muted); cursor: pointer;
			padding: 4px 6px; font-size: 14px;
		}
		.toggle-pw:hover { color: var(--brand); }
		.hint {
			font-size: 12px; color: var(--muted);
			margin-top: 4px;
		}

		.terms {
			display: flex; align-items: flex-start; gap: 10px;
			margin: 18px 0 6px;
			font-size: 13px; color: var(--muted);
		}
		.terms input { margin-top: 3px; flex-shrink: 0; }
		.terms a { color: var(--brand); font-weight: 600; text-decoration: none; }

		.actions {
			display: flex; gap: 12px;
			margin-top: 20px;
		}
		.btn-submit {
			flex: 1;
			padding: 12px;
			background: var(--brand);
			color: #fff;
			border: none;
			border-radius: 9px;
			font-weight: 600; font-size: 15px;
			cursor: pointer;
			transition: all .15s;
			font-family: inherit;
		}
		.btn-submit:hover { background: var(--brand-dark); transform: translateY(-1px); box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25); }
		.btn-cancel {
			padding: 12px 22px;
			background: #fff;
			color: var(--ink);
			border: 1px solid var(--border);
			border-radius: 9px;
			font-weight: 600; font-size: 15px;
			text-decoration: none;
			text-align: center;
			transition: all .15s;
			display: inline-flex; align-items: center; justify-content: center;
		}
		.btn-cancel:hover { background: var(--surface); color: var(--ink); text-decoration: none; border-color: var(--muted); }

		.auth-footer {
			margin-top: 24px;
			text-align: center;
			font-size: 14px;
			color: var(--muted);
		}
		.auth-footer a { color: var(--brand); font-weight: 600; text-decoration: none; }
		.auth-footer a:hover { text-decoration: underline; }

		@media (max-width: 900px) {
			.auth-wrap { grid-template-columns: 1fr; }
			.auth-brand { display: none; }
			.auth-form-side { padding: 80px 24px 40px; }
		}
		@media (max-width: 540px) {
			.form-grid { grid-template-columns: 1fr; }
		}
	</style>
</head>
<body>

<div class="auth-wrap">

	<aside class="auth-brand">
		<a href="index.php" class="brand-top">
			<div class="brand-logo"><i class="fa fa-cube"></i></div>
			<div class="brand-text">
				<div>Inventaris D3 TK</div>
				<small>Peminjaman Lab</small>
			</div>
		</a>

		<div class="brand-hero">
			<h2>Buat akunmu dalam hitungan menit.</h2>
			<p>Bergabung dengan komunitas pengguna inventaris laboratorium &mdash; pinjam alat dengan cepat, tertib, dan terlacak.</p>
			<ol class="brand-steps">
				<li>Lengkapi data diri &amp; identitas mahasiswa</li>
				<li>Verifikasi via username yang unik</li>
				<li>Mulai pinjam alat dari katalog</li>
			</ol>
		</div>

		<div class="brand-foot">&copy; <?php echo date('Y'); ?> Kelompok 8 &mdash; PAI Inventarisasi</div>
	</aside>

	<main class="auth-form-side">
		<a href="index.php" class="auth-back"><i class="fa fa-arrow-left"></i> Kembali</a>

		<div class="auth-form">
			<h1>Registrasi akun baru</h1>
			<p class="sub">Sudah punya akun? <a href="login.php" style="color: var(--brand); font-weight:600; text-decoration:none;">Masuk di sini</a></p>

			<?php if (!empty($reg_error)): ?>
				<div style="background:#fef2f2;border:1px solid #fecaca;color:#991b1b;border-radius:9px;padding:12px 14px;margin-bottom:18px;font-size:13px;">
					<i class="fa fa-exclamation-circle"></i> <?php echo htmlspecialchars($reg_error); ?>
				</div>
			<?php endif; ?>

			<form action="" method="post" autocomplete="on">
				<div class="form-grid">

					<div class="field full">
						<label for="nama">Nama Lengkap</label>
						<div class="input-wrap">
							<i class="fa fa-id-card-o"></i>
							<input id="nama" type="text" name="nama" placeholder="Nama sesuai KTM" required autofocus>
						</div>
					</div>

					<div class="field">
						<label for="nim">NIM</label>
						<div class="input-wrap">
							<i class="fa fa-hashtag"></i>
							<input id="nim" type="text" name="nim" placeholder="Nomor Induk Mahasiswa" required>
						</div>
					</div>

					<div class="field">
						<label for="username">Username</label>
						<div class="input-wrap">
							<i class="fa fa-user"></i>
							<input id="username" type="text" name="username" placeholder="username unik" required>
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
						<label for="MobilePhone">No. Telepon</label>
						<div class="input-wrap">
							<i class="fa fa-phone"></i>
							<input id="MobilePhone" type="tel" name="MobilePhone" placeholder="08xxxxxxxxxx" required>
						</div>
					</div>

					<div class="field">
						<label for="password">Password</label>
						<div class="input-wrap">
							<i class="fa fa-lock"></i>
							<input id="password" type="password" name="password" placeholder="Min. 6 karakter" minlength="6" required>
							<button type="button" class="toggle-pw" onclick="togglePw('password', this)" aria-label="Tampilkan password">
								<i class="fa fa-eye"></i>
							</button>
						</div>
					</div>

					<div class="field">
						<label for="level">Kelas / Jabatan</label>
						<div class="input-wrap">
							<i class="fa fa-graduation-cap"></i>
							<input id="level" type="text" name="level" placeholder="Mis. 2A / Dosen" required>
						</div>
					</div>

				</div>

				<label class="terms">
					<input type="checkbox" required>
					<span>Saya menyetujui <a href="#">syarat &amp; ketentuan</a> serta <a href="#">kebijakan privasi</a> peminjaman barang.</span>
				</label>

				<div class="actions">
					<button type="submit" name="daftar" class="btn-submit">
						<i class="fa fa-user-plus"></i> Daftar Sekarang
					</button>
					<a href="index.php" class="btn-cancel">Batal</a>
				</div>
			</form>

			<div class="auth-footer">
				Dengan mendaftar kamu menyetujui ketentuan layanan peminjaman.
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
