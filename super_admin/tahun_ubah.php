<?php include 'header.php'; ?>
<?php 
$id_tahun = $_GET['id_tahun'];
$detail = $koneksi->query("SELECT * FROM tahun WHERE id_tahun='$id_tahun'")->fetch_assoc();
 ?>
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<h6>Ubah tahun</h6>
			<form method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama_tahun" class="form-control" value="<?php echo $detail['nama_tahun']; ?>">
				</div>
				<div class="mb-3">
					<button class="btn btn-primary" name="ubah">Ubah</button>
				</div>
			</form>
			<div class="text-end py-2">
				<a href="tahun.php" class="btn btn-outline-primary">Kembali</a>
			</div>	
		</div>
	</div>
</div>
<?php 
if (isset($_POST['ubah'])) {

	$nama_tahun = $_POST['nama_tahun'];

	$koneksi->query("UPDATE tahun SET nama_tahun='$nama_tahun' WHERE id_tahun='$id_tahun'");

	echo "<script>alert('Data Tersimpan')</script>";
	echo "<script>location='tahun.php'</script>";
}
?>
<?php include 'footer.php'; ?>