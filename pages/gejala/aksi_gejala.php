<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    header('location:index.php');
    exit();
} else {
?>

<?php
// session_start();
include "../../config/koneksi.php";

$page=$_GET['page'];
$act=$_GET['act'];


// Hapus gejala
if ($page=='gejala' AND $act=='hapus'){
  mysqli_query($conn,"DELETE FROM gejala WHERE kode_gejala='$_GET[id]'");
  header('location:../../index.php?page='.$page);
}

// Input gejala
elseif ($page=='gejala' AND $act=='input'){
  $nama_gejala=$_POST['nama_gejala'];
  mysqli_query($conn,"INSERT INTO gejala(
    nama_gejala) 
	                       VALUES(
				'$nama_gejala')");
  header('location:../../index.php?page='.$page);
}

// Update gejala
elseif ($page=='gejala' AND $act=='update'){
$nama_gejala=$_POST[nama_gejala];
  mysqli_query($conn,"UPDATE gejala SET
					nama_gejala   = '$nama_gejala'
               WHERE kode_gejala       = '$_POST[id]'");
  header('location:../../index.php?page='.$page);
 }
 
?>
<?php } ?>
