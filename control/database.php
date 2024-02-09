
<?php

require "../model/database.php";
require "../helpers/stringHelper.php";

$user_table = new userTable();  

$msg = '';
if (isset($_POST['password']) and isset($_POST['username']) and isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['email']) and isset($_POST['phone'])) {

    $nev = StringHelper::safe_input($_POST['username']);
    $msg = StringHelper::checkName($nev, $msg);
    $msg = $user_table->checkUsers($msg);

    if ($msg == '') {
        $msg = $user_table->registerUser();
    }
}else
if(isset($_POST['username']) and isset($_POST['password'])) {
    if(empty($_POST['username'])) $msg .= "The username is not set.";
    if(empty($_POST['password'])) $msg .= "The password is not set. ";
    if(!$msg) {
        $msg = $user_table->checkLogin($msg);
    }
}

?>