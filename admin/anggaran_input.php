<?php include 'header.php' ?>

<?php 
$id_program = $_GET['id_program'];
$program = $koneksi->query("SELECT * FROM program LEFT JOIN unit ON program.id_unit = unit.id_unit")->fetch_assoc();
?>
<script>
	document.addEventListener("DOMContentLoaded", function() {
    // Mengambil referensi ke checkbox
		const checkboxes = document.querySelectorAll('input[type="checkbox"][name="id_sumber_dana[]"]');

    // Mengambil referensi ke div dengan class "col-md-6"
		const divsToToggle = document.querySelectorAll('.col-md-8');

    // Membuat fungsi untuk mengubah tampilan div berdasarkan status checkbox
		function toggleDivs() {
			divsToToggle.forEach(function(div, index) {
				div.style.display = checkboxes[index].checked ? 'block' : 'none';
			});
		}

    // Memanggil fungsi toggleDivs saat halaman dimuat dan saat checkbox diubah
		toggleDivs();
		checkboxes.forEach(function(checkbox) {
			checkbox.addEventListener('change', toggleDivs);
		});
	});
</script>

<div class="container">
	<?php 
	if (isset($_POST['filter'])) {
		$_SESSION['id_bulan'] = $_POST['id_bulan'];
		$_SESSION['id_tahun'] = $_POST['id_tahun'];

		echo "<script>location='anggaran_input.php?id_program=$id_program'</script>";

	}
	if (isset($_SESSION['id_bulan'])) {
		
		$id_bulan_terpilih = $_SESSION['id_bulan'];


	}else{
		$id_bulan_terpilih = '';
	}

	if (isset($_SESSION['id_tahun'])) {
		
		$id_tahun_terpilih = $_SESSION['id_tahun'];



	}else{
		$id_tahun_terpilih = '';
	}

	if (empty($id_tahun_terpilih)) {
		
		$jng_thn = '';

	}else{
		$jpk = $koneksi->query("SELECT * FROM tahun WHERE id_tahun='$id_tahun_terpilih'")->fetch_assoc();
	$jng_thn = $jpk['nama_tahun'];
	}
	$bulans = array(
		1 => "Januari",
		2 => "Februari",
		3 => "Maret",
		4 => "April",
		5 => "Mei",
		6 => "Juni",
		7 => "Juli",
		8 => "Agustus",
		9 => "September",
		10 => "Oktober",
		11 => "November",
		12 => "Desember"
	);

	// menampilkan nama tahun berdasarkan id_tahun dari sesson 

	
	$kegiatan = array();
		$as = $koneksi->query("SELECT * FROM kegiatan 
			LEFT JOIN subkegiatan ON kegiatan.id_subkegiatan = subkegiatan.id_subkegiatan 
			WHERE id_program = '$id_program' AND kegiatan.id_kegiatan NOT IN (
				SELECT anggaran_detail.id_kegiatan 
				FROM anggaran_detail 
				LEFT JOIN kegiatan ON anggaran_detail.id_kegiatan = kegiatan.id_kegiatan 
				LEFT JOIN subkegiatan ON kegiatan.id_subkegiatan = subkegiatan.id_subkegiatan 
				WHERE id_program = '$id_program'
				AND MONTH(anggaran_detail.tanggal_anggaran) = '$id_bulan_terpilih'
				AND YEAR(anggaran_detail.tanggal_anggaran) = '$jng_thn'
			)");
		while($ds = $as->fetch_assoc()) {
			$kegiatan[] = $ds;
		}


$bulan = array();
			$ambil_b = $koneksi->query("SELECT * FROM bulan");
			while($detail_b = $ambil_b->fetch_assoc())
			{
				$bulan[] = $detail_b;
			}


	?>
	<form method="post">
		<div class="row alert alert-dark mt-5">

			<div class="col-md-3 col-3">
				<select class="form-control" name="id_bulan" required>
					<option value="" class="text-muted">set bulan</option>
					<?php foreach ($bulan as $key => $value): ?>
						
					<option value="<?php echo $value['id_bulan'] ?>"  <?php if ($id_bulan_terpilih==$value['id_bulan']) {
						echo "selected";
					} ?>><?php echo $value['nama_bulan'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<?php 
			$tahun = array();
			$ambil = $koneksi->query("SELECT * FROM tahun");
			while($detail = $ambil->fetch_assoc())
			{
				$tahun[] = $detail;
			}

			?>
			<div class="col-md-3 col-3">
				<select class="form-control" name="id_tahun">
					<option value="">set tahun</option>
					<?php foreach ($tahun as $key => $value): ?>
						<option value="<?php echo $value['id_tahun']; ?>"  <?php if ($id_tahun_terpilih==$value['id_tahun']) {
						echo "selected";
					} ?>>
							<?php echo $value['nama_tahun']; ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="col-md-3 col-3">
				<button class="btn btn-primary" name="filter">Filter</button>
			</div>
		</div>
	</form>

	<div class="row">


	</div>
	<div class="col-md-12 bg-white shadow rounded p-3 my-3">
		<div class="p-3">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>UNIT : <?php echo strtoupper($program['nama_unit']); ?></th>
						<th>PROGRAM : <?php echo strtoupper($program['nama_program']); ?></th>
					</tr>
					<tr></tr>
				</thead>
			</table>
			<hr>

			<form method="post">
				<div class="mb-3">
					<label class="fw-bold">Pilih Kegiatan</label>
					<select class="form-control" name="id_kegiatan" required>
						<option value="">Pilih</option>
						<?php foreach ($kegiatan as $key => $value): ?>
							<option value="<?php echo $value['id_kegiatan'] ?>">
								<?php echo $value['nama_subkegiatan'] ?> - 
								<?php echo $value['nama_kegiatan'] ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<?php 
				$sumber_dana = array();
				$ambil = $koneksi->query("SELECT * FROM sumber_dana");
				while($detail = $ambil->fetch_assoc())
				{
					$sumber_dana[] = $detail; 
				}

				?>
				<div class="mb-3 bg-light p-3">
					<!-- <h6>Sumber Dana</h6> -->
					<!-- <p>Sertakan Berapa Angaran yang dipakai Untuk Tiap Tiap Sumber Dana dalam satu Kegiatan</p> -->
					<?php foreach ($sumber_dana as $key => $value): ?>
						<div class="row border-bottom border-1">
							<div class="col-md-4">
								<input type="checkbox" name="id_sumber_dana[]" value="<?php echo $value['id_sumber_dana'] ?>">
								<label class="fw-bold"><?php echo $value['nama_sumber_dana']; ?></label>
							</div>
							<div class="col-md-8">

								<input type="hidden" name="nominal_patungan_sumber[<?php echo $value['id_sumber_dana'] ?>]" value="">

								<input type="number" name="nominal_patungan_sumber[<?php echo $value['id_sumber_dana'] ?>]" class="form-control w-100">

								<div>
									<div class="mb-3">
										<div class="row mb-3">
											<div class="col-md-4">
												<label>Pegawai</label>
												<input type="hidden" name="pegawai_patungan_sumber[<?php echo $value['id_sumber_dana'] ?>]">
												<input type="number" name="pegawai_patungan_sumber[<?php echo $value['id_sumber_dana'] ?>]" class="form-control">
											</div>
											<div class="col-md-4">
												<label>Barang Dan Jasa</label>
												<input type="hidden" name="barangjasa_patungan_sumber[<?php echo $value['id_sumber_dana'] ?>]">
												<input type="number" name="barangjasa_patungan_sumber[<?php echo $value['id_sumber_dana'] ?>]" class="form-control">
											</div>
											<div class="col-md-4">
												<label>Modal</label>
												<input type="hidden" name="modal_patungan_sumber[<?php echo $value['id_sumber_dana'] ?>]">
												<input type="number" name="modal_patungan_sumber[<?php echo $value['id_sumber_dana'] ?>]" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>
					<?php endforeach ?>
				</div>
				<div class="mb-3">
					<label class="fw-bold">Tanggal</label>
					<input type="date" name="tanggal_anggaran" class="form-control" required>
				</div>
				<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
			</form>
		</div>
	</div>
	<div class="text-end py-2">

		<a href="anggaran_detail.php?id_unit=<?php echo $program['id_unit'] ?>" class="btn btn-primary text-end">Kembali</a>
	</div>

</div>
</div> 
<?php
if (isset($_POST['simpan'])) {
	

    // Simpan data ke tabel anggaran_detail
	$id_kegiatan = $_POST['id_kegiatan'];
	$tanggal_anggaran = $_POST['tanggal_anggaran'];
	$nominal_anggaran = 0;
	$pegawai_anggaran = 0;
	$barangjasa_anggaran = 0;
	$modal_anggaran = 0;

	$id_admin = $_SESSION['admin']["id_admin"];

	foreach ($_POST['id_sumber_dana'] as $id_sumber_dana) {
		$nominal_patungan_sumber = $_POST['nominal_patungan_sumber'][$id_sumber_dana];
		$pegawai_patungan_sumber = isset($_POST['pegawai_patungan_sumber'][$id_sumber_dana]) ? $_POST['pegawai_patungan_sumber'][$id_sumber_dana] : 0;
		$barangjasa_patungan_sumber = isset($_POST['barangjasa_patungan_sumber'][$id_sumber_dana]) ? $_POST['barangjasa_patungan_sumber'][$id_sumber_dana] : 0;
		$modal_patungan_sumber = isset($_POST['modal_patungan_sumber'][$id_sumber_dana]) ? $_POST['modal_patungan_sumber'][$id_sumber_dana] : 0;

		$nominal_anggaran += $nominal_patungan_sumber;
		$pegawai_anggaran += $pegawai_patungan_sumber;
		$barangjasa_anggaran += $barangjasa_patungan_sumber;
		$modal_anggaran += $modal_patungan_sumber;
	}

    // Simpan data ke tabel anggaran_detail
	$total_anggaran = $pegawai_anggaran + $barangjasa_anggaran + $modal_anggaran;
	$persen_anggaran = ($total_anggaran / $nominal_anggaran) * 100;
	$sisa_anggaran = $nominal_anggaran - $total_anggaran;

	$query = "INSERT INTO anggaran_detail (id_kegiatan, id_admin, tanggal_anggaran, nominal_anggaran, pegawai_anggaran, barangjasa_anggaran, modal_anggaran, total_anggaran, persen_anggaran, sisa_anggaran)
	VALUES ('$id_kegiatan', '$id_admin', '$tanggal_anggaran', '$nominal_anggaran', '$pegawai_anggaran', '$barangjasa_anggaran', '$modal_anggaran', '$total_anggaran', '$persen_anggaran', '$sisa_anggaran')";
	$koneksi->query($query);

    // Dapatkan id_anggaran_detail yang baru saja disimpan
	$id_anggaran_detail = $koneksi->insert_id;

	foreach ($_POST['id_sumber_dana'] as $id_sumber_dana) {
		$nominal_patungan_sumber = $_POST['nominal_patungan_sumber'][$id_sumber_dana];
		$pegawai_patungan_sumber = isset($_POST['pegawai_patungan_sumber'][$id_sumber_dana]) ? intval($_POST['pegawai_patungan_sumber'][$id_sumber_dana]) : 0;
		$barangjasa_patungan_sumber = isset($_POST['barangjasa_patungan_sumber'][$id_sumber_dana]) ? intval($_POST['barangjasa_patungan_sumber'][$id_sumber_dana]) : 0;
		$modal_patungan_sumber = isset($_POST['modal_patungan_sumber'][$id_sumber_dana]) ? intval($_POST['modal_patungan_sumber'][$id_sumber_dana]) : 0;

        // Konversi nilai menjadi integer jika diperlukan
		$nominal_patungan_sumber = intval($nominal_patungan_sumber);
		$pegawai_patungan_sumber = intval($pegawai_patungan_sumber);
		$barangjasa_patungan_sumber = intval($barangjasa_patungan_sumber);
		$modal_patungan_sumber = intval($modal_patungan_sumber);

        // Perhitungan hanya dilakukan jika nilai nominal_patungan_sumber lebih besar dari nol
		if ($nominal_patungan_sumber > 0) {
			$total_patungan_sumber = $pegawai_patungan_sumber + $barangjasa_patungan_sumber + $modal_patungan_sumber;
			$persen_patungan_sumber = ($total_patungan_sumber / $nominal_patungan_sumber) * 100;
			$sisa_patungan_sumber = $nominal_patungan_sumber - $total_patungan_sumber;
		} else {
            // Jika nominal_patungan_sumber adalah nol atau negatif, semua perhitungan diatur ke nol
			$total_patungan_sumber = 0;
			$persen_patungan_sumber = 0;
			$sisa_patungan_sumber = 0;
		}

		$query = "INSERT INTO anggaran_sumber (id_anggaran_detail, id_sumber_dana, nominal_patungan_sumber, pegawai_patungan_sumber, barangjasa_patungan_sumber, modal_patungan_sumber, total_patungan_sumber, persen_patungan_sumber, sisa_patungan_sumber)
		VALUES ('$id_anggaran_detail', '$id_sumber_dana', '$nominal_patungan_sumber', '$pegawai_patungan_sumber', '$barangjasa_patungan_sumber', '$modal_patungan_sumber', '$total_patungan_sumber', '$persen_patungan_sumber', '$sisa_patungan_sumber')";
		$koneksi->query($query);
	}

	echo "<script>alert('Data Tersimpan')</script>";
	echo "<script>location='anggaran_input.php?id_program=$id_program'</script>";
}
?>
<?php include 'footer.php' ?>