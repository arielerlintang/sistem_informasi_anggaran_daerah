<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<title>Login</title>
</head>

<body class="bg-light">

	<div class="container my-5">
		<div class="row mt-4 justify-content-center">
			<div class="mb-1 text-center">
						<img src="assets/files/logo/logo.png" width="130">
					</div>
			<div class="col-md-3 col-sm-3 col-lg-3 border-top border-3 border-primary shadow rounded bg-white p-4 my-2">
				<form method="post">
					<div class="mb-5">
						<h6>Login</h6>
					</div>
					<div class="mb-3">
						<label style="font-size: 12px;">Username</label>
						<input type="text" name="username" class="form-control">
					</div>
					<div class="mb-3">
						<label style="font-size: 12px;">Password</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class="mb-3">
						
					<button type="submit" class="btn btn-primary w-100" name="login">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
			<p class="text-dark text-center"> Copyright &copy; Teamtrainit 2023</p>

	<?php 
	// jika ada tombol login maka php dapatkan semua inputan dari formulir username dan password

	if (isset($_POST['login'])) {
		
		$username = $_POST['username'];
		$password = sha1($_POST['password']);

		 // perintah untuk mencocokan data inputan dengan data yang ada di formilir
		 // menampilkan data adminn yang username_admoin='dari inputan' dan password_admin='password_inputan'
		$cek_admin = $koneksi->query("SELECT * FROM admin WHERE username_admin='$username' AND password_admin='$password '");

		$cek_super_admin = $koneksi->query("SELECT * FROM super_admin WHERE username_super_admin='$username' AND password_super_admin='$password '");



		 // jika ada data yang sama maka tampilkan 1 jika tidak maka 0

		$hitung = $cek_admin->num_rows;
		$hitung_super_admin = $cek_super_admin->num_rows;

		 // jika $hitung samadengan  0 maka kita larikan ke hal login
		if ($hitung==1) {
			$login = $cek_admin->fetch_assoc();
			$_SESSION['admin'] = $login;
			echo "<script>alert('Anda Berhasil Login')</script>";
			echo "<script>location='admin/index.php'</script>";
			
		}
		elseif ($hitung_super_admin==1) {
			$login_super_admin = $cek_super_admin->fetch_assoc();
			$_SESSION['super_admin'] = $login_super_admin;
			echo "<script>alert('Anda Berhasil Login')</script>";
			echo "<script>location='super_admin/index.php'</script>";
		}


		 // selain itu maka kita larikan ke admin index
		else
		{
			echo "<script>alert('Anda Gagal Login')</script>";
			echo "<script>location='index.php'</script>";
		}
		
		 	// untuk menyimpan data si pelogin

		
	}
	?>

</body>
</html>
