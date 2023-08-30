<?php include 'header.php'; ?>
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<h6>Tambah admin</h6>
			<form method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama_admin" class="form-control">
				</div>
				<div class="mb-3">
					<label class="form-label">username</label>
					<input type="text" name="username_admin" class="form-control">
				</div>
				<div class="mb-3">
					<label class="form-label">Password</label>
					<input type="password" name="password_admin" class="form-control">
				</div>
				<div class="mb-3">
					<button class="btn btn-primary" name="simpan">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php 
if (isset($_POST['simpan'])) {

	$username_admin = $_POST['username_admin'];
	$password_admin = sha1($_POST['password_admin']);
	$nama_admin = $_POST['nama_admin'];

	// skrip ngecek data admin 

	$cek = $koneksi->query("SELECT * FROM admin WHERE username_admin = '$username_admin' ");
	$hitung = $cek->num_rows;
	if ($hitung==1) {
		
	echo "<script>alert('username telah di gunakan')</script>";
	echo "<script>location='admin_tambah.php'</script>";	
	}
	else
	{

	$koneksi->query("INSERT INTO admin (username_admin,password_admin,nama_admin) VALUES ('$username_admin','$password_admin','$nama_admin')");

	echo "<script>alert('Data Tersimpan')</script>";
	echo "<script>location='admin.php'</script>";
	}


}
?>
<?php include 'footer.php'; ?>