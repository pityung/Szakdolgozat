<?php
require "../model/cart.php";
require "../model/propertie.php";
require "../model/session.php";
require "../model/shopProducts.php";
require "../model/files.php";

$msg = '';
$Propertie = new Propertie();
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
}

if (!empty($_FILES["fileToUpload"]) and isset($_POST['productName']) and isset($_POST['description']) and isset($_POST['description'])) {
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


