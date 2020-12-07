<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/session.php");

$logged = 0;
if(isset($session)){
    $logged = $session->user_loggedin();
}

$user = new User;
if(!empty($_POST['newpass'])){
    $user->id = $logged;
    $user->password = $_POST['newpass'];
    $user->gantipassword();
    $response = array(
        "pesan" => "<div class='alert alert-success' role='alert'>Password berhasil diubah.</div>"
    );
    echo json_encode($response);
}

?>