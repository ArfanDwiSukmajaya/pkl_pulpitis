<?php

if($page == ""){
  include "pages/beranda.php";
}
// Untuk umum
else if($page == "diagnosa"){
  include "pages/diagnosa/diagnosa.php";
}
else if($page == "tentang"){
  include "pages/tentang/tentang.php";
}
else if($page == "pakar"){
  include "pages/admin/login.php";
}


// Untuk admin
else if($page == "admin"){
  include "pages/admin/admin.php";
}
else if($page == "penyakit"){
  include "pages/penyakit/penyakit.php";
}
else if($page == "gejala"){
  include "pages/gejala/gejala.php";
}
else if($page == 'tambahgejala'){
  include "pages/gejala/tambahgejala.php";
}

else if($page == "pengetahuan"){
  include "pages/pengetahuan/pengetahuan.php";
}
else if($page == "password"){
  include "pages/password/password.php";
}
else if($page == "riwayat"){
  include "pages/riwayat/riwayat.php";
}
else if($page == "formlogin"){
  include "pages/formlogin.php";
}