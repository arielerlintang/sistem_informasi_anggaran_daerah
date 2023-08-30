<?php include 'header.php' ?>
<?php 
$id_unit = $_GET['id_unit'];
$ambil_unit = $koneksi->query("SELECT * FROM unit WHERE id_unit='$id_unit'");
$detail_unit = $ambil_unit->fetch_assoc();
$program = array();
$ambil = $koneksi->query("SELECT * FROM program WHERE id_unit='$id_unit'");
while($detail = $ambil->fetch_assoc())
{
	$program[] = $detail;
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12 shadow rounded bg-white p-5 my-5">
			<h6>Data Program  Unit : <strong><?php echo $detail_unit['nama_unit'] ?></strong></h6>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="tables">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Nama</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($program as $key => $value): ?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $value['kode_program']; ?></td>
								<td><?php echo $value['nama_program']; ?></td>
								<td>
									<a href="program_ubah.php?id_program=<?php echo $value['id_program'] ?>&id_unit=<?php echo $id_unit; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
									<a href="program_hapus.php?id_program=<?php echo $value['id_program'] ?>&id_unit=<?php echo $id_unit; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<a href="program_tambah.php?id_unit=<?php echo $id_unit; ?>" class="btn btn-primary">Tambah</a>
				
			<div class="text-end py-2">
				<a href="unit.php" class="btn btn-outline-primary">Kembali</a>
			</div>	
			</div>
		</div>

	</div>
</div>
<?php include 'footer.php' ?>