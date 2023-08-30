<?php 
include '../koneksi.php';
$id_unit = $_GET['id_unit'];
$tanggal_mulai = $_GET['tanggal_mulai'];
$tanggal_selesai = $_GET['tanggal_selesai'];

$out = array();

$as = $koneksi->query("SELECT * FROM program WHERE id_unit='$id_unit'");
while ($dp = $as->fetch_assoc()) {
  $id_program = $dp['id_program'];
  $dp['subkegiatan'] = array();

  $total_nominal_program = 0;
  $total_pegawai_program = 0;
  $total_barangjasa_program = 0;
  $total_modal_program = 0;
  $total_total_program = 0;
  $total_sisa_program = 0;

  $bs = $koneksi->query("SELECT * FROM subkegiatan WHERE id_program='$id_program'");
  while ($ds = $bs->fetch_assoc()) {
    $id_subkegiatan = $ds['id_subkegiatan'];
    $ds['anggaran'] = array();

    $cs = $koneksi->query("SELECT * FROM anggaran_detail 
      LEFT JOIN kegiatan ON anggaran_detail.id_kegiatan = kegiatan.id_kegiatan 
      WHERE id_subkegiatan='$id_subkegiatan' AND tanggal_anggaran BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'");

        $detail_anggaran_count = $cs->num_rows;  // Hitung jumlah data anggaran_detail

        if ($detail_anggaran_count > 0) {  // Tampilkan data subkegiatan hanya jika ada data anggaran_detail terkait
          while ($detail_anggaran = $cs->fetch_assoc()) {
            $id_anggaran_detail = $detail_anggaran['id_anggaran_detail'];
            $detail_anggaran['anggaran_sumber'] = array();

            $sumber_query = $koneksi->query("SELECT * FROM anggaran_sumber
              LEFT JOIN sumber_dana ON sumber_dana.id_sumber_dana = anggaran_sumber.id_sumber_dana
              WHERE id_anggaran_detail='$id_anggaran_detail'");

            while ($anggaran_sumber = $sumber_query->fetch_assoc()) {
              $detail_anggaran['anggaran_sumber'][] = $anggaran_sumber;
            }

            $ds['anggaran'][] = $detail_anggaran;

            $total_nominal_program += $detail_anggaran['nominal_anggaran'];
            $total_pegawai_program += $detail_anggaran['pegawai_anggaran'];
            $total_barangjasa_program += $detail_anggaran['barangjasa_anggaran'];
            $total_modal_program += $detail_anggaran['modal_anggaran'];
            $total_total_program += $detail_anggaran['total_anggaran'];
            $total_sisa_program += $detail_anggaran['sisa_anggaran'];
          }

          $dp['subkegiatan'][] = $ds;
        }
      }

      if ($total_nominal_program !== 0) {
        $dp['total_persen_program'] = ($total_total_program / $total_nominal_program) * 100;
      } else {
        $dp['total_persen_program'] = 0;
      }

    if (!empty($dp['subkegiatan'])) {  // Tampilkan data program hanya jika ada subkegiatan terkait
      $dp['total_nominal_program'] = $total_nominal_program;
      $dp['total_pegawai_program'] = $total_pegawai_program;
      $dp['total_barangjasa_program'] = $total_barangjasa_program;
      $dp['total_modal_program'] = $total_modal_program;
      $dp['total_total_program'] = $total_total_program;
      $dp['total_sisa_program'] = $total_sisa_program;

      $out[] = $dp;
    }

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
 WHERE tanggal_anggaran BETWEEN '$tanggal_mulai' AND '$tanggal_selesai' AND unit.id_unit='$id_unit'";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $idSumberDana = $row["id_sumber_dana"];
        $totalAnggaran[$idSumberDana] += $row["total_patungan_sumber"];
        $sisaAnggaran[$idSumberDana] += $row["sisa_patungan_sumber"];
    }
}

  }

  $unit = $koneksi->query("SELECT * FROM unit WHERE id_unit='$id_unit'")->fetch_assoc();

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
          <h5  class="text-center">LAPORAN PENGAWASAN ANGGARAN DEFINITIF PER SUB KEGIATAN</h5>
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
    <strong>Unit Organisasi</strong> : <?php echo $unit['nama_unit']; ?> <br>

  </div>
  <div class="col-md-8"></div>
