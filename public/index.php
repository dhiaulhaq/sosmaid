<?php
require_once("../includes/database.php");
// require_once("../includes/user.php");
// require_once("../includes/helper.php");
// require_once("../includes/session.php");

// $logged = false;
// $nama = "";

// if(isset($session)){
//   $logged = $session->user_loggedin();
//   $nama = $session->nama();
// }

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("layouts/head.php")?>

  <body>

    <?php require_once("layouts/nav.php")?>

    <main role="main" class="container">
    
    <?php if(!$logged){ ?>
      <div class="starter-template">
        <h1>Sosmaid - Aplikasi Sosial Media</h1>
        <p class="lead">Anda tidak terdaftar sebagai pengguna, silahkan Register atau Login untuk dapat menggunakan aplikasi.</p>
      </div>
    <?php }else{ ?>
      <div class="starter-template">
        <h1>Sosmaid - Aplikasi Sosial Media</h1>
        <p class="lead">Anda terdaftar sebagai: <?php echo $nama; ?>, silahkan akses menu Keuangan untuk menggunakan aplikasi.</p>
      </div>
    <?php } ?>

    </main><!-- /.container -->

    <?php require_once("layouts/footer.php")?>

  </body>
</html>