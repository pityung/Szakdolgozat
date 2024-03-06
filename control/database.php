
<?php

require "../model/database.php";
require "../helpers/stringHelper.php";
require "../model/files.php";

$user_table = new userTable();
$StringHelper = new StringHelper();

$msg = '';
if (isset($_POST['password']) and isset($_POST['username']) and isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['email']) and isset($_POST['phone'])) {

    //$nev = StringHelper::safe_input($_POST['username']);
    $msg = $StringHelper->checkName($msg);

    $msg = $user_table->checkUsers($msg);

    if ($msg == '') {
        $msg = $user_table->registerUser();
        $msg = $user_table->checkLogin($msg);
    }
} else
if (isset($_POST['username']) and isset($_POST['password'])) {
    if (empty($_POST['username'])) $msg .= "The username is not set.";
    if (empty($_POST['password'])) $msg .= "The password is not set. ";
    if (!$msg) {
        $msg = $user_table->checkLogin($msg);
    }
    if (!$msg) {
        $msg = $user_table->addressIsSet();
    }
} else

if (isset($_POST['address_line']) and isset($_POST['city']) and isset($_POST['postal_code']) and isset($_POST['country'])) {
    if ($msg == '') {
        $msg = $user_table->registerUserAddress();
    }
} else if (!empty($_FILES["fileToUpload"])) {
    $filemanager = new Filemanager;
    $msg = $filemanager->fileUpload($msg);
}
$majorCategorie = $user_table->getMajorCategories();
$Categories_SubCategories = $user_table->getCategories_SubCategories();
$SubCategories = $user_table->getSubCategories();

if(isset($_POST['btnDelete'])){
    
}

?>