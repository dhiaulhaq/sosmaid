<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/comment.php");

$total = 0;
$comment = new Comment;

if(!empty($_POST['post_id'])){
    $comment->post_id = $_POST['post_id'];
    $comment->user_id = $_POST['uid'];
    $comment->comment = $_POST['comment'];
    $comment->create();
    $postcomments = $comment->cari_dgn_id();
    $user = new User;
    $total = $comment->totalcomment($comment->post_id);
    $allcomment = "";
    foreach ($postcomments as $pc){
        $visiteduid = $pc['user_id'];
        $com = $pc['comment'];
        $photo = $user->userphoto($pc['user_id']);
        $created_at = $pc['created_at'];
        $allcomment .= "<li>";
        $allcomment .= "<div class='commenterImage'>";
        $allcomment .= "<a href='/index.php?visiteduid={$visiteduid}' >";
        $allcomment .= "<img src='../images/{photo}' />";
        $allcomment .= "</div>";
        $allcomment .= "<div class='commentText'>";
        $allcomment .= "<p>{$com}</p> <span class='date sub-text'>{$created_at}</span>";
        $allcomment .= "</div>";
        $allcomment .= "</li>";
    }
    $response = array(
        'total' => $total,
        'hearticon' => $hearticon
    );
    echo json_encode($response);
}

?>