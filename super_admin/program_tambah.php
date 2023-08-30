<?php include 'header.php'; ?>
<?php 
$id_unit = $_GET['id_unit'];
$unit = $koneksi->query("SELECT * FROM unit")->fetch_assoc();

?>

<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<form method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">kode</label>
					<input type="text" name="kode_program" class="form-control">
				</div>
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama_program" class="form-control">
				</div>
				<div class="mb-3">
					<button class="btn btn-primary" name="simpan">Simpan</button>
				</div>
			</form>

			<div class="text-end py-2">
				<a href="program.php?id_unit=<?php echo $id_unit; ?>" class="btn btn-outline-primary">Kembali</a>
			</div>	
		</div>

	</div>
</div>
<?php 
if (isset($_POST['simpan'])) {
	$id_unit = $_GET['id_unit'];
	$kode_program = $_POST['kode_program'];
	$nama_program = $_POST['nama_program'];

	$koneksi->query("INSERT INTO program (id_unit,kode_program,nama_program) VALUES ('$id_unit','$kode_program','$nama_program')");

	echo "<script>alert('Data Tersimpan')</script>";
	echo "<script>location='program.php?id_unit=$id_unit'</script>";
}
?>
<?php include 'footer.php'; ?>