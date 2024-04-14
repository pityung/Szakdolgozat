<?php 
require "../model/appModell.php";
require "../control/MainController.php";

$app = new appProducts();
$products = new shopProducts();

if(isset($_POST['gender']) and isset($_POST['Riding_style_menu']) and $_POST['color_menu'] != "None")
{
    $selectedCartItem = $app->getselectedCartItemByColor($_POST['gender'], $_POST['Riding_style_menu'], $_POST['color_menu']);
    $selectedCartItemPrices = $app->getselectedCartItemPricesByColor($_POST['gender'], $_POST['Riding_style_menu'], $_POST['color_menu']);
    $selectedCartItemId = $app->getselectedCartItemIdByColor($_POST['gender'], $_POST['Riding_style_menu'], $_POST['color_menu']); 
}
else if(isset($_POST['gender']) and isset($_POST['Riding_style_menu']) and $_POST['color_menu'] == "None")
{
    $selectedCartItem = $app->getselectedCartItem($_POST['gender'], $_POST['Riding_style_menu']);
    $selectedCartItemPrices = $app->getselectedCartItemPrices($_POST['gender'], $_POST['Riding_style_menu']);
    $selectedCartItemId = $app->getselectedCartItemId($_POST['gender'], $_POST['Riding_style_menu']); 
}
else if(!isset($_POST['gender'])){

}


?>