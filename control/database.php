<?php
require "../model/database.php";
require "../helpers/stringHelper.php";
require "../model/files.php";
$msg = '';
$user_table = new userTable();
$StringHelper = new StringHelper();
$dir    = '../uploads';
$uploadFiles = scandir($dir);
$majorCategorie = $user_table->getMajorCategories();
$Categories_SubCategories = $user_table->getCategories_SubCategories();
$SubCategories = $user_table->getSubCategories();
$productDatas = $user_table->getProductDatas();
$properties = $user_table->getPropertie();


if(isset( $_SESSION["isLoginedIn"])){
$sessionId = $user_table->getSessionId();
$userCartItemes = $user_table->getUserCartItems($sessionId);
$userCartItemesPrices = $user_table->getUserCartItemsPirces($sessionId);
}
if (isset($_POST['password']) and isset($_POST['username']) and isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['email']) and isset($_POST['phone'])) {
    //$nev = StringHelper::safe_input($_POST['username']);
    $msg = $StringHelper->checkName($msg);
    $msg = $user_table->checkUsers($msg);

    if ($msg == '') {
        $msg = $user_table->registerUser();
        $msg = $user_table->registerShoppingSession();
        $msg = $user_table->checkLogin($msg);
        $sessionId = $user_table->getSessionId();
        
}
} else
if (isset($_POST['username']) and isset($_POST['password'])) {
    if (empty($_POST['username'])) $msg .= "The username is not set.";
    if (empty($_POST['password'])) $msg .= "The password is not set. ";
    if (!$msg) {
        $msg = $user_table->checkLogin($msg);
        if(!$msg){
        $sessionId = $user_table->getSessionId();
        }
    }
    if (!$msg) {
        $msg = $user_table->addressIsSet();
    }
} else if (isset($_POST['username_edit']) and isset($_POST['first_name_edit']) and isset($_POST['last_name_edit']) and isset($_POST['phone_edit'])  and isset($_POST['email_edit'])) {
    $msg = $StringHelper->checkUpdate($msg);
    $msg = $user_table->checkUsers($msg);
    if ($msg == '') {
        $msg = $user_table->updateUser($msg);
    }
} else
if (isset($_POST['address_line']) and isset($_POST['city']) and isset($_POST['postal_code']) and isset($_POST['country'])) {
    if ($msg == '') {
        $msg = $user_table->registerUserAddress();
    }
} else if (!empty($_FILES["fileToUpload"]) and isset($_POST['productName']) and isset($_POST['description']) and isset($_POST['description'])) {
    $filemanager = new Filemanager;
    $msg = $filemanager->fileUpload($msg);
    $msg = $user_table->checkUploadedProducts();
    if($msg==''){
    $msg = $user_table->uploadProduct();
    }else{
        $msg = $user_table->updateProduct();
    }
} else {
    for ($i = 2; $i <  count($uploadFiles); $i++) {
        if (isset($_POST["btnDelete" . "_" . $i])) {
            $msg = $user_table->removeDeletedProductFromAllCart($_POST["btnDelete" . "_" . $i]);
            $msg = $user_table->deleteProductFromDatabase($_POST["btnDelete" . "_" . $i]);
        }else{
            if (isset($_POST["btnBuy" . "_" . $i])) {
                $msg = $user_table->moveProductToCart($_POST["btnBuy" . "_" . $i],$sessionId);
            }
        }
    }
}

if(isset($_SESSION['unsignedProduct'])){
    if(isset($sessionId)){
        $msg = $user_table->moveProductToCart($_SESSION['unsignedProduct'],$sessionId);
        unset($_SESSION['unsignedProduct']);
    }
}
