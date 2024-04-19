<?php
require "../model/user.php";
require "../helpers/stringHelper.php";
require "../model/session.php";
require "../model/shopProducts.php";

$User = new User();
$StringHelper = new StringHelper();
$Session = new session();
$shopProducts = new shopProducts();

$msg = '';

if (isset($_POST['password']) and isset($_POST['username']) and isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['email']) and isset($_POST['phone'])) {
    $nev = StringHelper::safe_input($_POST['username']);
    $msg = $StringHelper->checkName($msg);
    $msg = $User->checkUsers($msg);
    if ($msg == '') {
        $User->registerUser();
        $Session->registerShoppingSession();
        $msg = $User->checkLogin($msg);
        $sessionId = $Session->getSessionId();
    }
}
if (isset($_POST['username']) and isset($_POST['password'])) {
    if (empty($_POST['username'])) $msg .= "The username is not set.";
    if (empty($_POST['password'])) $msg .= "The password is not set. ";
    if (!$msg) {
        $msg = $User->checkLogin($msg);
        if (!$msg) {
            $sessionId = $Session->getSessionId();
        }
    }
    if (!$msg) {
        $User->addressIsSet();
    }
}
if (isset($_POST['first_name_edit']) and isset($_POST['last_name_edit']) and isset($_POST['phone_edit'])  and isset($_POST['email_edit'])) {
    $msg = $StringHelper->checkUpdate($msg);
    $msg = $User->checkUsers($msg);
    if ($msg == '') {
        $msg = $User->updateUser($msg);
    }
}
if (isset($_POST['address_line']) and isset($_POST['city']) and isset($_POST['postal_code']) and isset($_POST['country'])) {
    if ($msg == '') {
        $User->registerUserAddress();
    }
}
if (isset($sessionId)) {
   
if (isset($_SESSION['unsignedProduct'])) {
        
        $shopProducts->moveProductToCart($_SESSION['unsignedProduct'], $sessionId);
        unset($_SESSION['unsignedProduct']);
    }
    
}
