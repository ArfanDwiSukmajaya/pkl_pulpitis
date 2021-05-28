<title>Login Gagal !  Pulpitis</title>


<?php
session_start();
include "config/koneksi.php";

$user=$_POST['username'];
$pass=md5($_POST['password']);

$login=mysqli_query($conn,"select * from admin where username='$user' and password='$pass'");

$ketemu=mysqli_num_rows($login);
$r=mysqli_fetch_array($login);
if ($ketemu>0) {
	$_SESSION['username'] = $r['username'];
	$_SESSION['password'] = $r['password'];
	$_SESSION['nama_lengkap'] = $r['nama_lengkap'];
	header("location: ./");
}
else{
  echo "Username/Pasword Salah
        <a href='./formlogin'>Ulangi Login</a>";
  // header("location: ./formlogin");
}
?>


