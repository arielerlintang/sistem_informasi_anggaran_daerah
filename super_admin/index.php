
<?php include 'header.php' ?>

<div class="container">
  <div class="row">
    <div class="col-md-12 shadow rounded bg-white p-5 my-3">
      <h6>Selamat Datang <span class="fw-bold"></span></h6>
      <p>Kelola data .. dan ... Melalui Panel Ini</p>
    </div>
  </div>

  <!--  -->
  <?php 
  // menghitung total admin 
  $jumlah_admin = $koneksi->query("SELECT COUNT(id_admin) AS jumlah FROM admin")->fetch_assoc();
  $jumlah_unit = $koneksi->query("SELECT COUNT(id_unit) AS jumlah FROM unit")->fetch_assoc();
  $jumlah_program = $koneksi->query("SELECT COUNT(id_program) AS jumlah FROM program")->fetch_assoc();
  $jumlah_subkegiatan = $koneksi->query("SELECT COUNT(id_subkegiatan) AS jumlah FROM subkegiatan")->fetch_assoc();
  $jumlah_kegiatan = $koneksi->query("SELECT COUNT(id_kegiatan) AS jumlah FROM kegiatan")->fetch_assoc();
  
  
  ?>
  <div class="row">
    <div class="col-xl-3 col-md-6">
      <div class="card bg-primary text-white mb-4">
        <div class="card-body">Total Admin</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <h1><?php echo $jumlah_admin['jumlah'] ?></h1>
          <br>
          <a class="small text-white stretched-link" href="admin.php">View Details</a>
          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card bg-warning text-white mb-4">
        <div class="card-body">Total Unit</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <h1><?php echo $jumlah_unit['jumlah']; ?></h1>
          <a class="small text-white stretched-link" href="unit.php">View Details</a>
          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card bg-success text-white mb-4">
        <div class="card-body">Total Program</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <h1><?php echo $jumlah_program['jumlah']; ?></h1>
          <!-- <a class="small text-white stretched-link" href="">View Details</a> -->
          <!-- <div class="small text-white"><i class="fas fa-angle-right"></i></div> -->
        </div>
      </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
      <div class="card bg-danger text-white mb-4">
        <div class="card-body">Kegiatan</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <h1><?php echo $jumlah_subkegiatan['jumlah'] ?></h1>
          <a class="small text-white stretched-link" href="subkegiatan.php">Kegiatan</a>
          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card bg-success text-white mb-4">
        <div class="card-body">Sub Kegiatan</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <h1><?php echo $jumlah_kegiatan['jumlah'] ?></h1>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php' ?>

