<?php include 'header.php' ?>
<?php 
$id_subkegiatan = $_GET['id_subkegiatan'];
// menampilkan data kegiatan berdasarkan id_subkegiatnnya apa 
$kegiatan = array();
$ambil = $koneksi->query("SELECT * FROM kegiatan WHERE id_subkegiatan='$id_subkegiatan'");
while($detail = $ambil->fetch_assoc())
{
	$kegiatan[] = $detail;
}
 ?>
 <div class="container">
	<div class="row">
		<div class="col-md-12 shadow rounded bg-white p-5 my-5">
			<h6>Data SubKegiatan</h6>
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
						<?php foreach ($kegiatan as $key => $value): ?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $value['kode_kegiatan']; ?></td>
								<td><?php echo $value['nama_kegiatan']; ?></td>

								<td nowrap="nowrap">

									<a href="kegiatan_ubah.php?id_kegiatan=<?php echo $value['id_kegiatan'] ?>&id_subkegiatan=<?php echo $id_subkegiatan; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>

									<a href="kegiatan_hapus.php?id_kegiatan=<?php echo $value['id_kegiatan'] ?>&id_subkegiatan=<?php echo $id_subkegiatan; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>

								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<a href="kegiatan_tambah.php?id_subkegiatan=<?php echo $id_subkegiatan; ?>" class="btn btn-primary">Tambah</a>
			</div>
			
			<div class="text-end py-2">
				<a href="subkegiatan.php" class="btn btn-outline-primary">Kembali</a>
			</div>	
		</div>
	</div>
</div>
<?php include 'footer.php' ?>