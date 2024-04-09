<?php
$db = new DataBase;

class session
{
    function registerShoppingSession()
    {
        $sql = "SELECT id FROM " . DB_PREFIX . "user WHERE username = '" . $_POST['username'] . "'";
        $result = DataBase::$conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $sql = "INSERT INTO `" . DB_PREFIX . "shopping_session`(`user_id`) VALUES ('" . $row['id'] . "')";
                $result = DataBase::$conn->query($sql);
            }
        }
    }
    function getSessionId()
    {
        $sql = "SELECT `id`FROM `" . DB_PREFIX . "shopping_session` WHERE `user_id` =   $_SESSION[id] ";
        $result = DataBase::$conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                return $row['id'];
            }
        } else {
            return "there is an error!";
        }
    }
    function createOrderSession()
    {
        $sql = "INSERT INTO `nckp1tyung_order_details`( `user_id`) VALUES ('" . $_SESSION['id'] . "')";
        DataBase::$conn->query($sql);
    }
    function createOrder($productId, $price)
    {
        $sql = "SELECT  * FROM `nckp1tyung_order_details` WHERE `user_id` = " . $_SESSION['id'] . " 
        ORDER BY `id` desc  LIMIT 1 ;";
        $result = DataBase::$conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $OrderSessionId = $row['id'];
            }
        }
        $sql = "INSERT INTO `nckp1tyung_order_items`( `order_details_id`, `product_id`, `quantity`, `total_per_unit`) VALUES ('" . $OrderSessionId . "','" . $productId . "','1','" . $price . "')";
        DataBase::$conn->query($sql);
    }
}
