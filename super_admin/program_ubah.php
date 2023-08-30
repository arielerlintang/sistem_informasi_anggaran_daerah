<?php include 'header.php'; ?>
<?php 

$id_program = $_GET['id_program'];
$id_unit = $_GET['id_unit'];

$ambil_p = $koneksi->query("SELECT * FROM program WHERE id_program='$id_program'");

$detail_p = $ambil_p->fetch_assoc();


$unit = array();
$ambil = $koneksi->query("SELECT * FROM unit");
while($detail = $ambil->fetch_assoc())
{
	$unit[] = $detail;
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 shadow rounded bg-white p-5 my-5">
			<h6>Ubah Program</h6>
			<form method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">kode</label>
					<input type="text" name="kode_program" class="form-control" value="<?php echo $detail_p['kode_program'] ?>">
				</div>
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" name="nama_program" class="form-control" value="<?php echo $detail_p['nama_program'] ?>">
				</div>
				<div class="mb-3">
					<button class="btn btn-primary" name="ubah">Ubah</button>
				</div>
			</form>
			
			<div class="text-end py-2">
				<a href="program.php?id_unit=<?php echo $id_unit; ?>" class="btn btn-outline-primary">Kembali</a>
			</div>	
		</div>
	</div>
</div>
<?php 
if (isset($_POST['ubah'])) {
	$id_unit = $_GET['id_unit'];
	$kode_program = $_POST['kode_program'];
	$nama_program = $_POST['nama_program'];

	$koneksi->query("UPDATE program SET id_unit='$id_unit',
		kode_program='$kode_program',
		nama_program='$nama_program' WHERE id_program='$id_program'");

	echo "<script>alert('Data Terubah')</script>";
	echo "<script>location='program.php?id_unit=$id_unit'</script>";
}
?>
<?php include 'footer.php'; ?>