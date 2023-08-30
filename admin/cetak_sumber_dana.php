<?php 
include '../koneksi.php';

$tanggal_mulai = $_GET['tanggal_mulai'];
$tanggal_selesai = $_GET['tanggal_selesai'];


$ambil_sumber_dana = $koneksi->query("SELECT id_sumber_dana, nama_sumber_dana FROM sumber_dana");

// Inisialisasi array untuk menyimpan data sumber dana
$data_sumber_dana = array();
while ($detail_sumber_dana = $ambil_sumber_dana->fetch_assoc()) {
  $data_sumber_dana[$detail_sumber_dana['id_sumber_dana']] = array(
    'nama' => $detail_sumber_dana['nama_sumber_dana'],
    'total_anggaran' => 0,
    'sisa_anggaran' => 0
  );
}

  // Ambil data sumber dana
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>NAMA APLIKASI - CETAK DATA ANGGARAN</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://siminfra.bappeda.grobogan.go.id/assets_administrator/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <link rel="stylesheet" href="https://siminfra.bappeda.grobogan.go.id/assets_administrator/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <link rel="stylesheet" href="https://siminfra.bappeda.grobogan.go.id/assets_administrator/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="https://siminfra.bappeda.grobogan.go.id/assets_administrator/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="https://siminfra.bappeda.grobogan.go.id/assets_administrator/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://siminfra.bappeda.grobogan.go.id/assets_administrator/dist/css/mystyle.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    /*table
    {
      margin-left: auto;
      margin-right: auto;
    }*/
    .table td, .table th {

      padding: 5px !important;
    }
    tr{
      padding: 5px !important;
      margin: 5px;
    }
    .tbody td{
      text-align: center;
    }
  </style>
  <style type="text/css" media="print">
    @page { 
      size: landscape;
    }
    
  </style>
</head>
<body>
  <page size="A4" layout="landscape">
    <div class="judul">
      <div class="row">
        <div class="col-md-10">
          <h5 class="text-center">PEMERINTAH PROVINSI PAPUA</h5>
          <h5  class="text-center">LAPORAN PENGAWASAN ANGGARAN DEFINITIF TOTAL PER SUMBER DANA</h5>
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



?>
<p  class="text-center"><i>Per : <?php if (array_key_exists($tanggal_mulai_bulan, $bulans)) {
    // Jika ada, tampilkan tanggal lengkap dalam bahasa Indonesia
  echo $tanggal_mulai_hari . " " . $bulans[$tanggal_mulai_bulan] . " " . $tanggal_mulai_tahun;
}        ?>    Sampai :     <?php if (array_key_exists($tanggal_selesai_bulan, $bulans)) {
    // Jika ada, tampilkan tanggal lengkap dalam bahasa Indonesia
  echo $tanggal_selesai_hari . " " . $bulans[$tanggal_selesai_bulan] . " " . $tanggal_selesai_tahun;
}        ?></i></p>
</div>
</div>    
</div>
<br> 
<div class="row">
  <div class="col-md-4">
  </div>
  <div class="col-md-8"></div>
</div>
<table border="1" width="100%">
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



<script>
  print();
</script>
</page>
</body>
</html>


