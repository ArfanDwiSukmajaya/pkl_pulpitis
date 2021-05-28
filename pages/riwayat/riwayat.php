<title>Riwayat - Riwayat</title>
<?php
include "config/fungsi_alert.php";
$aksi = "pages/riwayat/aksi_hasil.php";
switch ($_GET[act]) {
// Tampil hasil
    default:
        $offset = $_GET['offset'];
//jumlah data yang ditampilkan perpage
        $limit = 15;
        if (empty($offset)) {
            $offset = 0;
        }

        $sqlgjl = mysqli_query($conn,"SELECT * FROM gejala order by kode_gejala+0");
        while ($rgjl = mysqli_fetch_array($sqlgjl)) {
            $argjl[$rgjl['kode_gejala']] = $rgjl['nama_gejala'];
        }

        $sqlpkt = mysqli_query($conn,"SELECT * FROM penyakit order by kode_penyakit+0");
        while ($rpkt = mysqli_fetch_array($sqlpkt)) {
            $arpkt[$rpkt['kode_penyakit']] = $rpkt['nama_penyakit'];
            $ardpkt[$rpkt['kode_penyakit']] = $rpkt['det_penyakit'];
            $arspkt[$rpkt['kode_penyakit']] = $rpkt['srn_penyakit'];
        }

        $tampil = mysqli_query($conn,"SELECT * FROM hasil ORDER BY id_hasil");
        $baris = mysqli_num_rows($tampil);
        if ($baris > 0) {
            echo"<div class='container my-5 shadow p-4 p-md-4'>
            <h4 class='mb-4'>Riwayat Konsultasi</h4>
            <div class='row'>
            <div class=''>
            <table class='table table-bordered table-striped riwayat' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
            <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Jenis Kelamin</th>
              <th>Umur</th>
              <th>Nama</th>
              <th>Penyakit</th>
              <th nowrap>Nilai CF</th>
            </tr>
            </thead>
            <tbody>";
            $hasil = mysqli_query($conn,"SELECT * FROM hasil ORDER BY id_hasil DESC limit $offset,$limit");
            $no = 1;
            $no = 1 + $offset;
            $counter = 1;
            while ($r = mysqli_fetch_array($hasil)) {
              if ($r[hasil_id]>0){
                echo "<tr class>
                        <td align=center>$no</td>
                        <td>$r[tanggal]</td>
                        <td>$r[nama]</td>
                        <td>$r[jk]</td>
                        <td>$r[umur]</td>
                        <td>" . $arpkt[$r[hasil_id]] . "</td>
                        <td><span class='label label-default'>" . $r[hasil_nilai] . "</span></td>
                      </tr>";
                $no++;
                $counter++;
            }
            }
            echo "</tbody></table></div></div>";
            ?>
            <?php
            echo "</div><div class='col-md-12'><div class='row'><div class=paging>";
            echo "</div></div></div>";
        } else {
            echo "<br><b>Data Kosong !</b>";
        }
}
?>