</div>
<br>

<?php if (isset($out)): ?>
  <table border="1">


    <thead>
      <tr>
        <th rowspan="2" class="text-center">KODE</th>
        <th rowspan="2" class="text-center">URAIAN</th>
        <th rowspan="2" class="text-center">ANGGARAN</th>
        <th colspan="5" class="text-center">REALISASI</th>
        <th class="text-center">SISA</th>
        <th class="text-center" rowspan="2">SUMBER DANA</th>
      </tr>
      <tr>
        <th class="text-center">PEGAWAI</th>
        <th class="text-center">BARANG JASA</th>
        <th class="text-center">MODAL</th>
        <th class="text-center">TOTAL</th>
        <th class="text-center">%</th>
        <th class="text-center">ANGGARAN</th>
        

      </tr>
    </thead>
    <?php if (isset($out)): ?>
      <tbody>
        <?php $total_keseluruhan_nominal = 0; ?>
        <?php $total_keseluruhan_pegawai = 0; ?>
        <?php $total_keseluruhan_barangjasa = 0; ?>
        <?php $total_keseluruhan_modal = 0; ?>
        <?php $total_keseluruhan_total = 0; ?>
        <?php $total_keseluruhan_sisa = 0; ?>
        <?php foreach ($out as $k => $v): ?>
          <tr>
            <td class="fw-bold fs-5">
              <?php echo $v['kode_program']; ?>
            </td>
            <td class="fw-bold fs-5" colspan="9">
              <?php echo $v['nama_program']; ?>   
            </td>


          </tr>
          <?php foreach ($v['subkegiatan'] as $ks => $vs): ?>
            <tr>
              <td class="fw-bold">
                <?php echo $vs['kode_subkegiatan']; ?>
              </td>
              <td class="fw-bold" colspan="9">
                <?php echo $vs['nama_subkegiatan'] ?></td>
              </tr>
              <?php $total_nominal_anggaran = 0; ?>
              <?php $total_pegawai_anggaran = 0; ?>
              <?php $total_barangjasa_anggaran = 0; ?>
              <?php $total_modal_anggaran = 0; ?>
              <?php $total_total_anggaran = 0; ?>
              <?php $total_sisa_anggaran = 0; ?>
              <?php foreach ($vs['anggaran'] as $ka => $va): ?>
                <tr>
                  <td><?php echo $va['kode_kegiatan'] ?></td>
                  <td><?php echo $va['nama_kegiatan'] ?></td>
                  <td class="text-end"><?php echo number_format($va['nominal_anggaran']) ?></td>
                  <td class="text-end"><?php echo number_format($va['pegawai_anggaran']) ?></td>
                  <td class="text-end"><?php echo number_format($va['barangjasa_anggaran']) ?></td>
                  <td class="text-end"><?php echo number_format($va['modal_anggaran']) ?></td>
                  <td class="text-end"><?php echo number_format($va['total_anggaran']) ?></td>
                  <td class="text-end"><?php echo number_format($va['persen_anggaran']) ?></td>
                  <td class="text-end"><?php echo number_format($va['sisa_anggaran']) ?></td>

                  <td class="text-center">
                    <?php foreach ($va['anggaran_sumber'] as $ksd => $vsd): ?>

                      <?php echo $vsd['nama_sumber_dana'] ?>
                      <br>
                    <?php endforeach ?>
                  </td>    
                  
                  
                </tr>
                <?php $total_nominal_anggaran+=$va['nominal_anggaran']; ?>
                <?php $total_pegawai_anggaran+=$va['pegawai_anggaran']; ?>
                <?php $total_barangjasa_anggaran+=$va['barangjasa_anggaran']; ?>
                <?php $total_total_anggaran+=$va['total_anggaran']; ?>
                <?php $total_modal_anggaran+=$va['modal_anggaran']; ?>
                <?php $total_sisa_anggaran+=$va['sisa_anggaran']; ?>

                <?php   $total_nominal_program+=$va['nominal_anggaran']; ?>    
              <?php endforeach ?>
              <tr>
                <td></td>
                <td>TOTAL KEGIATAN <?php echo $vs['nama_subkegiatan'] ?></td>
                <td class="text-end"><?php echo number_format($total_nominal_anggaran) ?></td>
                <td class="text-end"><?php echo number_format($total_pegawai_anggaran) ?></td>
                <td class="text-end"><?php echo number_format($total_barangjasa_anggaran) ?></td>
                <td class="text-end"><?php echo number_format($total_modal_anggaran) ?></td>
                <td class="text-end"><?php echo number_format($total_total_anggaran) ?></td>
                <td class="text-end"><?php
                if ($total_nominal_anggaran !== 0) {
                  $total_persen_anggaran = ($total_total_anggaran/$total_nominal_anggaran) * 100;

                  echo number_format($total_persen_anggaran);     
                } 
                else
                {
                  $total_persen_anggaran = 0;
                  echo number_format($total_total_anggaran);
                }

              ?></td>
              <td class="text-end"><?php echo number_format($total_sisa_anggaran) ?></td>
              <td></td>
            </tr>    
          <?php endforeach ?>
          <tr>
            <td></td>
            <td class="fw-bold">TOTAL PROGRAM <?php echo $v['nama_program'] ?></td>
            <td class="text-end"><?php echo number_format($v['total_nominal_program']); ?></td>
            <td class="text-end"><?php echo number_format($v['total_pegawai_program']); ?></td>
            <td class="text-end"><?php echo number_format($v['total_barangjasa_program']); ?></td>
            <td class="text-end"><?php echo number_format($v['total_modal_program']); ?></td>
            <td class="text-end"><?php echo number_format($v['total_total_program']); ?></td>
            <td class="text-end"><?php echo number_format($v['total_persen_program']); ?></td>
            <td class="text-end"><?php echo number_format($v['total_sisa_program']); ?></td>
            <td></td>

            <?php $total_keseluruhan_nominal+=$v['total_nominal_program']; ?>
            <?php $total_keseluruhan_pegawai+=$v['total_pegawai_program']; ?>
            <?php $total_keseluruhan_barangjasa+=$v['total_barangjasa_program']; ?>
            <?php $total_keseluruhan_modal+=$v['total_modal_program']; ?>
            <?php $total_keseluruhan_total+=$v['total_total_program']; ?>

            <?php $total_keseluruhan_sisa+=$v['total_sisa_program']; ?>
          </tr>    
        <?php endforeach ?>

      </tbody>
      <tfoot>
        <tr>

          <th colspan="2" style="text-decoration: underline; text-align: right;">JUMLAH</th>
          <th style="text-decoration: underline;" class="text-end"><?php echo number_format($total_keseluruhan_nominal) ?></th>

          <th style="text-decoration: underline;" class="text-end"><?php echo number_format($total_keseluruhan_pegawai) ?></th>
          <th style="text-decoration: underline;" class="text-end"><?php echo number_format($total_keseluruhan_barangjasa) ?></th>
          <th style="text-decoration: underline;" class="text-end"><?php echo number_format($total_keseluruhan_modal) ?></th>
          <th style="text-decoration: underline;" class="text-end"><?php echo number_format($total_keseluruhan_total) ?></th>
          <th style="text-decoration: underline;" class="text-end">
            <?php 
            if ($total_keseluruhan_nominal !== 0) {

              $total_keseluruhan_persen = ($total_keseluruhan_total/$total_keseluruhan_nominal) * 100;

              echo number_format($total_keseluruhan_persen);
            }
            else
            {
             $total_keseluruhan_persen = 0;
             echo $total_keseluruhan_persen;
           }
           ?>
         </th>
         <th style="text-decoration: underline;" class="text-end"><?php echo number_format($total_keseluruhan_sisa) ?></th>

       </tr>
     </tfoot>
   <?php else: ?>
    <span></span>
  <?php endif ?>
  
</table>
<?php else: ?>
  <span></span>
<?php endif ?>
<br>

<h6>Total Anggaran Tiap Sumber Dana</h6>
<table border="1">
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


