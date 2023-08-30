<?php 
include '../koneksi.php';
$id_subkegiatan = $_GET['id_subkegiatan'];

$koneksi->query("DELETE FROM subkegiatan WHERE id_subkegiatan='$id_subkegiatan'");

echo "<script>alert('Data Terhapus')</script>";
echo "<script>location='subkegiatan.php'</script>";
 ?>