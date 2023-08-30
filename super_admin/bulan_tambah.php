<?php include 'header.php'; ?>
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<h6>Tambah bulan</h6>
			<form method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama_bulan" class="form-control">
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

	$nama_bulan = $_POST['nama_bulan'];

	$koneksi->query("INSERT INTO bulan (nama_bulan) VALUES ('$nama_bulan')");

	echo "<script>alert('Data Tersimpan')</script>";
	echo "<script>location='bulan.php'</script>";
}
?>
<?php include 'footer.php'; ?>