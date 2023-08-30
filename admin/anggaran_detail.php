<?php include 'header.php'; ?>
<?php 
$id_unit = $_GET['id_unit'];
$ambil_unit = $koneksi->query("SELECT * FROM unit WHERE id_unit='$id_unit'");
$detail_unit = $ambil_unit->fetch_assoc();
$program = array();
$ambil_program = $koneksi->query("SELECT * FROM program WHERE id_unit='$id_unit'");
while($detail_program = $ambil_program->fetch_assoc())
{
	$program[] =  $detail_program;
}

?>
<div class="container">
	<div class="row">

		<div class="col-md-12 shadow rounded bg-white p-5 my-5">
			<h6>Data Program Unit <strong><?php echo $detail_unit['nama_unit']; ?></strong></h6>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="tables">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Program</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($program as $key => $value): ?>

							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $value['nama_program']; ?></td>
								<td nowrap="nowrap">
									<a href="anggaran_input.php?id_program=<?php echo $value['id_program']; ?>" class="btn btn-primary btn-sm">Input Anggaran</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<div class="text-end py-2">

					<a href="anggaran.php" class="btn btn-primary text-end">Kembali</a>
				</div>
			</div>
		</div>
	</div>
</div>


<?php include 'footer.php'; ?>