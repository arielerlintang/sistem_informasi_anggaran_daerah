<?php include 'header.php'; ?>
<?php 
$id_admin = $_GET['id_admin'];
$admin = $koneksi->query("SELECT * FROM admin WHERE id_admin='$id_admin'")->fetch_assoc();
 ?>
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<h6>Tambah admin</h6>
			<form method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama_admin" class="form-control" value="<?php echo $admin['nama_admin'] ?>">
				</div>
				<div class="mb-3">
					<label class="form-label">username</label>
					<input type="text" name="username_admin" class="form-control" value="<?php echo $admin['username_admin'] ?>">
				</div>
				<div class="mb-3">
					<label class="form-label">Password</label>
					<input type="password" name="password_admin" class="form-control" value="<?php echo $admin['password_admin'] ?>">
				</div>
				<div class="mb-3">
					<button class="btn btn-primary" name="simpan">Ubah</button>
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

	

	$koneksi->query("UPDATE admin SET username_admin='$username_admin',
		password_admin='$password_admin',
		nama_admin='$nama_admin' WHERE id_admin='$id_admin'");

	echo "<script>alert('Data Terubah')</script>";
	echo "<script>location='admin.php'</script>";



}
?>
<?php include 'footer.php'; ?>