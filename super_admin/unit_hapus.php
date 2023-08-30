<?php 
include '../koneksi.php';
$id_unit = $_GET['id_unit'];

$koneksi->query("DELETE FROM unit WHERE id_unit='$id_unit'");

echo "<script>alert('Data Terhapus')</script>";
echo "<script>location='unit.php'</script>";
 ?>