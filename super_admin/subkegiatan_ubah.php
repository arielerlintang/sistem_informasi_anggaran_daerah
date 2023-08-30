<?php include 'header.php'; ?>
<?php 
$id_subkegiatan = $_GET['id_subkegiatan'];
$ambil_k = $koneksi->query("SELECT * FROM subkegiatan WHERE id_subkegiatan='$id_subkegiatan'");
$detail_k = $ambil_k->fetch_assoc();

$program = array();
$ambil = $koneksi->query("SELECT * FROM program");
while($detail = $ambil->fetch_assoc())
{
	$program[] = $detail;
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<h6>Kegiatan Ubah</h6>
			<form method="post" enctype="multipart/form-data">
				<select name="id_program" class="form-control">
					<option value="" class="text-muted">pilih program</option>
					<?php foreach ($program as $key => $value): ?>
						<option value="<?php echo $value['id_program'] ?>" <?php if ($value['id_program']==$detail_k['id_program']) {
							echo "selected";
						} ?>><?php echo $value['nama_program']; ?></option>
					<?php endforeach ?>
				</select>

				<div class="mb-3">
					<label class="form-label">Kode</label>
					<input type="text" name="kode_subkegiatan" class="form-control" value="<?php echo $detail_k['kode_subkegiatan']; ?>">
				</div>
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama_subkegiatan" class="form-control" value="<?php echo $detail_k['nama_subkegiatan']; ?>">
				</div>
				<div class="mb-3">
					<button class="btn btn-primary" name="ubah">Ubah</button>
				</div>
			</form>
			
			<div class="text-end py-2">
				<a href="subkegiatan.php" class="btn btn-outline-primary">Kembali</a>
			</div>	
		</div>
	</div>
</div>
<?php 

if (isset($_POST['ubah'])) {

	$id_program = $_POST['id_program'];
	$kode_subkegiatan = $_POST['kode_subkegiatan'];
	$nama_subkegiatan = $_POST['nama_subkegiatan'];

	$koneksi->query("UPDATE subkegiatan SET id_program='$id_program',
		kode_subkegiatan='$kode_subkegiatan',
		nama_subkegiatan='$nama_subkegiatan' WHERE id_subkegiatan='$id_subkegiatan'");

	echo "<script>alert('Data Tersimpan')</script>";
	echo "<script>location='subkegiatan.php'</script>";
}
?>
<?php include 'footer.php'; ?>