<?php $page = $_GET['page']; ?>

<li class="nav-item">
  <a  <?php if ($page == "") echo 'class="nav-link active"'; ?> class="nav-link" aria-current="page" href="./">Home</a>
</li>

<li class='nav-item'>
    <a <?php if ($page == 'diagnosa') echo 'class="nav-link active"'; ?> class='nav-link' aria-current='page' href='diagnosa'>Diagnosa</a>
  </li>

<!-- Menu untuk admin -->
<?php if(isset($_SESSION['username']) && isset($_SESSION['password'])) : ?>
  <li class='nav-item'>
    <a <?php if ($page == 'penyakit') echo 'class="nav-link active"';?> class='nav-link' aria-current='page' href='penyakit'>Penyakit</a>
  </li>
  <li class='nav-item'>
    <a <?php if ($page == 'gejala') echo 'class="nav-link active"';?> class='nav-link' aria-current='page' href='gejala'>Gejala</a>
  </li>
  <li class='nav-item'>
    <a <?php if ($page == 'pengetahuan') echo 'class="nav-link active"';?> class='nav-link' aria-current='page' href='pengetahuan'>Pengetahuan</a>
  </li>

<?php endif;  ?>

<li class='nav-item'>
  <a <?php if ($page == 'tentang') echo 'class="nav-link active"';?> class='nav-link' aria-current='page' href='tentang'>Tentang Kami</a>
</li>
  