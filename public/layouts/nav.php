<?php
$logged = false;
$nama = "";
if(isset($session)){
  $logged = $session->user_loggedin();
  $nama = $session->nama();
}
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="/">Sosmaid</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Post</a>
          </li>
          
        </ul>
        <ul class="navbar-nav">

          <?php if(!$logged){ ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Register</a>
          </li>
          <?php }?>

          <?php if($logged){ ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Hi <?php echo $nama; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pages/logout.php">Logout</a>
          </li>
          <?php }?>

        </ul>
      </div>
    </nav>