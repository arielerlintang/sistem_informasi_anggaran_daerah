<?php 
session_start();

// menghancukan sesi pelogin
session_destroy();

echo "<script>alert('Anda Log Out')</script>";
echo "<script>location='../index.php'</script>";

 ?>