<?php 
include '../koneksi.php';
$id_kegiatan = $_GET['id_kegiatan'];
$id_subkegiatan = $_GET['id_subkegiatan'];

$koneksi->query("DELETE FROM kegiatan WHERE id_kegiatan='$id_kegiatan'");

echo "<script>alert('Data Terhapus')</script>";
echo "<script>location='kegiatan.php?id_subkegiatan=$id_subkegiatan'</script>";

 ?>

 <!-- setiap unit punya anggarannya masing-masing unit-->