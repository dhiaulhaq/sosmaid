<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/post.php");

$photo_ok = false;
$photo = "";
$logged = 0;

if(isset($session)){
    $logged = $session->user_loggedin();
    if(!$logged){
        redirect_to("/pages/login.php");
    }
}

if(isset($_POST['save'])){
    $post = new Post;
    $post->user_id = $logged;
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
    $post->keterangan = $_POST['keterangan'];
    $post->photo = $photo;
    $hasil = $post->create();

    if($hasil){
        $pesan = "Postingan berhasil ditambahkan";
        redirect_to("/");
    }else{
        redirect_to("/pages/newpost.php");
    }
}

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layouts/head.php")?>

  <body>

    <?php require_once("../layouts/nav.php")?>

    <main role="main" class="container">

        <form class="form-horizontal" action="newpost.php" method="POST" enctype="multipart/form-data">
            <fieldset>

            <!-- Form Name -->
            <legend>Register Yourself</legend>

            <!-- File input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Photo</label>  
                <div class="col-md-4">
                    <input id="photo" name="photo" type="file" class="form-control input-md" required="">               
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="keterangan">Keterangan</label>  
                <div class="col-md-4">
                    <textarea id="keterangan" name="keterangan" class="form-control input-md"></textarea>
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="save"></label>
                <div class="col-md-8">
                    <button id="save" name="save" class="btn btn-success">Simpan</button>
                </div>
            </div>

            </fieldset>
        </form>

    </main><!-- /.container -->

    <?php require_once("../layouts/footer.php")?>

  </body>
</html>