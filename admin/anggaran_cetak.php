<?php include 'header.php' ?>

<?php 
$unit = array();
$ambil = $koneksi->query("SELECT * FROM unit");
while($detail = $ambil->fetch_assoc())
{
	$unit[] = $detail;
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12 shadow rounded bg-white p-5 my-5">
			<h6>Data Anggaran Unit</h6>
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
								<td nowrap="nowrap">
									<a href="anggaran_tampil.php?id_unit=<?php echo $value['id_unit']; ?>" class="btn btn-outline-primary"><i class="bi bi-eye"></i> Lihat Dan Cetak Anggaran</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<div class="text-end py-2">
					<a href="index.php" class="btn btn-primary text-end">Kembali</a>
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>