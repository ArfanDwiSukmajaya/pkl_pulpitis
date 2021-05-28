<title>Penyakit - Pulpitis</title>
<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
  header('location:index.php');
  exit();
} else {
  $aksi = "pages/penyakit/aksi_penyakit.php";
  switch ($_GET['act']) {
    // Tampil penyakit
    default:
      $offset = $_GET['offset'];
      //jumlah data yang ditampilkan perpage
      $limit = 15;
      if (empty($offset)) {
        $offset = 0;
      }
      $tampil = mysqli_query($conn,"SELECT * FROM penyakit ORDER BY kode_penyakit");
      echo "<div class='container my-5 shadow p-4 p-md-4'>
          <h2 class='mb-4'>Daftar Penyakit</h2>
          <form method=POST action='?page=penyakit' name=text_form >
          
            <input class='btn btn-primary mb-4' type=button name=tambah value='Tambah Penyakit' onclick=\"window.location.href='penyakit/tambahpenyakit';\">
            <div class='input-group mb-3'>
              <input type='text' class='form-control' placeholder='Ketik dan tekan cari...' name='keyword' value='$_POST[keyword]'>
              <input class='btn btn-primary' type=submit value='Cari' name=Go>
            </div>
          </form>";
      $baris = mysqli_num_rows($tampil);
      if ($_POST[Go]) {
        $numrows = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM penyakit where nama_penyakit like '%$_POST[keyword]%'"));
        if ($numrows > 0) {
          echo "<div class='alert alert-success alert-dismissible'>
                <h4><i class='icon fa fa-check'></i> Sukses!</h4>
                Penyakit yang anda cari di temukan.
              </div>";
          $i = 1;
          echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Penyakit</th>
              <th>Detail Penyakit</th>
              <th>Saran Penyakit</th>
              <th>Aksi</th>
            </tr>
          </thead>
		      <tbody>";
          $hasil = mysqli_query($conn,"SELECT * FROM penyakit where nama_penyakit like '%$_POST[keyword]%'");
          $no = 1;
          $counter = 1;
          while ($r = mysqli_fetch_array($hasil)) {
            echo "<tr class='" . $warna . "'>
                    <td align=center>$no</td>
                    <td>$r[nama_penyakit]</td>
                    <td>$r[det_penyakit]</td>
                    <td>$r[srn_penyakit]</td>
                    <td align=center>
                      <a type='button' class='btn btn-success btn-sm' href=penyakit/editpenyakit/$r[kode_penyakit]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;

                      <a type='button' class='btn btn-danger btn-sm' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?page=penyakit&act=hapus&id=$r[kode_penyakit]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa fa-trash-o' aria-hidden='true'></i>Hapus</a>
                    </td>
                  </tr>";
            $no++;
            $counter++;
          }
          echo "</tbody>
              </table>";
        }
        else {
          echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
                Maaf, Penyakit yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
              </div>";
        }
      } else {

        if ($baris > 0) {
          echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Penyakit</th>
              <th>Detail Penyakit</th>
              <th>Saran Penyakit</th>
              <th>Aksi</th>
            </tr>
          </thead>
		  <tbody>";
          $hasil = mysqli_query($conn,"SELECT * FROM penyakit ORDER BY kode_penyakit limit $offset,$limit");
          $no = 1;
          $no = 1 + $offset;
          $counter = 1;
          while ($r = mysqli_fetch_array($hasil)) {
            echo "<tr>
                    <td align=center>$no</td>
                    <td>$r[nama_penyakit]</td>
                    <td>$r[det_penyakit]</td>
                    <td>$r[srn_penyakit]</td>
                    <td align=center>
                      <a type='button' class='btn btn-block btn-success btn-sm' href=penyakit/editpenyakit/$r[kode_penyakit]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;

                      <a type='button' class='btn btn-sm btn-danger' href='$aksi?page=penyakit&act=hapus&id=$r[kode_penyakit]'><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
                    </td>
                  </tr>";
            $no++;
            $counter++;
          }
          echo "</tbody></table>";
          //hitung jumlah halaman
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
        } else {
          echo "<br><b>Data Kosong !</b>";
        }
      }
      break;

    case "tambahpenyakit":
      echo "<div class='container my-5 shadow-lg p-4 p-md-4'>
              <h4 class='mb-4'>Tambah Penyakit</h4>
              <form name=text_form method=POST action='$aksi?page=penyakit&act=input' enctype='multipart/form-data'>
                Nama Penyakit
                <input autocomplete='off' type=text placeholder='Masukkan penyakit baru...' class='form-control mb-2' name='nama_penyakit' size=30>
                Detail Penyakit
                <textarea rows='4' cols='50' class='form-control mb-2' name='det_penyakit'type=text placeholder='Masukkan detail penyakit baru...'></textarea>
                Saran Penyakit
                <textarea rows='4' cols='50' class='form-control mb-2' name='srn_penyakit'type=text placeholder='Masukkan saran penyakit baru...'></textarea>
                Gambar Post
                Upload Gambar (Ukuran Maks = 1 MB) : 
                <input type='file' class='form-control mb-4' name='gambar' required />		  
                <input class='btn btn-success' type=submit name=submit value='Simpan' >
                <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?page=penyakit';\">
              </form>
            </div>";
      break;

    case "editpenyakit":
      $edit = mysqli_query($conn,"SELECT * FROM penyakit WHERE kode_penyakit='$_GET[id]'");
      $r = mysqli_fetch_array($edit);
      if ($r[gambar]) {
        $gambar = 'gambar/penyakit/' . $r[gambar];
      } else {
        $gambar = 'gambar/noimage.png';
      }

      echo "<div class='container my-5 shadow-lg p-4 p-md-4'>
            <h4 class='mb-4'>Ubah Penyakit</h4>
            <form name=text_form method=POST action='$aksi?page=penyakit&act=update' enctype='multipart/form-data'>
              <input type=hidden name=id value='$r[kode_penyakit]'>
		          Nama Penyakit
              <input autocomplete='off' type=text class='form-control mb-2' name='nama_penyakit' size=30 value=\"$r[nama_penyakit]\">
		          Detail Penyakit
              <textarea rows='4' cols='50' type=text class='form-control mb-2' name='det_penyakit'>$r[det_penyakit]</textarea>
		          Saran Penyakit
              <textarea rows='4' cols='50' type=text class='form-control mb-2' name='srn_penyakit'>$r[srn_penyakit]</textarea>
              Gambar Post
              Upload Gambar (Ukuran Maks = 1 MB) : <input id='upload' type='file' class='form-control mb-2' name='gambar' required />
              <img id='preview' src='$gambar' width=200>
              <br><br>          
              <input class='btn btn-success' type=submit name=submit value='Simpan' >
		          <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?page=penyakit';\">
            </form>
            </div>";
      break;
  }
  ?>
<?php } ?>

