<?php
require_once("../includes/database.php");
require_once("../includes/user.php");
require_once("../includes/session.php");
require_once("../includes/helper.php");
require_once("../includes/post.php");

$fname = "";
$visiteduid = 0;
if(isset($session)){
  $logged = $session->user_loggedin();
  if(!$logged){
    redirect_to("/pages/login.php");
  }else{
    if(isset($_GET['visiteduid'])){
      $visiteduid = $_GET['visiteduid'];
    }else{
      $visiteduid = $logged;
    }
    $user = User::cari_dgn_id($visiteduid);
    $nama = $user['nama'];
    $namabelakang = $user['namabelakang'];
    $fname = $nama . ' ' . $namabelakang;
  }
}

$post = new Post;
$userposts = $post->cari_userpost($visiteduid);

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("layouts/head.php")?>

  <body>

    <?php require_once("layouts/nav.php")?>

    <main role="main" class="container">
    
    <header>

      <div class="container">

        <div class="profile">

          <div class="profile-image">

            <img src="/images/<?php echo $user['photo']; ?>" alt="">

          </div>

          <div class="profile-user-settings">

            <h1 class="profile-user-name"><?php echo $fname; ?>_</h1>

            <button class="btn profile-edit-btn">Edit Profile</button>

            <button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>

          </div>

          <div class="profile-stats">

            <ul>
              <li><span class="profile-stat-count">164</span> posts</li>
              <li><span class="profile-stat-count">188</span> followers</li>
              <li><span class="profile-stat-count">206</span> following</li>
            </ul>

          </div>

          <div class="profile-bio">

            <p><span class="profile-real-name">Jane Doe</span> Lorem ipsum dolor sit, amet consectetur adipisicing elit 📷✈️🏕️</p>

          </div>

        </div>
        <!-- End of profile section -->

      </div>
      <!-- End of container -->

      </header>

      <main>

      <div class="container">

        <div class="gallery">

          <?php foreach($userposts as $post){ ?>

            <a href="/pages/detailpost.php?pid=<?php echo $post['id']; ?>">

              <div class="gallery-item" tabindex="0">

                <img src="/images/<?php echo $post['photo']; ?>" class="gallery-image" alt="">

                <div class="gallery-item-info">

                  <ul>
                    <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 56</li>
                    <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
                  </ul>

                </div>

              </div>

            </a>

          <?php } ?>

        </div>
        <!-- End of gallery -->

        <div class="loader"></div>

      </div>
      <!-- End of container -->

      </main>

    </main><!-- /.container -->

    <?php require_once("layouts/footer.php")?>

  </body>
</html>