<?php
require_once("../includes/database.php");
require_once("../includes/user.php");
require_once("../includes/session.php");
require_once("../includes/helper.php");
require_once("../includes/post.php");
require_once("../includes/like.php");
require_once("../includes/comment.php");

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
$like = new Like;
$comment = new Comment;

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("layouts/head.php")?>

  <body>

    <?php require_once("layouts/nav.php")?>
    
    <header>

      <div class="container">

        <div class="row">
          <div id="pesan" class="col"></div>
        </div>

        <div class="profile">

          <div class="profile-image">

            <img src="/images/<?php echo $user['photo']; ?>" alt="">

          </div>

          <div class="profile-user-settings">

            <h1 class="profile-user-name"><?php echo $fname; ?>_</h1>

            <?php if($visiteduid == $logged) {?>
              <button class="btn profile-edit-btn" data-toggle="modal" data-target="#exampleModal">Ganti Password</button>
            <?php } ?>
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

      <div class="container">

        <div class="gallery">

          <?php foreach($userposts as $post){ ?>

            <a href="/pages/detailpost.php?pid=<?php echo $post['id']; ?>">

              <div class="gallery-item" tabindex="0">

                <img src="/images/<?php echo $post['photo']; ?>" class="gallery-image" alt="">

                <div class="gallery-item-info">

                  <ul>
                    <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i><?php echo $like->totallike($post['id']); ?></li>
                    <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i><?php echo $comment->totalcomment($post['id']); ?></li>
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

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="newpassword">New Password</label>
                <input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="New Password">
              </div>
              <div class="form-group">
                <label for="confirmpassword">Confrim Password</label>
                <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Confirm Password">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="savepassword" data-dismiss="modal">Save changes</button>
            </div>
          </div>
        </div>
      </div>

    <?php require_once("layouts/footer.php")?>

  </body>
  
</html>