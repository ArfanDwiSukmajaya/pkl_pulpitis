<title>Admin - Pulpitis</title>
<?php
session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    header('location:./');
    exit();
} else {

$aksi="pages/admin/aksi_admin.php";

switch($_GET[act]){
	// Tampil admin
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysqli_query($conn,"SELECT * FROM admin ORDER BY username");
	echo "<div class='container my-5 shadow p-4 p-md-4'>
				<form method=POST action='?page=admin' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
        	<input class='btn btn-primary mb-4' type=button name=tambah value='Tambah Admin' onclick=\"window.location.href='admin/tambahadmin';\">
					<div class='input-group mb-3'>
						<input type='text' class='form-control' placeholder='Ketik dan tekan cari...' name='keyword' value='$_POST[keyword]'>
						<input class='btn btn-primary' type=submit value='Cari' name=Go>
					</div>
        </form>";
		  	$baris=mysqli_num_rows($tampil);
	if ($_POST[Go]){
			$numrows = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM admin where username like '%$_POST[keyword]%'"));
			if ($numrows > 0){
				echo "<div class='alert alert-success alert-dismissible'>
                <h4><i class='icon fa fa-check'></i> Sukses!</h4>
                Admin yang anda cari di temukan.
              </div>";
				$i = 1;
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Nama Lengkap</th>
              <th width='21%'>Aksi</th>
            </tr>
          </thead>
		  <tbody>"; 
	$hasil = mysqli_query($conn,"SELECT * FROM admin where username like '%$_POST[keyword]%'");
	$no = 1;
	$counter = 1;
    while ($r=mysqli_fetch_array($hasil)){
       echo "<tr class=''>
			 				<td align=center>$no</td>
	         		<td>$r[username]</td>
	         		<td>$r[nama_lengkap]</td>
			 				<td align=center>
			 					<a type='button' class='btn btn-success btn-sm' href=admin/editadmin/$r[username]><i class='fa 	fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;

								 <a type='button' class='btn btn-sm btn-danger' href='$aksi?page=admin&act=hapus&id=$r[username]'><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>

             </td>
						</tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table>";
			}
			else{
				echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
                Maaf, Admin yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
              </div>";
			}
		}else{
	
	if($baris>0){
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Nama Lengkap</th>
              <th width='21%'>Aksi</th>
            </tr>
          </thead>
		  <tbody>
		  "; 
	$hasil = mysqli_query($conn,"SELECT * FROM admin ORDER BY username limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;

    while ($r=mysqli_fetch_array($hasil)){
       echo "<tr class=''>
							<td align=center>$no</td>
	         		<td>$r[username]</td>
	         		<td>$r[nama_lengkap]</td>
			 				<td align=center>
			 					<a type='button' class='btn btn-success btn-sm' href=admin/editadmin/$r[username]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
			 					<a type='button' class='btn btn-sm btn-danger' href='$aksi?page=admin&act=hapus&id=$r[username]'><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
             </td>
						</tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table>";
		echo "<nav aria-label=...>
  			<ul class=pagination>";
	//hitung jumlah halaman
	$halaman = intval($baris/$limit);//Pembulatan

	if ($baris%$limit){
		$halaman++;
	}
	for($i=1;$i<=$halaman;$i++){
		$newoffset = $limit * ($i-1);
		if($offset!=$newoffset){
			// echo "<a href=index.php?page=pengetahuan&offset=$newoffset>$i</a>";
			echo "<li class='page-item'><a class='page-link' href=index.php?page=pengetahuan&offset=$newoffset>$i</a></li>";
			//cetak halaman
		}
		else {
			// echo "<span class=current>".$i."</span>";//cetak halaman tanpa link
			echo "<li class='page-item active' aria-current='page'>
							<a class='page-link' href=''>$i</a>
						</li>";
		}
	}

	echo "</div> </div>";
	}else{
	echo "<br><b>Data Kosong !</b>";
	}
	}
    break;
  
  case "tambahadmin":
	echo "<form name=text_form method=POST action='$aksi?page=admin&act=input'>
          <br><br>
					<table class='table table-bordered'>
		  			<tr><td>Nama Lengkap</td>   <td>  <input autocomplete='off' placeholder='Masukkan nama lengkap...' type=text class='form-control' name='nama_lengkap' size=30></td></tr>
          	<tr><td>Username</td>   <td>  <input autocomplete='off' placeholder='Masukkan username...' type=text class='form-control' name='username' size=30></td></tr>
		  			<tr><td>Password</td>   <td> <input autocomplete='off' placeholder='Masukkan password admin...' type=password class='form-control' name='password' size=30></td></tr>
		  			<tr><td></td><td>
					  <input class='btn btn-success' type=submit name=submit value='Simpan' >
		  			<input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?page=admin';\">
		  			</td></tr>
          </table></form>";
     break;
    
  case "editadmin":
    $edit=mysqli_query($conn,"SELECT * FROM admin WHERE username='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
	
    echo "<form name=text_form method=POST action='$aksi?page=admin&act=update'>
          <input type=hidden name=id value='$r[username]'>
          <br><br><table class='table table-bordered'>
	      <tr><td>Username</td> <td>  <input autocomplete='off' type=text class='form-control' name='username' value=\"$r[username]\" size=30></td></tr>
	      <tr><td>Nama Lengkap</td> <td>  <input autocomplete='off' type=text class='form-control' name='nama_lengkap' value=\"$r[nama_lengkap]\" size=30></td></tr>
          <tr><td></td><td>
		  <input class='btn btn-success' type=submit name=submit value='Simpan' >
		  <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?page=admin';\"></td></tr>
          </table></form>";
    break;  
}
?>
<?php 
} ?>
