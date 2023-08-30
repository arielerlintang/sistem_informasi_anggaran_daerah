<?php include 'header.php' ?>
<?php

if (isset($_POST['filter'])) {

         $_SESSION['tanggal_mulai'] = $_POST['tanggal_mulai'];
         $_SESSION['tanggal_selesai'] = $_POST['tanggal_selesai'];

         echo "<script>location='laporan_sumber_dana.php'</script>";


     }

       // penetapan session dalam variabel

     if (isset($_SESSION['tanggal_mulai'])) {

         $tanggal_mulai = $_SESSION['tanggal_mulai'];
     }
     else
     {
        echo $tanggal_mulai = '';
    }

    if (isset($_SESSION['tanggal_selesai'])) {

     $tanggal_selesai = $_SESSION['tanggal_selesai'];
 }
 else
 {
    echo $tanggal_selesai = '';
}
?>
<div class="container">
  <div class="row">
    <div class="alert alert-dark container mt-5">
        <form method="post">
            <div class="row">
                <div class="col-md-3">

                    <input type="date" name="tanggal_mulai" class="form-control" value="<?php if (isset($tanggal_mulai)) {
                        echo $tanggal_mulai;
                    }else{
                        echo '';
                    } ?>">
                </div>
                <div class="col-md-3">
                    <input type="date" name="tanggal_selesai" class="form-control" value="<?php if (isset($tanggal_selesai)) {
                        echo $tanggal_selesai;
                    }else{
                        echo '';
                    } ?>">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" name="filter" type="submit">Filter</button>
                </div>
            </div>  
        </form>
<?php


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

         $tanggal_selesai_formatted = date('d-m-Y', strtotime($tanggal_selesai));

// Membagi string tanggal untuk mendapatkan nilai bulan
         $tanggal_selesai_parts = explode('-', $tanggal_selesai_formatted);
$tanggal_selesai_hari = (int)$tanggal_selesai_parts[0]; // Konversi menjadi angka hari
$tanggal_selesai_bulan = (int)$tanggal_selesai_parts[1]; // Konversi menjadi angka bulan
$tanggal_selesai_tahun = $tanggal_selesai_parts[2]; // Tahun tidak perlu diubah


$tanggal_mulai_formatted = date('d-m-Y', strtotime($tanggal_mulai));

// Membagi string tanggal untuk mendapatkan nilai bulan
$tanggal_mulai_parts = explode('-', $tanggal_mulai_formatted);
$tanggal_mulai_hari = (int)$tanggal_mulai_parts[0]; // Konversi menjadi angka hari
$tanggal_mulai_bulan = (int)$tanggal_mulai_parts[1]; // Konversi menjadi angka bulan
$tanggal_mulai_tahun = $tanggal_mulai_parts[2]; // Tahun tidak perlu diubah

// Cek apakah angka bulan ada dalam array bulans

// menghitung total dan sisa keseluruhan dari sumber dana 

  // Ambil data sumber dana
$result = $koneksi->query("SELECT id_sumber_dana, nama_sumber_dana FROM sumber_dana");

$sumberDana = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sumberDana[$row["id_sumber_dana"]] = $row["nama_sumber_dana"];
    }
}

        // Inisialisasi array untuk total dan sisa anggaran
$totalAnggaran = array();
$sisaAnggaran = array();

foreach ($sumberDana as $id => $nama) {
    $totalAnggaran[$id] = 0;
    $sisaAnggaran[$id] = 0;
}

        // Ambil data anggaran_sumber
$sql = "SELECT * FROM anggaran_sumber 
LEFT JOIN anggaran_detail ON anggaran_detail.id_anggaran_detail = anggaran_sumber.id_anggaran_detail
LEFT JOIN kegiatan ON kegiatan.id_kegiatan = anggaran_detail.id_kegiatan
LEFT JOIN subkegiatan ON subkegiatan.id_subkegiatan = kegiatan.id_subkegiatan
LEFT JOIN program ON program.id_program = subkegiatan.id_program
LEFT JOIN unit ON unit.id_unit = program.id_unit
WHERE tanggal_anggaran BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $idSumberDana = $row["id_sumber_dana"];
        $totalAnggaran[$idSumberDana] += $row["total_patungan_sumber"];
        $sisaAnggaran[$idSumberDana] += $row["sisa_patungan_sumber"];
    }
}

?>
</div>
<div class="col-md-12 shadow rounded bg-white p-5 my-5">
    <h5 class="text-center">PEMERINTAH PROVINSI PAPUA</h5>
    <h4 class="text-center">LAPORAN PENGAWASAN  ANGGARAN DEFINITIF TOTAL PER SUMBER DANA</h4>

    <?php if (empty($tanggal_mulai_bulan)): ?>
       <p  class="text-center"><i>Per :     Sampai :     </i></p>
   <?php else: ?>
    <p  class="text-center"><i>Per : <?php if (array_key_exists($tanggal_mulai_bulan, $bulans)) {
    // Jika ada, tampilkan tanggal lengkap dalam bahasa Indonesia
      echo $tanggal_mulai_hari . " " . $bulans[$tanggal_mulai_bulan] . " " . $tanggal_mulai_tahun;
  }        ?>    Sampai :     <?php if (array_key_exists($tanggal_selesai_bulan, $bulans)) {
    // Jika ada, tampilkan tanggal lengkap dalam bahasa Indonesia
      echo $tanggal_selesai_hari . " " . $bulans[$tanggal_selesai_bulan] . " " . $tanggal_selesai_tahun;
  }        ?></i></p>
<?php endif ?>    
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Sumber Dana</th>
            <th>Total</th>
            <th>Sisa</th>
        </tr>
    </thead>
    <tbody>
       <?php if (empty($sumberDana)): ?>

       <?php else: ?>
        <?php foreach($sumberDana as $id => $nama): ?>
            <tr>
                <td><?php echo $nama ?></td>
                <td><?php echo number_format($totalAnggaran[$id]) ?></td>
                <td><?php echo number_format($sisaAnggaran[$id]) ?></td>
            </tr>
        <?php endforeach?>
    <?php endif ?>

</tbody>
</table>




<div class="text-end py-2">
    <a href="anggaran_cetak.php" class="btn btn-primary text-end">Kembali</a>
</div>
</div>
</div>
</div>

<a href="cetak_sumber_dana.php?tanggal_mulai=<?php echo $tanggal_mulai; ?>&tanggal_selesai=<?php echo $tanggal_selesai; ?>" class="btn btn-primary mb-3" target="_blank">Cetak Laporan <i class="bi bi-printer"></i></a>
</div>

<?php include 'footer.php' ?>