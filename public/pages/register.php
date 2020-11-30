<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");

$photo_ok = false;
$photo = "";
if(isset($_POST['save'])){
    $user = new User;
    $file = $_FILES['photo']['name'];
    //check file type & file size
    if(!empty($file)){
      $type = $_FILES['photo']['type'];
      $photo_ok = typeGambar($type);
      $size = $_FILES['photo']['size'];
      if($photo_ok && ($size<=2000000)){
        $photo = create_image("photo");
      }
    }
    $user->nama = $_POST['nama'];
    $user->namabelakang = $_POST['namabelakang'];
    $user->photo = $photo;
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $hasil = $user->create();

    if($hasil){
        $session->login($hasil);
        $session->nama($user->nama);
        $pesan = "Hi, " . $user->nama . " Welcome";
        redirect_to("/");
    }else{
        redirect_to("/pages/register.php");
    }
}

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layouts/head.php")?>

  <body>

    <?php require_once("../layouts/nav.php")?>

    <main role="main" class="container">

        <form class="form-horizontal" action="register.php" method="POST" enctype="multipart/form-data">
            <fieldset>

            <!-- Form Name -->
            <legend>Register Yourself</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="nama">Nama</label>  
                <div class="col-md-4">
                    <input id="nama" name="nama" type="text" placeholder="John" class="form-control input-md" required=""> 
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="nama">Nama Belakang</label>  
                <div class="col-md-4">
                    <input id="namabelakang" name="namabelakang" type="text" placeholder="Doe" class="form-control input-md" required=""> 
                </div>
            </div>

            <!-- File input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Photo</label>  
                <div class="col-md-4">
                    <input id="photo" name="photo" type="file" class="form-control input-md" required="">               
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Email</label>  
                <div class="col-md-4">
                    <input id="email" name="email" type="email" placeholder="johndoe@example.com" class="form-control input-md" required="">               
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Password</label>
                <div class="col-md-4">
                    <input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">               
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="save"></label>
                <div class="col-md-8">
                    <button id="save" name="save" class="btn btn-success">Register</button>
                </div>
            </div>

            </fieldset>
        </form>

    </main><!-- /.container -->

    <?php require_once("../layouts/footer.php")?>

  </body>
</html>