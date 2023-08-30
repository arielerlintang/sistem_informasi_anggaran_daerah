<?php include 'header.php' ?>
<?php 
$bulan = array();
$ambil = $koneksi->query("SELECT * FROM bulan");
while($detail = $ambil->fetch_assoc())
{
	$bulan[] = $detail;
}

?>

<div class="container">
	<div class="row">
		<div class="col-md-12 shadow rounded bg-white p-5 my-5">
			<h6>Data bulan</h6>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="tables">
					<thead>
						<tr>
							<th>No</th>
							<th>bulan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($bulan as $key => $value): ?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $value['nama_bulan']; ?></td>
								<td nowrap="nowrap">
									<a href="bulan_ubah.php?id_bulan=<?php echo $value['id_bulan'] ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
									<a href="bulan_hapus.php?id_bulan=<?php echo $value['id_bulan'] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<a href="bulan_tambah.php" class="btn btn-primary">Tambah</a>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>