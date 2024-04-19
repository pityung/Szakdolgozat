<?php 
require "../model/appModell.php";
require "../model/shopProducts.php";
require "../model/propertie.php";
require "../model/session.php";

$app = new appProducts();
$products = new shopProducts();
$Session = new session();
$Propertie = new Propertie();
$properties = $Propertie->getPropertie();
$allProducts = $products->getProducts();


if (isset($_SESSION["isLoginedIn"])) {
    $sessionId = $Session->getSessionId();
}
if(isset($_POST['gender']) and isset($_POST['Riding_style_menu']) and $_POST['color_menu'] != "None")
{
    $selectedCartItem = $app->getselectedCartItemByColor($_POST['gender'], $_POST['Riding_style_menu'], $_POST['color_menu']);
    $selectedCartItemPrices = $app->getselectedCartItemPricesByColor($_POST['gender'], $_POST['Riding_style_menu'], $_POST['color_menu']);
    $selectedCartItemId = $app->getselectedCartItemIdByColor($_POST['gender'], $_POST['Riding_style_menu'], $_POST['color_menu']); 
    $selectedCartItemQuantity = $app->getselectedCartItemQuantityByColor($_POST['gender'], $_POST['Riding_style_menu'], $_POST['color_menu']); 
}else if(isset($_POST['gender']) and isset($_POST['Riding_style_menu']) and $_POST['color_menu'] == "None")
{
    $selectedCartItem = $app->getselectedCartItem($_POST['gender'], $_POST['Riding_style_menu']);
    $selectedCartItemPrices = $app->getselectedCartItemPrices($_POST['gender'], $_POST['Riding_style_menu']);
    $selectedCartItemId = $app->getselectedCartItemId($_POST['gender'], $_POST['Riding_style_menu']); 
    $selectedCartItemQuantity = $app->getselectedCartItemQuantity($_POST['gender'], $_POST['Riding_style_menu'], $_POST['color_menu']); 

}
for ($i = 1; $i <  count($allProducts); $i++) {
        if (isset($_POST["btnBuy" . "_" . $i])) {
            $products->moveProductToCart($_POST["btnBuy" . "_" . $i], $sessionId);
        }
}


?>