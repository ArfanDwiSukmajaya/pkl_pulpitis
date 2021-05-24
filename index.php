<?php 
  error_reporting(0);
  session_start();

  include "config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="aset/bootstrap.min.css" />
    <!-- <title>Pulpitis</title> -->
  </head>
  <body>
    <!-- Navabr -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">CF Pulpitis</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <?php include 'menu.php' ?>

              <!-- Cek apakah admin sudah login -->
            <?php if(isset($_SESSION['username']) && isset($_SESSION['password'])) : ?>
              <div class="dropdown">
                <a <?php if($page == 'admin' || $page == 'password' || $page == 'logout') echo 'class="nav-link active"'; ?>  class="nav-link" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['username'] ?> </a>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" <?php if ($page == 'admin') ?> href="admin">Daftar Admin</a></li>
                  <li><a class="dropdown-item" <?php if ($page == 'password') ?> href="password">Ubah Pasword</a></li>
                  <li><a class="dropdown-item" <?php if ($page == 'logout') ?> href="logout.php">Logout</a></li>
                </ul>
              </div>

              <!-- Jika tidak tampilkan menu login -->
            <?php else : ?>
              <li class='nav-item'>
                <a <?php if ($page == 'formlogin') echo 'class="nav-link active"' ?> class='nav-link' aria-current='page' href='formlogin'>Login</a>
              </li>
            <?php endif ?>                   
          </ul>
        </div>
      </div>
    </nav>


    <!-- End Navbar -->





    
    <!-- Konten -->
    <div class="container mt-4">
      <!-- <h2>Halaman Sesuai</h2> -->
        <?php include "content.php" ?>
    </div>
    <!-- End Konten -->







    <!-- Footer -->
    <footer class="footer mt-4 py-3 bg-secondary text-white">
      <div class="container">
        <span class="text">CF-Pulpitis 2020</span>
      </div>
    </footer>

    <!-- Footer -->

    <script src="aset/bootstrap.min.js"></script>
  </body>
</html>
