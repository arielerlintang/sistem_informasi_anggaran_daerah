<?php 
include '../koneksi.php';
$id_bulan = $_GET['id_bulan'];

$koneksi->query("DELETE FROM bulan WHERE id_bulan='$id_bulan'");

echo "<script>alert('Data Terhapus')</script>";
echo "<script>location='bulan.php'</script>";
 ?>