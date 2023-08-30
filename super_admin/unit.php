<?php include 'header.php' ?>
<?php 
$unit = array();
$ambil = $koneksi->query("SELECT * FROM unit");
while($detail = $ambil->fetch_assoc())
{
	$unit[] = $detail;
}
?>
<div class="row">
    <div class="col-md-12 shadow rounded bg-white p-5 my-5">
      <h6>Data Unit</h6>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="tables">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($unit as $key => $value): ?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $value['nama_unit']; ?></td>
								<td>
									<a href="program.php?id_unit=<?php echo $value['id_unit'] ?>" class="btn btn-info btn-sm"><i class="bi bi-plus-circle"></i> Tambah Program</a>
									<a href="unit_ubah.php?id_unit=<?php echo $value['id_unit'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
									<a href="unit_hapus.php?id_unit=<?php echo $value['id_unit'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<a href="unit_tambah.php" class="btn btn-primary">Tambah</a>
			</div>
		</div>
	</div>
<?php include 'footer.php' ?>