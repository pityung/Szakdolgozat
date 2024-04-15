<?php 
require "../model/cart.php";
require "../model/session.php";
require "../model/shopProducts.php";
$cart = new cart();
$Session = new session();
$shopProducts = new shopProducts();

if (isset($_SESSION["isLoginedIn"])) {
    $sessionId = $Session->getSessionId();
    $isCartEmpty = $cart->cartIsEmpty($sessionId);
    $userCartItemes = $cart->getUserCartItems($sessionId);
    $userCartItemesPrices = $cart->getUserCartItemsPirces($sessionId);
    $userCartitmesId = $cart->getuserCartitmesId($sessionId);
    $userCartProductId = $cart->getuserCartProductId($sessionId);
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


?>