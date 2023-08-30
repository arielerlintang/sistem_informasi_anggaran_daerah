<?php include 'header.php' ?>
<?php 
$admin = array();
$ambil = $koneksi->query("SELECT * FROM admin");
while($detail = $ambil->fetch_assoc())
{
	$admin[] = $detail;
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-12 shadow rounded bg-white p-5 my-5">
      <h6>Data admin</h6>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="tables">
					<thead>
						<tr>
							<th>No</th>
							<th>Username</th>
							<th>Nama</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($admin as $key => $value): ?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $value['username_admin']; ?></td>
								<td><?php echo $value['nama_admin']; ?></td>
								<td>
									<a href="admin_ubah.php?id_admin=<?php echo $value['id_admin'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
									<a href="admin_hapus.php?id_admin=<?php echo $value['id_admin'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<a href="admin_tambah.php" class="btn btn-primary">Tambah</a>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>