<?php include 'header.php'; ?>
<?php 
$id_sumber_dana = $_GET['id_sumber_dana'];
$ambil_k = $koneksi->query("SELECT * FROM sumber_dana WHERE id_sumber_dana='$id_sumber_dana'");
$detail_k = $ambil_k->fetch_assoc();

 ?>
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<h6>Sumber Dana Tambah</h6>
			<form method="post" enctype="multipart/form-data">
				

				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama_sumber_dana" class="form-control" value="<?php echo $detail_k['nama_sumber_dana'] ?>">
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

	$nama = $_POST['nama_sumber_dana'];
	
	$koneksi->query("UPDATE sumber_dana SET nama_sumber_dana='$nama' WHERE id_sumber_dana='$id_sumber_dana'");

	echo "<script>alert('Data Terubah')</script>";
	echo "<script>location='sumber_dana.php'</script>";
}
?>
<?php include 'footer.php'; ?>