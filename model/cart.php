<?php 
$db = new DataBase;

class cart{
    function deletEverythingFromCart($sessionId){
        $sql = "DELETE FROM `nckp1tyung_cart_item` WHERE `session_id`=".$sessionId. "";
        DataBase::$conn->query($sql);
    }
    function removeFromCart($removableCartProduct){
        $sql = 'DELETE FROM `nckp1tyung_cart_item` WHERE `id` ="'.$removableCartProduct.'" ';
        DataBase::$conn->query($sql);
            }
            function cartIsEmpty($sessionId){
                $sql = "SELECT * FROM `nckp1tyung_cart_item` WHERE `session_id` =".$sessionId."";
                $result = DataBase::$conn->query($sql);
                if ($result->num_rows > 0) {
                    return false;
                }
                return true;
            }
            function getuserCartProductId($sessionId){
                $sql = 'SELECT `nckp1tyung_cart_item`.`product_id`, `nckp1tyung_cart_item`.`session_id` FROM `nckp1tyung_cart_item` WHERE  `session_id` ='.$sessionId.'; ';
                $result = DataBase::$conn->query($sql);
                $userCartitmesId[0] = "";
                $userCartitmesId[1] = "";
                if ($result->num_rows > 0) {
        
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        if ($row = $result->fetch_assoc()) {
                            array_push($userCartitmesId, $row['product_id']);
                        }
                    }
                }
                return $userCartitmesId;
            }
            function getuserCartitmesId($sessionId){
                $sql = 'SELECT `nckp1tyung_cart_item`.`id`, `nckp1tyung_cart_item`.`session_id` FROM `nckp1tyung_cart_item` WHERE  `session_id` ='.$sessionId.'; ';
                $result = DataBase::$conn->query($sql);
                $userCartitmesId[0] = "";
                $userCartitmesId[1] = "";
                if ($result->num_rows > 0) {
        
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        if ($row = $result->fetch_assoc()) {
                            array_push($userCartitmesId, $row['id']);
                        }
                    }
                }
                return $userCartitmesId;
            }
            function getUserCartItemsPirces($sessionId){
                $sql = 'SELECT `nckp1tyung_cart_item`.`product_id`, `nckp1tyung_product`.`price`, `nckp1tyung_cart_item`.`session_id` FROM `nckp1tyung_cart_item` INNER JOIN `nckp1tyung_product` ON `nckp1tyung_cart_item`.`product_id` = `nckp1tyung_product`.`id` WHERE `nckp1tyung_cart_item`.`session_id` = '.$sessionId.'; ';
                $result = DataBase::$conn->query($sql);
                $userCartItemesPrices[0] = "";
                $userCartItemesPrices[1] = "";
                if ($result->num_rows > 0) {
        
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        if ($row = $result->fetch_assoc()) {
                            array_push($userCartItemesPrices, $row['price']);
                        }
                    }
                }
                return $userCartItemesPrices;
            }
            function getUserCartItems($sessionId)
            {
                $sql = 'SELECT `nckp1tyung_cart_item`.`product_id`, `nckp1tyung_cart_item`.`session_id`, `nckp1tyung_product`.`name`, `nckp1tyung_product`.`category_id`, `nckp1tyung_product_category`.`name` AS "category_name" FROM `nckp1tyung_cart_item` INNER JOIN `nckp1tyung_product` ON `nckp1tyung_cart_item`.`product_id` = `nckp1tyung_product`.`id` INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id` WHERE `nckp1tyung_cart_item`.`session_id` = '.$sessionId.'; ';
                $result = DataBase::$conn->query($sql);
                $userCartItemes[0] = "";
                $userCartItemes[1] = "";
                if ($result->num_rows > 0) {
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        if ($row = $result->fetch_assoc()) {
                            array_push($userCartItemes, str_replace(" ", "_", $row['category_name']."_".$row['name']));
                        }
                    }
                }
                return $userCartItemes;
            }
            function removeDeletedProductFromAllCart($removable)
    {
        $sql = "DELETE FROM `nckp1tyung_cart_item` WHERE `product_id`='" . $removable . "'";
        DataBase::$conn->query($sql);
    }
}

?>