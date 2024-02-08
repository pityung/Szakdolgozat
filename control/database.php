
<?php

require "../model/database.php";

$user_table = new userTable();  

$msg = '';

if(isset($_POST['username']) and isset($_POST['password'])and !isset($_POST['email'])) {
    if(empty($_POST['username'])) $msg .= "The username is not set.";
    if(empty($_POST['password'])) $msg .= "The password is not set. ";
    if(!$msg) {
        $msg = $user_table->checkLogin($msg);
    }
}
elseif(isset($_POST['username']) and isset($_SESSION['password'])and isset($_POST['email'])) {

    $nev = StringHelper::safe_input($_POST['username']);

    $msg = StringHelper::checkName($nev, $msg);

    if ($msg == '') {
        $msg = $osztaly->registerUser();
    }
}
?>