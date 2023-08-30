<?php 
include '../koneksi.php';
$id_unit = $_GET['id_unit'];
$id_anggaran_detail = $_GET['id_anggaran_detail'];

$as = array();
$ambil_s = $koneksi->query("SELECT * FROM anggaran_sumber WHERE id_anggaran_detail='$id_anggaran_detail'");
while($detail_s = $ambil_s->fetch_assoc())
{
	$as[] = $detail_s;
}

	$koneksi->query("DELETE FROM anggaran_detail WHERE id_anggaran_detail='$id_anggaran_detail'");


foreach ($as as $key => $value) {
	$id_anggaran_sumber = $value['id_anggaran_sumber'];

	$koneksi->query("DELETE FROM anggaran_sumber WHERE id_anggaran_sumber='$id_anggaran_sumber' AND id_anggaran_detail='$id_anggaran_detail'");

}
echo "<script>alert('Terhapus')</script>";
echo "<script>location='anggaran_tampil.php?id_unit=$id_unit'</script>";
 ?>
