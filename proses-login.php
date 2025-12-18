<?php
	session_start();
	include 'config.php';
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);

		$query = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");
		if($query){
			$data = mysqli_fetch_array($query);
			if($password == $data['password']){
				 $_SESSION['username'] = $data['username'];
				 $_SESSION['name'] = $data['nama'];
				if($data['level'] == 'admin'){
					header('location: admin/index.php');
				}else{
					header('location: index.php');
				}
			}else{
				echo "<script>alert('Password Salah atau belum diisi');</script>";
				echo "<script>window.history.back();</script>";
			}
		}else{
			echo "<script>alert('Username tidak terdaftar');</script>";
		}

	}
?>