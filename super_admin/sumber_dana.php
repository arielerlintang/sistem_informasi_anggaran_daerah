<?php 
include 'header.php';
$sumber_dana = array();
$ambil = $koneksi->query("SELECT * FROM sumber_dana");
while($detail = $ambil->fetch_assoc())
{
	$sumber_dana[] = $detail; 
}

 ?>
<div class="container">
	<div class="row">
		<div class="col-md-12 shadow rounded bg-white p-5 my-5">
			<h6>Data Sumber Dana</h6>
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="tables">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($sumber_dana as $key => $value): ?>
							
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo $value['nama_sumber_dana']; ?></td>
							<td nowrap="nowrap">
									<a href="sumber_dana_ubah.php?id_sumber_dana=<?php echo $value['id_sumber_dana'] ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
									<a href="sumber_dana_hapus.php?id_sumber_dana=<?php echo $value['id_sumber_dana'] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<a href="sumber_dana_tambah.php" class="btn btn-primary">Tambah</a>
			</div>
		</div>
	</div>
</div>
<?php 

include 'footer.php';
 ?>