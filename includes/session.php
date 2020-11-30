<?php

class Session{
    public $pesan = "";
    private $loggedin = false;
    public $uid;
    public $nama;

    function __construct(){
        session_start();
        $this->cek_nama();
        $this->cek_pesan();
        $this->periksa_login();
    }

    //Check Auth
    private function periksa_login(){
        if(isset($_SESSION['uid'])){
            $this->uid = $_SESSION['uid'];
            $this->loggedin = $this->uid;
        }else{
            unset($this->uid);
            $this->loggedin = false;
        }
    }

    //Save UID Session
    public function login($uid){
        if($uid){
            $this->uid = $_SESSION['uid'] = $uid;
            $this->loggedin = true;
        }
    }

    //Loggedin Interface
    public function user_loggedin(){
        return $this->loggedin;
    }

    //Check Username
    private function cek_nama(){
        if(isset($_SESSION['nama'])){
            $this->nama = $_SESSION['nama'];
            // unset($_SESSION['nama']);
        }else{
            $this->nama ="";
        }
    }

    //Saving Username Session (Interface)
    public function nama($username = ""){
        if(!empty($username)){
            $_SESSION['nama'] = $username;
        }else{
            return $this->nama;
        }
    }

    //Check Message
    public function cek_pesan(){
        if(isset($_SESSION['pesan'])){
            $this->pesan = $_SESSION['pesan'];
            unset($_SESSION['pesan']);
        }else{
            $this->nama = "";
        }
    }

    //Message
    public function pesan($txt = ""){
        if(!empty($txt)){
            $_SESSION['pesan'] = $txt;
        }else{
            return $this->pesan;
        }
    }

    //Logout
    public function logout(){
        unset($_SESSION['uid']);
        unset($_SESSION['nama']);
        unset($this->uid);
        $this->loggedin = false;
    }

}

$session = new Session;
$pesan = $session->pesan();
$nama = $session->nama();

?>