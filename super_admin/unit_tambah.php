<?php include 'header.php'; ?>
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<h6>Tambah unit</h6>
			<form method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama_unit" class="form-control">
				</div>
				<div class="mb-3">
					<button class="btn btn-primary" name="simpan">Simpan</button>
				</div>
			</form>
			<div class="text-end py-2">
				<a href="unit.php" class="btn btn-outline-primary">Kembali</a>
			</div>	

		</div>
	</div>
</div>
<?php 
if (isset($_POST['simpan'])) {

	$nama_unit = $_POST['nama_unit'];

	$koneksi->query("INSERT INTO unit (nama_unit) VALUES ('$nama_unit')");

	echo "<script>alert('Data Tersimpan')</script>";
	echo "<script>location='unit.php'</script>";
}
?>
<?php include 'footer.php'; ?>