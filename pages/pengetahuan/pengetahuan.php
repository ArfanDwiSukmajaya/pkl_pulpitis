<title>Pengetahuan - Pulpitis</title>
<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    header('location:index.php');
    exit();
} else {

$aksi="pages/pengetahuan/aksi_pengetahuan.php";
switch($_GET[act]){
	// Tampil pengetahuan
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 15;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysqli_query($conn,"SELECT * FROM basis_pengetahuan ORDER BY kode_pengetahuan");
	echo "<div class='container my-5 shadow-lg p-4 p-md-4'>
				<h2 class='mb-4'>Daftar Pengetahuan</h2>
				<form method=POST action='?page=pengetahuan' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
					<input class='btn btn-primary mb-4' type=button name=tambah value='Tambah Pengetahuan' onclick=\"window.location.href='pengetahuan/tambahpengetahuan';\">
					<div class='input-group mb-3'>
						<input type='text' class='form-control' placeholder='Ketik dan tekan cari...' name='keyword' value='$_POST[keyword]'>
						<input class='btn btn-primary' type=submit value='Cari' name=Go>
					</div>
				</form>";
		  	$baris=mysqli_num_rows($tampil);
	if ($_POST[Go]){
			$numrows = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM basis_pengetahuan b,penyakit p where b.kode_penyakit=p.kode_penyakit AND p.nama_penyakit like '%$_POST[keyword]%'"));
			if ($numrows > 0){
				echo "<div class='alert alert-success alert-dismissible'>
                <h4><i class='icon fa fa-check'></i> Sukses!</h4>
                Pengetahuan yang anda cari di temukan.
              </div>";
				$i = 1;
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Penyakit</th>
              <th>Gejala</th>
              <th>MB</th>
              <th>MD</th>
              <th width='21%'>Aksi</th>
            </tr>
          </thead>
		  <tbody>"; 
	$hasil = mysqli_query($conn,"SELECT * FROM basis_pengetahuan b,penyakit p where b.kode_penyakit=p.kode_penyakit AND p.nama_penyakit like '%$_POST[keyword]%'");
	$no = 1;
  while ($r=mysqli_fetch_array($hasil)){
	$sql = mysqli_query($conn,"SELECT * FROM gejala where kode_gejala = '$r[kode_gejala]'");
	$rgejala=mysqli_fetch_array($sql);
		echo "<tr>
						<td align=center>$no</td>
						<td>$r[nama_penyakit]</td>
						<td>$rgejala[nama_gejala]</td>
						<td align=center>$r[mb]</td>
						<td align=center>$r[md]</td>
						<td align=center>
							<a type='button' class='btn btn-sm btn-success margin' href=pengetahuan/editpengetahuan/$r[kode_pengetahuan]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
							<a type='button' class='btn btn-sm btn-danger' href='$aksi?page=pengetahuan&act=hapus&id=$r[kode_pengetahuan]'><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
						</td>
					</tr>";
      $no++;
  }
    echo "</tbody>
				</table>";
			}
			else{
				echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
                Maaf, Pengetahuan yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
              </div>";
			}
		}else{
	
	if($baris>0){
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Penyakit</th>
              <th>Gejala</th>
              <th>MB</th>
              <th>MD</th>
              <th width='21%'>Aksi</th>
            </tr>
          </thead>
		  <tbody>
		  "; 
	$hasil = mysqli_query($conn,"SELECT * FROM basis_pengetahuan ORDER BY kode_pengetahuan limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;
  while ($r=mysqli_fetch_array($hasil)){
		$sql = mysqli_query($conn,"SELECT * FROM gejala where kode_gejala = '$r[kode_gejala]'");
		$rgejala=mysqli_fetch_array($sql);
		$sql2 = mysqli_query($conn,"SELECT * FROM penyakit where kode_penyakit = '$r[kode_penyakit]'");
		$rpenyakit=mysqli_fetch_array($sql2);
		echo "<tr>
						<td align=center>$no</td>
						<td>$rpenyakit[nama_penyakit]</td>
						<td>$rgejala[nama_gejala]</td>
						<td align=center>$r[mb]</td>
						<td align=center>$r[md]</td>
						<td align=center>
							<a type='button' class='btn btn-sm btn-success margin' href=pengetahuan/editpengetahuan/$r[kode_pengetahuan]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
							
							<a type='button' class='btn btn-sm btn-danger' href='$aksi?page=pengetahuan&act=hapus&id=$r[kode_pengetahuan]'><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
						</td>
					</tr>";
    $no++;
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
  
  case "tambahpengetahuan":
	echo "<div class='container my-5 shadow p-4 p-md-4'>
					<h4>Tambah Pengetahuan</h4>
					<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<h4><i class='icon fa fa-exclamation-triangle'></i>Petunjuk Pengisian Pakar !</h4>
						Silahkan pilih gejala yang sesuai dengan penyakit yang ada, dan berikan <b>nilai kepastian (MB & MB)</b> dengan cakupan sebagai berikut:<br><br>
						<b>1.0</b> (Pasti Ya)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.8</b> (Hampir Pasti)&nbsp;&nbsp;|<br>
						<b>0.6</b> (Kemungkinan Besar)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.4</b> (Mungkin)&nbsp;&nbsp;|<br>
						<b>0.2</b> (Hampir Mungkin)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.0</b> (Tidak Tahu atau Tidak Yakin)&nbsp;&nbsp;|<br><br>
						<b>CF(Pakar) = MB – MD</b><br>
						MB : Ukuran kenaikan kepercayaan (measure of increased belief) MD : Ukuran kenaikan ketidakpercayaan (measure of increased disbelief) <br> <br>
						<b>Contoh:</b><br>
						Jika kepercayaan <b>(MB)</b> anda terhadap gejala Mencret keputih-putihan untuk penyakit Berak Kapur adalah <b>0.8 (Hampir Pasti)</b><br>
						Dan ketidakpercayaan <b>(MD)</b> anda terhadap gejala Mencret keputih-putihan untuk penyakit Berak Kapur adalah <b>0.2 (Hampir Mungkin)</b><br><br>
						<b>Maka:</b> CF(Pakar) = MB – MD (0.8 - 0.2) = <b>0.6</b> <br>
						Dimana nilai kepastian anda terhadap gejala Mencret keputih-putihan untuk penyakit Berak Kapur adalah <b>0.6 (Kemungkinan Besar)</b>
						<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
					</div>
        	<form name=text_form method=POST action='$aksi?page=pengetahuan&act=input'>
          <br><br>
		  		Penyakit
					<select class='form-control mb-2' name='kode_penyakit'  id='kode_penyakit'><option value=''>- Pilih Penyakit -</option>";

		$hasil4 = mysqli_query($conn,"SELECT * FROM penyakit order by nama_penyakit");

		while($r4=mysqli_fetch_array($hasil4)){
			echo "<option value='$r4[kode_penyakit]'>$r4[nama_penyakit]</option>";
		}
		echo	"</select>
					Gejala
					<select class='form-control mb-2' name='kode_gejala' id='kode_gejala'><option value=''>- Pilih Gejala -</option>";
		$hasil4 = mysqli_query($conn,"SELECT * FROM gejala order by nama_gejala");
		while($r4=mysqli_fetch_array($hasil4)){
			echo "<option value='$r4[kode_gejala]'>$r4[nama_gejala]</option>";
		}
		echo	"</select
					<tr><td>MB<input autocomplete='off' placeholder='Masukkan MB' type=text class='form-control mb-2' name='mb' size=15 ></td></tr>
					<tr><td>MD<input autocomplete='off' placeholder='Masukkan MD' type=text class='form-control mb-4' name='md' size=15 ></td></tr>

		  		<tr><td><input class='btn btn-success' type=submit name=submit value='Simpan' >
		  		<input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?page=pengetahuan';\"></td></tr>
      	</form>
					
			</div>";
     break;
    
  case "editpengetahuan":
    $edit=mysqli_query($conn,"SELECT * FROM basis_pengetahuan WHERE kode_pengetahuan='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
	
    echo "<div class='container my-5 shadow p-4 p-md-4'>
						<h4 class='mb-4'>Ubah Pengetahuan</h4>
						<form name=text_form method=POST action='$aksi?page=pengetahuan&act=update'>
						<input type=hidden name=id value='$r[kode_pengetahuan]'>
						<div class='mb-3'>
							<label class='form-label'>Penyakit</label>
							<select class='form-select mb-2' name='kode_penyakit' id='kode_penyakit'>";
		$hasil4 = mysqli_query($conn,"SELECT * FROM penyakit order by nama_penyakit");
		while($r4=mysqli_fetch_array($hasil4)){
			echo "<option value='$r4[kode_penyakit]'"; if($r[kode_penyakit]==$r4[kode_penyakit]) echo "selected";
			echo ">$r4[nama_penyakit]</option>";
		}
		echo	"</select> </div>
					<div class='mb-3'>
					<label class='form-label'>Gejala</label>
						<select class='form-select mb-2' name='kode_gejala' id='kode_gejala'>";
		$hasil4 = mysqli_query($conn,"SELECT * FROM gejala order by nama_gejala");
		while($r4=mysqli_fetch_array($hasil4)){
			echo "<option value='$r4[kode_gejala]'"; if($r[kode_gejala]==$r4[kode_gejala]) echo "selected";
			echo ">$r4[nama_gejala]</option>";
		}
		echo	"</select> </div>
					<div class='mb-3'>
						<label class='form-label'>MB</label>
						<input autocomplete='off' placeholder='Masukkan MB' type=text class='form-control mb-2' name='mb' size=15 value='$r[mb]'>
					</div>
					<div class='mb-3'>
						<label class='form-label'>MD</label>
						<input autocomplete='off' placeholder='Masukkan MD' type=text class='form-control mb-4' name='md' size=15 value='$r[md]'>
					</div>		
          <input class='btn btn-success' type=submit name=submit value='Simpan' >
		  		<input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?page=pengetahuan';\">
        </form>
			</div>";
    break;  
}
?>
<?php } ?>
