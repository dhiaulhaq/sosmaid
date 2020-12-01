<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/post.php");
require_once("../../includes/like.php");

if(isset($session)){
    $logged = $session->user_loggedin();
    if(!$logged){
        redirect_to("/pages/login.php");
    }
}

$hearticon = '<i class="far fa-heart"></i>';
$total = 0;
$post_id = $_GET['pid'];
$post = Post::cari_dgn_id($post_id);
$like = new Like;
$like->post_id = $post_id;
$like->user_id = $logged;
$total = $like->totallike($post_id);
$postliked = $like->postliked();
if($postliked){
    $hearticon = '<i class="fas fa-heart"></i>';
}

$user = new User;

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layouts/head.php")?>

  <body>

    <?php require_once("../layouts/nav.php")?>

    <main role="main" class="container">

        <div class="row">
            <input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id; ?>" />
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $logged; ?>" />
            <div class="col-md-6 offset-md-3">
                <img src="/../images/<?php echo $post['photo']; ?>" class="gallery-image"/>
            </div>
            <div class="col-md-6 offset-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <p><?php echo $post['keterangan']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="loader"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <span id="btnlike"><?php echo $hearticon; ?></span>
                        <span class="totallike"><?php echo $total; ?></span>
                    </div>
                    <div class="col-md-6">
                        <div class="float-right">
                            <span class="commenticon"><i class="far fa-comments"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Comment Start -->
                        <div class="detailBox">
                            <div class="titleBox">
                            <label>Comment Box</label>
                                <button type="button" class="close" aria-hidden="true">&times;</button>
                            </div>
                            <div class="commentBox">
                                
                                <p class="taskDescription">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="actionBox">
                                <ul class="commentList">
                                    <li>
                                        <div class="commenterImage">
                                        <img src="http://placekitten.com/50/50" />
                                        </div>
                                        <div class="commentText">
                                            <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                                        </div>
                                    </li>
                                    <li>
                                        <div class="commenterImage">
                                        <img src="http://placekitten.com/45/45" />
                                        </div>
                                        <div class="commentText">
                                            <p class="">Hello this is a test comment and this comment is particularly very long and it goes on and on and on.</p> <span class="date sub-text">on March 5th, 2014</span>

                                        </div>
                                    </li>
                                    <li>
                                        <div class="commenterImage">
                                        <img src="http://placekitten.com/40/40" />
                                        </div>
                                        <div class="commentText">
                                            <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                                        </div>
                                    </li>
                                </ul>
                                <form class="form-inline" role="form">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Your comments" />
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-default">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Comment End -->
                    </div>
                </div>
            </div>
        </div>

    </main><!-- /.container -->

    <?php require_once("../layouts/footer.php")?>

  </body>
</html>