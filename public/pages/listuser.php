<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/post.php");

if(isset($session)){
    $logged = $session->user_loggedin();
    if(!$logged){
        redirect_to("/pages/login.php");
    }
}
$users = User::alluser();

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layouts/head.php")?>

  <body>

    <?php require_once("../layouts/nav.php")?>

    <main role="main" class="container">

        <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">List User</h1>

        <hr class="mt-2 mb-5">

        <div class="row text-center text-lg-left">

            <?php foreach ($users as $user){ ?>

                <div class="col-lg-3 col-md-4 col-6">
                    <a href="/index.php?visiteduid=<?php echo $user['id']; ?>" class="d-block mb-4 h-100">
                        <img class="img-fluid img-thumbnail" src="../images/<?php echo $user['photo']; ?>" alt="">
                        <div><center><?php echo $user['nama']; ?></center></div>
                    </a>
                </div>

            <?php } ?>

        </div>

    </main><!-- /.container -->

    <?php require_once("../layouts/footer.php")?>

  </body>
</html>