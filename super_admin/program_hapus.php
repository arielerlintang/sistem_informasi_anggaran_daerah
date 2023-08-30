<?php 
include '../koneksi.php';
$id_program = $_GET['id_program'];
$id_unit = $_GET['id_unit'];

$koneksi->query("DELETE FROM program WHERE id_program='$id_program'");

echo "<script>alert('Data Terhapus')</script>";
echo "<script>location='program.php?id_unit=$id_unit'</script>";

 ?>

 <!-- setiap unit punya anggarannya masing-masing unit-->