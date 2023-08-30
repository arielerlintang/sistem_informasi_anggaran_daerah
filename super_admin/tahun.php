<?php include 'header.php' ?>
<?php 
$tahun = array();
$ambil = $koneksi->query("SELECT * FROM tahun");
while($detail = $ambil->fetch_assoc())
{
	$tahun[] = $detail;
}

?>

<div class="container">
	<div class="row">
		<div class="col-md-12 shadow rounded bg-white p-5 my-5">
			<h6>Data Tahun</h6>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="tables">
					<thead>
						<tr>
							<th>No</th>
							<th>Tahun</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($tahun as $key => $value): ?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $value['nama_tahun']; ?></td>
								<td nowrap="nowrap">
									<a href="tahun_ubah.php?id_tahun=<?php echo $value['id_tahun'] ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
									<a href="tahun_hapus.php?id_tahun=<?php echo $value['id_tahun'] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<a href="tahun_tambah.php" class="btn btn-primary">Tambah</a>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>