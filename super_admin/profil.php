<?php include 'header.php' ?>
<?php 
$super_admin = $_SESSION['super_admin'];
$id_super_admin =  $super_admin['id_super_admin'];

// mendapkan id_pelofgin dari session 


$detail = $koneksi->query("SELECT * FROM super_admin WHERE id_super_admin = '$id_super_admin' ")->fetch_assoc();

$_SESSION['super_admin'] = $detail;
?>

<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<h6>Ubah Profil</h6>
			<form method="post">
				<div class="mb-3">
					<label>Username</label>
					<input type="text" name="username" class="form-control rounded-pill" value="<?php echo $detail['username_super_admin'] ?>">
				</div>
				<div class="mb-3">
					<label>Password</label>
					<input type="text" name="password" class="form-control rounded-pill" value="">
				</div>
				<div class="mb-3">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control rounded-pill" value="<?php echo $detail['nama_super_admin'] ?>">
				</div>
				<div class="mb-3">
					<button class="btn btn-primary" type="submit" name="ubah">Ubah</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>

<?php 
// jika ada tombol ubah maka php dapatkan inputan dari form

if (isset($_POST['ubah'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	$nama = $_POST['nama'];

	// jika tidak kosong password maka ubah data dengan mengubah password

	if (!empty($password)) {
		
		$koneksi->query("UPDATE super_admin SET username_super_admin='$username',
			password_super_admin='$password',
			nama_super_admin='$nama' WHERE id_super_admin = '$id_super_admin' ");
	}
	// selain itu maka ubah data tanpa mengubah password
	else
	{

		$koneksi->query("UPDATE super_admin SET username_super_admin='$username',
			nama_super_admin='$nama' WHERE id_super_admin = '$id_super_admin' ");	
	}

	echo "<script>alert('Data Di Ubah')</script>";
	echo "<script>location='profil.php'</script>";
	

}


?>