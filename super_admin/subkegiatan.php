<?php include 'header.php' ?>
<?php 
$subkegiatan = array();
$ambil = $koneksi->query("SELECT * FROM subkegiatan LEFT JOIN program ON program.id_program = subkegiatan.id_program LEFT JOIN unit ON unit.id_unit = program.id_unit");
while($detail = $ambil->fetch_assoc())
{
	$subkegiatan[] = $detail;
}

?>

<div class="container">
	<div class="row">
		<div class="col-md-12 shadow rounded bg-white p-5 my-5">
			<h6>Data Kegiatan</h6>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="tables">
					<thead>
						<tr>
							<th>No</th>
							<th>Unit</th>
							<th>Program</th>
							<th>Kode</th>
							<th>Nama</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($subkegiatan as $key => $value): ?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $value['nama_unit']; ?></td>
								<td><?php echo $value['nama_program']; ?></td>
								<td><?php echo $value['kode_subkegiatan']; ?></td>
								<td><?php echo $value['nama_subkegiatan']; ?></td>
								<td nowrap="nowrap">
									<a href="kegiatan.php?id_subkegiatan=<?php echo $value['id_subkegiatan'] ?>" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah SubKegiatan</a>
									<a href="subkegiatan_ubah.php?id_subkegiatan=<?php echo $value['id_subkegiatan'] ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
									<a href="subkegiatan_hapus.php?id_subkegiatan=<?php echo $value['id_subkegiatan'] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<a href="subkegiatan_tambah.php" class="btn btn-primary">Tambah</a>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>