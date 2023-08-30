<?php 
include '../koneksi.php';
$id_tahun = $_GET['id_tahun'];

$koneksi->query("DELETE FROM tahun WHERE id_tahun='$id_tahun'");

echo "<script>alert('Data Terhapus')</script>";
echo "<script>location='tahun.php'</script>";
 ?>