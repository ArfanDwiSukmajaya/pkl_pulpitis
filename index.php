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
    <base href="http://localhost/pulpitis/">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="aset/bootstrap.min.css" />
    <link href="aset/font-awesome-4.2.0/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="icon" href="gambar/favicon.png">
    <style>
      a{
        text-decoration:none;
      }

      footer{
        width:100%;
        bottom: 0;
      }
      .content{
        min-height:76vh;
      }
    </style>
    <!-- <title>Pulpitis</title> -->

  </head>
  <body class="d-flex flex-column min-vh-100">
    <!-- Navabr -->
    
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow p-3">
      <div class="container">
        <a class="navbar-brand" href="./">
        <img src="gambar/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
        CF Pulpitis
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <?php include 'menu.php' ?>

              <!-- Cek apakah admin sudah login -->
            <?php if(isset($_SESSION['username']) && isset($_SESSION['password'])) : ?>
              <div class="dropdown">
                <a <?php if($page == 'admin' || $page == 'password' || $page == 'logout') echo 'class="dropdown-toggle nav-link active"';  ?>   class="dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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
    <div class="container mt-4 content">
      <!-- <h2>Halaman Sesuai</h2> -->
      <?php if(isset($_SESSION['username']) && isset($_SESSION['password']) && !$page == "")  : ?>
      <nav aria-label='breadcrumb ms-auto float-right'>
        <ol class='breadcrumb'>
          <li class='breadcrumb-item'><a href='./'>Home</a></li>
          <li class='breadcrumb-item active' aria-current='page'><?= $page ?></li>
        </ol>
      </nav>
      <?php endif ?>
        <?php include "content.php" ?>
    </div>
    <!-- End Konten -->

    <!-- Footer -->
    
    <footer class="py-3 bg-light shadow-lg p-3">
      <div class="container text-dark text-center">
        Copyright © 2021 - Made by 
        <a href="#" target="_blank">Arfan</a> &
        <a href="#" target="_blank">Nanda</a>
      </div>
    </footer>

    <!-- Footer -->

    <script src="aset/bootstrap.min.js"></script>
    
  </body>
</html>
