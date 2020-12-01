<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");

if(isset($_POST['save'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $loginuid = User::authenticate($email, $password);
    if($loginuid){
        $user = User::cari_dgn_id($loginuid);
        $session->login($loginuid);
        $session->nama($user['nama']);
        $pesan = "Welcome back " . $user['nama'];
        $session->pesan($pesan);
        redirect_to("/");
    }else{
        $pesan = "Email atau password salah, ulangi lagi";
        $session->pesan($pesan);
        redirect_to("/pages/login.php");
    }
}

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layouts/head.php")?>

  <body>

    <?php require_once("../layouts/nav.php")?>

    <main role="main" class="container">

        <form class="col-md-6 offset-md-3" action="login.php" method="POST">
            <h3 class="title">Please sign in</h3>
            <hr class="divisor">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" name="save" class="btn btn-primary topBtn"><i class="fa fa-sign-in"></i> Sign in</button>
        </form>

    </main><!-- /.container -->

    <?php require_once("../layouts/footer.php")?>

  </body>
</html>