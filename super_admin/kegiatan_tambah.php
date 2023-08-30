<?php include 'header.php'; ?>
<?php 
$id_subkegiatan = $_GET['id_subkegiatan'];
?>
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<h6>SubKegiatan Tambah</h6>
			<form method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">Kode</label>
					<input type="text" name="kode_kegiatan" class="form-control">
				</div>
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama_kegiatan" class="form-control">
				</div>
				<div class="mb-3">
					<button class="btn btn-primary" name="simpan">Simpan</button>
				</div>
			</form>

			<div class="text-end py-2">
				<a href="kegiatan.php?id_subkegiatan=<?php echo $id_subkegiatan; ?>" class="btn btn-outline-primary">Kembali</a>
			</div>	
		</div>
	</div>
</div>
<?php 

if (isset($_POST['simpan'])) {

	
	$kode = $_POST['kode_kegiatan'];
	$nama_kegiatan = $_POST['nama_kegiatan'];

	$koneksi->query("INSERT INTO kegiatan (id_subkegiatan,kode_kegiatan,nama_kegiatan) VALUES ('$id_subkegiatan','$kode','$nama_kegiatan')");

	echo "<script>alert('Data Tersimpan')</script>";
	echo "<script>location='kegiatan.php?id_subkegiatan=$id_subkegiatan'</script>";
}
?>
<?php include 'footer.php'; ?>