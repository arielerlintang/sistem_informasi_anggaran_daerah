<?php 
include '../koneksi.php';
$id_admin = $_GET['id_admin'];

$koneksi->query("DELETE FROM admin WHERE id_admin='$id_admin'");

echo "<script>alert('Data Terhapus')</script>";
echo "<script>location='admin.php'</script>";
 ?>