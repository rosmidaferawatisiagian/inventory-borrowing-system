<?php
	session_start();
	include 'config.php';

	if (isset($_POST['login'])) {
		$username = mysqli_real_escape_string($connect, $_POST['username']);
		$password = md5($_POST['password']);

		$query = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username' LIMIT 1");

		if ($query && mysqli_num_rows($query) > 0) {
			$data = mysqli_fetch_array($query);
			if ($password === $data['password']) {
				$_SESSION['username'] = $data['username'];
				$_SESSION['name']     = $data['nama'];
				$_SESSION['level']    = $data['level'];
				if ($data['level'] === 'admin') {
					header('Location: admin/index.php');
				} else {
					header('Location: index.php');
				}
				exit;
			} else {
				echo "<script>alert('Password salah. Silakan coba lagi.');window.location='login.php';</script>";
				exit;
			}
		} else {
			echo "<script>alert('Username tidak terdaftar.');window.location='login.php';</script>";
			exit;
		}
	} else {
		header('Location: login.php');
		exit;
	}
?>
