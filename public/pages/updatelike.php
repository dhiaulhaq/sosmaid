<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/like.php");

$total = 0;
$like = new Like;

if(!empty($_POST['post_id'])){
    $like->post_id = $_POST['post_id'];
    $like->user_id = $_POST['uid'];
    $postliked = $like->postliked();
    if($postliked){
        $like->hapus();
        $hearticon = '<i class="far fa-heart"></i>';
    }else{
        $like->create();
        $hearticon = '<i class="fas fa-heart"></i>';
    }
    $total = $like->totallike($like->post_id);
    $response = array(
        'total' => $total,
        'hearticon' => $hearticon
    );
    echo json_encode($response);
}

?>