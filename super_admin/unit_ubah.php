<?php include 'header.php'; ?>
<?php 
$id_unit = $_GET['id_unit'];
$detail = $koneksi->query("SELECT * FROM unit WHERE id_unit='$id_unit'")->fetch_assoc();
 ?>
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<h6>Ubah Unit</h6>
			<form method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama_unit" class="form-control" value="<?php echo $detail['nama_unit']; ?>">
				</div>
				<div class="mb-3">
					<button class="btn btn-primary" name="ubah">Ubah</button>
				</div>
			</form>
			
			<div class="text-end py-2">
				<a href="unit.php" class="btn btn-outline-primary">Kembali</a>
			</div>	
		</div>
	</div>
</div>
<?php 
if (isset($_POST['ubah'])) {

	$nama_unit = $_POST['nama_unit'];

	$koneksi->query("UPDATE unit SET nama_unit='$nama_unit' WHERE id_unit='$id_unit'");

	echo "<script>alert('Data Tersimpan')</script>";
	echo "<script>location='unit.php'</script>";
}
?>
<?php include 'footer.php'; ?>