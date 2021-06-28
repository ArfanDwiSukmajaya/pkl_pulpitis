<title>Diagnosa - Pulpitis</title>
<?php
switch ($_GET['act']) {

  default:
    if ($_POST['submit']) {

    $nama = $_POST['name'];
    $jk = $_POST['jk'];
    $umur = $_POST['umur'];

    date_default_timezone_set("Asia/Jakarta");
    $inptanggal = date('Y-m-d H:i:s');

    $arbobot = array('0', '1', '0.8', '0.6', '0.4', '-1');
    $argejala = array();

    for ($i = 0; $i < count($_POST['kondisi']); $i++) {
      $arkondisi = explode("_", $_POST['kondisi'][$i]);
      // var_dump($arkondisi[1]); 
    // }die();
    // $inputan = $arkondisi[1];
    // var_dump($inputan);
    // echo $arbobot[$inputan];
      if (strlen($_POST['kondisi'][$i]) > 1) {
        $argejala += array($arkondisi[0] => $arkondisi[1]);
      }
    }

    $sqlkondisi = mysqli_query($conn, "SELECT * FROM kondisi order by id+0");
    while ($rkondisi = mysqli_fetch_array($sqlkondisi)) {
      $arkondisitext[$rkondisi['id']] = $rkondisi['kondisi'];
    }

    $sqlpkt = mysqli_query($conn, "SELECT * FROM penyakit order by kode_penyakit+0");
    while ($rpkt = mysqli_fetch_array($sqlpkt)) {
      $arpkt[$rpkt['kode_penyakit']] = $rpkt['nama_penyakit'];
      $ardpkt[$rpkt['kode_penyakit']] = $rpkt['det_penyakit'];
      $arspkt[$rpkt['kode_penyakit']] = $rpkt['srn_penyakit'];
      $argpkt[$rpkt['kode_penyakit']] = $rpkt['gambar'];
    }

    //print_r($arkondisitext);
// -------- perhitungan certainty factor (CF) ---------
// --------------------- MULAI ------------------------
    $sqlpenyakit = mysqli_query($conn, "SELECT * FROM penyakit order by kode_penyakit");
    $arpenyakit = array();
    while ($rpenyakit = mysqli_fetch_array($sqlpenyakit)) {

      $cftotal_temp = 0;
      $cf = 0;
      $sqlgejala = mysqli_query($conn, "SELECT * FROM basis_pengetahuan where kode_penyakit=$rpenyakit[kode_penyakit]");
      // var_dump($sqlgejala);
      // die();
      $cflama = 0;
      while ($rgejala = mysqli_fetch_array($sqlgejala)) {
        $arkondisi = explode("_", $_POST['kondisi'][0]);
        $gejala = $arkondisi[0];

        for ($i = 0; $i < count($_POST['kondisi']); $i++) {
          $arkondisi = explode("_", $_POST['kondisi'][$i]);
          $gejala = $arkondisi[0];
          if ($rgejala['kode_gejala'] == $gejala) {

          // var_dump($inputan);
            // var_dump($arbobot[$arkondisi[]]); die();
            // var_dump($arbobot);
            // var_dump($gejala);
            $cf = ($rgejala['mb'] - $rgejala['md']) * $arbobot[$arkondisi[1]];

            if (($cf >= 0) && ($cf * $cflama >= 0)) {
              $cflama = $cflama + ($cf * (1 - $cflama));
            }
            // var_dump($cflama);
            // die();
            if ($cf * $cflama < 0) {
              $cflama = ($cflama + $cf) / (1 - Math . Min(Math . abs($cflama), Math . abs($cf)));
            }
            if (($cf < 0) && ($cf * $cflama >= 0)) {
              $cflama = $cflama + ($cf * (1 + $cflama));
            }
          }
        }
      }
      if ($cflama > 0) {
        $arpenyakit += array($rpenyakit[kode_penyakit] => number_format($cflama, 5));
      }
      
    }  
    // var_dump($arpenyakit);  
    // die();
    arsort($arpenyakit);
    

    $inpgejala = serialize($argejala);
    $inppenyakit = serialize($arpenyakit);

    $np1 = 0;
    foreach ($arpenyakit as $key1 => $value1) {
      $np1++;
      $idpkt1[$np1] = $key1;
      $vlpkt1[$np1] = $value1;
    }

    mysqli_query($conn, "INSERT INTO hasil( nama, jk, umur, tanggal, gejala, penyakit, hasil_id, hasil_nilai) 
                         VALUES('$nama', '$jk', '$umur', '$inptanggal', '$inpgejala', '$inppenyakit', '$idpkt1[1]', '$vlpkt1[1]')
                        "); ?>
    <div class="container my-5 shadow-lg p-4 p-md-5 mb-4">
    <h2 class='text text-success'>Hasil Diagnosis</h2>
    <button class='btn btn-primary ms-auto float-end mb-4 ' id='print' onClick='window.print();' data-toggle='tooltip' data-placement='right' title='Klik tombol ini untuk mencetak hasil diagnosa'>
    <i class=''></i> Cetak
    </button>
    <div class="clear-both" style="clear:both"></div>
    <div class="card text-white mb-3 card border-success">
      <div class="card-header bg-success">Data Pasien</div>
      <div class="card-body text-dark">
       <p>Nama : <b> <?= $nama ?> </b></p>
        <p>Jenis Kelmain : <b> <?= $jk ?>  </b> </p>
        <p>Umur : <b> <?= $umur ?> </b> </p>
      </div>
    </div>
    <table class='table table-bordered table-striped diagnosa'> 
      <tr class=''>
        <th width=8%>No</th>
        <th width=10%>Kode</th>
        <th>Gejala yang dialami (keluhan)</th>
        <th width=20%>Pilihan</th>
    </tr>

    <?php       
    $ig = 0;
    foreach ($argejala as $key => $value) : 
      $kondisi = $value;
      $ig++;
      $gejala = $key;
      $sql4 = mysqli_query($conn, "SELECT * FROM gejala where kode_gejala = '$key'");
      $r4 = mysqli_fetch_array($sql4);
      ?>
      <tr>
        <td><?= $ig ?></td>
        <td>G<?= str_pad($r4['kode_gejala'], 3, '0', STR_PAD_LEFT) ?> </td>
        <td><span class="hasil text"><?= $r4['nama_gejala']  ?>   </span></td>  
        <td><span class="kondisipilih"><?= $arkondisitext[$kondisi] ?></span></td>
      </tr>
    <?php endforeach ?>
    <?php 
    $np = 0;
    foreach ($arpenyakit as $key => $value) {
      $np++;
      $idpkt[$np] = $key;
      $nmpkt[$np] = $arpkt[$key];
      $vlpkt[$np] = $value;
    }
    if ($argpkt[$idpkt[1]]) {
      $gambar = 'gambar/penyakit/' . $argpkt[$idpkt[1]];
    } else {
      $gambar = 'gambar/noimage.png';
    } ?>
    </table>

    <div class='well well-small'>
      <!-- <img class='card-img-top img-bordered-sm' style='float:right; margin-left:15px;' src='" . <?= $gambar ?> . "' height=200> -->
    <h3>Hasil Diagnosa</h3> 

    <div class="card text-white mb-3 card border-success">
      <div class="card-header bg-success">Jenis penyakit yang diderita adalah</div>
      <div class="card-body text-dark">
      <h3 class='text text-success'><?= $nmpkt[1];  $penyakit = round($vlpkt[1], 2) * 100 ?> = <?= $penyakit ?> % / <?= $vlpkt[1]  ?>
      </div>
      <div class="card-header text-dark">Detail</div>
      <div class="card-body text-dark">
      <p> <?= $ardpkt[$idpkt[1]]  ?></p>
      </div>
    </div>

    <div class="card text-white mb-3 card border-warning">
      <div class="card-header bg-warning">Saran</div>
      <div class="card-body text-dark">
      <p> <?= $arspkt[$idpkt[1]] ?></p>
      </div>
    </div>

    <div class="card text-white mb-3 card border-danger">
      <div class="card-header bg-danger">Kemungkinan lain</div>
      <div class="card-body text-dark">
      <?php  for ($ipl = 2; $ipl < count($idpkt); $ipl++) { ?>
        <p><i class='fa fa-caret-square-o-right'></i> <?= $nmpkt[$ipl] ?> </b> =  <?= round($vlpkt[$ipl], 2) * 100 ?>  %  ( <?= $vlpkt[$ipl] ?> )  <br></h4>
        <?php } ?>
      </div>
    </div>
    </div>
    </div>


<?php }else{ ?>
  <div class="container shadow p-3 mb-5 bg-body rounded">
  <h2 class='mb-4'>Diagnosa Penyakit</h2>  

  <div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Perhatian</strong> Silahkan isi data diri anda terlebih dahulu kemudian memilih gejala sesuai dengan kondisi gigi anda, anda dapat memilih kepastian kondisi gigi anda dari pasti tidak sampai pasti ya, jika sudah tekan <Strong>Tombol proses</Strong> di bawah untuk melihat hasil.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>

  <form name=text_form method=POST action='diagnosa' >
    <div class='card'>
      <div class='card-header bg-light'>
        <b>Masukan Data Diri Anda</b>
      </div>

      <div class='card-body'>
        <div class='mb-3'>
          <label for='name' class='form-label'>Nama</label>
          <input type='text' class='form-control' id='name' placeholder='Masukan Nama' name='name' required>
        </div>
        <div class='mb-3'>
          <label for='name' class='form-label'>Jenis Kelamin</label>
          <select name='jk' class='form-select' aria-label='Default select example' required>
            <option selected>Pilih Jenis Kelamin</option>
            <option value='Laki-Laki'>Laki-Laki</option>
            <option value='Perempuan'>Perempuan</option>
          </select>
        </div>
        <div class='mb-3'>
          <label for='umur' class='form-label'>Umur</label>
          <input type='number' class='form-control' id='umur' placeholder='Masukan Umur' name='umur' required>
        </div>
      </div>
    </div>

    <table class='table table-bordered table-striped konsultasi'>
      <tbody class='pilihkondisi'>
        <tr class="">
          <th>No</th>
          <th>Kode</th>
          <th>Gejala</th>
          <th>Pilih Kondisi</th>
        </tr>
        <?php  
        $sql3 = mysqli_query($conn, "SELECT * FROM gejala order by kode_gejala");
        $i = 0;
        while ($r3 = mysqli_fetch_array($sql3)) :
        $i++; ?>
        <tr>
          <td class=opsi><?= $i ?></td>
          <td class=opsi>G<?= str_pad($r3['kode_gejala'], 2, '0', STR_PAD_LEFT) ?></td>
          <td class=gejala> <?= $r3['nama_gejala'] ?></td>
          <td class="opsi">
          <select name="kondisi[]" id="sl' . <?= $i ?> . '"  class="form-select" aria-label="Default select example"/>
            <option data-id="0" value="0" selected>Apakah merasakan</option>';
            <?php 
            $s = "SELECT * FROM kondisi ORDER BY id";
            $q = mysqli_query($conn, $s) or die($s);
            while ($rw = mysqli_fetch_array($q)) : ?>
              <option data-id="<?php echo $rw['id']; ?>" value="<?php echo $r3['kode_gejala'] . '_' . $rw['id']; ?>"><?php echo $rw['kondisi']; ?></option>
            <?php endwhile ?>
          </select>
          </td>
        </tr>
        <?php endwhile ?>
      </tbody>
    </table>
    <div class='float-end'>
      <input class='btn btn-primary mb-4 ms-auto' type=submit title='Klik disini untuk melihat hasil diagnosa' name=submit  value='Proses'>
    </div><br>

  </form>
  </div>
  
  <?php
  }
  break;
}


