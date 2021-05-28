<title>Ubah Password - Pulpitis</title>
<?php
if ($_SESSION[username] != "" && $_SESSION[password] != ""){
switch($_GET[act]){
default:
echo "<div class='container my-5 shadow p-4 p-md-4'>
		<h4>Ubah Password</h4>
		<form method='post' action='?page=password&act=updatepassword'>
		<table class='table table-bordered'>
		<tr><td width=220>Masukkan password lama</td><td><input class='form-control' autocomplete='off' placeholder='Ketik password lama...' type='password' name='oldPass' /></td></tr>
		<br><tr><td>Masukkan password baru</td><td><input class='form-control' autocomplete='off' placeholder='Ketik password baru...' type='password' name='newPass1' /></td></tr>
		<br><tr><td>Masukkan kembali password baru</td><td><input class='form-control' autocomplete='off' placeholder='Ulangi password baru...' type='password' name='newPass2' /></td></tr>
		<tr><td></td><td>
		<input class='btn btn-success' type=submit name=submit title='Simpan' alt='Simpan' value='Simpan' />
		<input type='hidden' name='pass' value='".$_SESSION[password]."'>
		<input type='hidden' name='nama' value='".$_SESSION[username]."'></td></tr>
		</table>		
		</form> </div>";
break;

case "updatepassword":
include "config/koneksi.php";
$user = $_POST['nama'];
$passwordlama = $_POST['oldPass'];
$passwordbaru1 = $_POST['newPass1'];
$passwordbaru2 = $_POST['newPass2'];
$query = "SELECT * FROM admin WHERE username = '$user'";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_array($hasil);

if ($data['password'] ==  md5($passwordlama))
{
	if ($passwordbaru1 == $passwordbaru2)
	{
		$passwordbaruenkrip = md5($passwordbaru1);
		$query = "UPDATE admin SET password = '$passwordbaruenkrip' WHERE username = '$user' ";
		$hasil = mysqli_query($conn, $query);
		
		if ($hasil) echo "<div class='alert alert-success' role='alert'>
		Password berhasil diubah
	</div>";
	}
	else echo "<div class='alert alert-danger' role='alert'>
	Password baru Anda tidak sama
</div>";
}
else echo "<div class='alert alert-danger' role='alert'>
Password lama anda salah
</div>";
break;
}
}else{
echo "<h2><a href='#'>Akses Ditolak</a></h2>
<br>
<strong>Anda harus login untuk dapat mengakses menu ini!</strong><br><br>
<input type=button value='Klik Disini' onclick=location.href='./'><br><br><br><br>";
}
?>