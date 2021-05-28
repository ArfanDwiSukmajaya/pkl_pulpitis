<?php
session_start();
include "config/koneksi.php";

if(isset($_POST["login"])){

  $user=$_POST['username'];
  $pass=md5($_POST['password']);

  $login=mysqli_query($conn,"select * from admin where username='$user' and password='$pass'");

  $ketemu=mysqli_num_rows($login);
  $r=mysqli_fetch_array($login);
  if ($ketemu>0) {
    $_SESSION['username'] = $r['username'];
    $_SESSION['password'] = $r['password'];
    $_SESSION['nama_lengkap'] = $r['nama_lengkap'];
    header("location: ./");
  }else{
    $error = true;
  }
}
?>

<title>Form Login</title>

  
<div class="row justify-content-center">
<div class="col-md-4 col-lg-5 container my-5 shadow-lg p-4 p-md-5">
  
  <?php if(isset($error)) : ?>
    <div class="alert alert-danger" role="alert">
      Username / Password Salah
    </div>
  <?php endif; ?>

  <h3 class="text-center mb-4">Login Admin</h3> 
  <form action="" method="post" name="text_form" class="login-form">
  <div class="form-group">
    <input type="text"  name="username" id="username" class="form-control rounded-left mb-3" placeholder="Username" required>
  </div>
  <div class="form-group d-flex">
    <input type="password" name="password" id="password" class="form-control rounded-left mb-4" placeholder="Password" required>
  </div>
  <div class="form-group d-md-flex">
    <div class="form-group">
      <button type="submit" class="btn btn-primary rounded" name="login">Login</button>
    </div>
  </div>
  </form>
</div>
</div>
</div>
</div>