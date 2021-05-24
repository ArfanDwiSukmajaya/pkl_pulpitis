<title>Gejala - Pulpitis</title>
<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    header('location:index.php');
    exit();
}

$gejala=mysqli_query($conn,"SELECT * FROM gejala ORDER BY kode_gejala");

?>

<h4 class='mb-4'>Daftar Gejala</h4>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Tambah Data
</button>

<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Cari.." aria-label="Recipient's username" aria-describedby="button-addon2">
  <button class="btn btn-primary text-white" type="button" id="button-addon2">Cari</button>
</div>

<table class='table table-bordered mt-4' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
  <thead>
    <tr class=''>
      <th scope="col">No</th>
      <th scope="col">Kode Gejala</th>
      <th scope="col">Nama Gejala</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php $no=1 ?>
  <?php foreach($gejala as $g) : ?>
  <tr>
    <th scope="row"><?= $no ?></th>
    <td><?= $g['kode_gejala'] ?></td>
    <td><?= $g['nama_gejala'] ?></td>
    <td>
      <a href="ubah.php?id=<?= $g["kode_gejala"]?>">Edit</a> | 
      <a href="hapus.php?id=<?= $g["id"] ?>" onclick="return confirm('yakin?')">Hapus</a>
    </td>
  </tr>
  <?php $no++ ?>
  <?php endforeach ?>
  </tbody>
</table>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
