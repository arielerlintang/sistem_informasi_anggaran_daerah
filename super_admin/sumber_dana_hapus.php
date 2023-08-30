<?php 
include '../koneksi.php';
$id_sumber_dana = $_GET['id_sumber_dana'];

$koneksi->query("DELETE FROM sumber_dana WHERE id_sumber_dana='$id_sumber_dana'");

echo "<script>alert('Data Terhapus')</script>";
echo "<script>location='sumber_dana.php'</script>";
 ?>