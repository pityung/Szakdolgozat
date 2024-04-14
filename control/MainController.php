<?php
require "../model/cart.php";
require "../model/propertie.php";
require "../model/session.php";
require "../model/shopProducts.php";
require "../model/user.php";
require "../helpers/stringHelper.php";
require "../model/files.php";

$msg = '';
$Propertie = new Propertie();
$StringHelper = new StringHelper();
$User = new User();
$shopProducts = new shopProducts();
$cart = new cart();
$Session = new session();
$dir    = '../uploads';
$uploadFiles = scandir($dir);
$majorCategorie = $shopProducts->getMajorCategories();
$Categories_SubCategories = $shopProducts->getCategories_SubCategories();
$SubCategories = $shopProducts->getSubCategories();
$allProducts = $shopProducts->getProducts();
$productPrices = $shopProducts->getProductsPrices();
$productNames = $shopProducts->getProductNames();
$properties = $Propertie->getPropertie();
$productid = $shopProducts->getProductIds();
$productQuantities = $shopProducts->getProductQuantities();


if (isset($_SESSION["isLoginedIn"])) {
    $sessionId = $Session->getSessionId();
    $isCartEmpty = $cart->cartIsEmpty($sessionId);
    $userCartItemes = $cart->getUserCartItems($sessionId);
    $userCartItemesPrices = $cart->getUserCartItemsPirces($sessionId);
    $userCartitmesId = $cart->getuserCartitmesId($sessionId);
    $userCartProductId = $cart->getuserCartProductId($sessionId);
}
if (isset($_POST['password']) and isset($_POST['username']) and isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['email']) and isset($_POST['phone'])) {
    //$nev = StringHelper::safe_input($_POST['username']);
    $msg = $StringHelper->checkName($msg);
    $msg = $User->checkUsers($msg);

    if ($msg == '') {
        $User->registerUser();
        $Session->registerShoppingSession();
        $msg = $User->checkLogin($msg);
        $sessionId = $Session->getSessionId();
    }
} else
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
} else if (isset($_POST['first_name_edit']) and isset($_POST['last_name_edit']) and isset($_POST['phone_edit'])  and isset($_POST['email_edit'])) {
    $msg = $StringHelper->checkUpdate($msg);
    $msg = $User->checkUsers($msg);
    if ($msg == '') {
        $msg = $User->updateUser($msg);
    }
} else
if (isset($_POST['address_line']) and isset($_POST['city']) and isset($_POST['postal_code']) and isset($_POST['country'])) {
    if ($msg == '') {
        $User->registerUserAddress();
    }
} else if (!empty($_FILES["fileToUpload"]) and isset($_POST['productName']) and isset($_POST['description']) and isset($_POST['description'])) {
    $filemanager = new Filemanager;
    $msg = $filemanager->fileUpload($msg);
    $msg = $shopProducts->checkUploadedProducts();
    if ($msg == '') {
        $shopProducts->uploadProduct();
    } else {
        $shopProducts->updateProduct();
    }
} else {
    for ($i = 1; $i <  count($allProducts); $i++) {
        if (isset($_POST["btnDelete" . "_" . $i])) { 
            $cart->removeDeletedProductFromAllCart(str_replace($allProducts[$i]."_" , "", $productid[$i]));
            $shopProducts->deleteProductFromDatabase(str_replace($allProducts[$i]."_" , "", $productid[$i]));
        } else {
            if (isset($_POST["btnBuy" . "_" . $i])) {
                $shopProducts->moveProductToCart($_POST["btnBuy" . "_" . $i], $sessionId);
            }
        }
    }
}

if (isset($_SESSION['unsignedProduct'])) {
    if (isset($sessionId)) {
        $shopProducts->moveProductToCart($_SESSION['unsignedProduct'], $sessionId);
        unset($_SESSION['unsignedProduct']);
    }
}
if (isset($userCartItemes)) {
    for ($i = 2; $i <  count($userCartItemes); $i++) {
        if (isset($_POST["btnRemoveFromCart" . "_" . $i])) {
            $cart->removeFromCart($_POST["btnRemoveFromCart" . "_" . $i]);
        }
    }
}
if (isset($_POST['buyCartProducts'])) {
    $isCartEmpty = $cart->cartIsEmpty($sessionId);
    if (!$isCartEmpty) {
        $Session->createOrderSession();
        for ($i = 2; $i < count($userCartProductId); $i++) {
            $Session->createOrder($userCartProductId[$i], $userCartItemesPrices[$i]);
            $deceasableProductQuantity = $shopProducts->getDecreasableProductQuantity($userCartProductId[$i]);
            $shopProducts->decreaseProductQuantity($userCartProductId[$i], $deceasableProductQuantity);
        }
        $cart->deletEverythingFromCart($sessionId);
    } else {
        $msg .= "Your cart is Empty!";
    }
}

