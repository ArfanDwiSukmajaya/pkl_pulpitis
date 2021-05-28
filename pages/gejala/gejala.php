<title>Gejala - Pulpitis</title>
<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    header('location:index.php');
    exit();
} else {
    ?>
<?php
$aksi="pages/gejala/aksi_gejala.php";
switch($_GET[act]){
	// Tampil gejala
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 25;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysqli_query($conn,"SELECT * FROM gejala ORDER BY kode_gejala");
	echo "<div class='container my-5 shadow p-md-4'>
				<h2 class='mb-4'>Daftar Gejala</h2>
				<form method=POST action='?page=gejala' name=text_form>
          <input class='btn btn-primary mb-4' type=button name=tambah value='Tambah Gejala' onclick=\"window.location.href='gejala/tambahgejala';\">
          <div class='input-group mb-3'>
						<input type='text' class='form-control' placeholder='Ketik dan tekan cari...' name='keyword' value='$_POST[keyword]'>
						<input class='btn btn-primary' type=submit value='Cari' name=Go>
					</div>
        </form>";
		  $baris=mysqli_num_rows($tampil);
		  
	if ($_POST[Go]){
				$numrows = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM gejala where nama_gejala like '%$_POST[keyword]%'"));
				if ($numrows > 0){
					echo "<div class='alert alert-success alert-dismissible'>
									<h4><i class='icon fa fa-check'></i> Sukses!</h4>
									Gejala yang anda cari di temukan.
								</div>";
					$i = 1;
		echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Gejala</th>
								<th width='21%'>Aksi</th>
							</tr>
						</thead>
				<tbody>"; 
		$hasil = mysqli_query($conn,"SELECT * FROM gejala where nama_gejala like '%$_POST[keyword]%'");
		$no = 1;
		$counter = 1;
		while ($r=mysqli_fetch_array($hasil)){
		echo "<tr class=''>
						<td align=center>$no</td>
						<td>$r[nama_gejala]</td>
						<td align=center>
							<a type='button' class='btn btn-sm btn-success margin' href=gejala/editgejala/$r[kode_gejala]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;

							<a type='button' class='btn btn-sm btn-danger' href='$aksi?page=gejala&act=hapus&id=$r[kode_gejala]'><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
						</td>
					</tr>";
			$no++;
		}

			echo "</tbody></table>";
		
		}else{
			echo "<div class='alert alert-danger alert-dismissible'>
							<h4><i class='icon fa fa-ban'></i> Gagal!</h4>
							Maaf, Gejala yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
						</div>";
		}

	}else{
	
	if($baris>0){
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Gejala</th>
              <th width='21%'>Aksi</th>
            </tr>
          </thead>
		  <tbody>
		  "; 
	$hasil = mysqli_query($conn,"SELECT * FROM gejala ORDER BY kode_gejala limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;
	while ($r=mysqli_fetch_array($hasil)){
	echo "<tr>
					<td align=center>$no</td>
					<td>$r[nama_gejala]</td>
					<td align=center>
						<a type='button' class='btn  btn-sm btn-success margin' href=gejala/editgejala/$r[kode_gejala]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;

						<a type='button' class='btn btn-sm btn-danger' href='$aksi?page=gejala&act=hapus&id=$r[kode_gejala]'><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
					</td>
				</tr>";

		$no++;
	}
  echo "</tbody></table>";

	//hitung jumlah halaman
	echo "</tbody>
			</table>";
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
  
  case "tambahgejala":

    echo "<div class='container my-5 shadow p-4 p-md-4'>
					<h4 class='mb-4'>Tambah Gejala</h4>
					<form name=text_form method=POST action='$aksi?page=gejala&act=input'>	
						Nama Gejala 
						<input type=text autocomplete='off' placeholder='Masukkan gejala baru...' class='form-control mb-4 mt-2' name='nama_gejala' size=30>
						<input class='btn btn-success' type=submit name=submit value='Simpan' >
						<input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?page=gejala';\">
					</form>
					</div>";
     break;
    
  case "editgejala":
    $edit=mysqli_query($conn,"SELECT * FROM gejala WHERE kode_gejala='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
	
    echo "<div class='container my-5 shadow-lg p-4 p-md-4'>
						<h4 class='mb-4'>Ubah Gejala</h4>
						<form name=text_form method=POST action='$aksi?page=gejala&act=update'>
							<input type=hidden name=id value='$r[kode_gejala]'>
								Nama Gejala
								<input autocomplete='off' type=text class='form-control mb-2' name='nama_gejala' value=\"$r[nama_gejala]\">
								<input class='btn btn-success' type=submit name=submit value='Simpan' >
								<input class='btn btn-danger' type=button value='Batal' onclick=\"window.location.href='?page=gejala';\">
						</form>
					</div>";
    break;  
}
?>
<?php } ?>
