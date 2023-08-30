<?php include 'header.php'; ?>
<?php 
$id_bulan = $_GET['id_bulan'];
$detail = $koneksi->query("SELECT * FROM bulan WHERE id_bulan='$id_bulan'")->fetch_assoc();
 ?>
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<h6>Ubah bulan</h6>
			<form method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama_bulan" class="form-control" value="<?php echo $detail['nama_bulan']; ?>">
				</div>
				<div class="mb-3">
					<button class="btn btn-primary" name="ubah">Ubah</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php 
if (isset($_POST['ubah'])) {

	$nama_bulan = $_POST['nama_bulan'];

	$koneksi->query("UPDATE bulan SET nama_bulan='$nama_bulan' WHERE id_bulan='$id_bulan'");

	echo "<script>alert('Data Tersimpan')</script>";
	echo "<script>location='bulan.php'</script>";
}
?>
<?php include 'footer.php'; ?>