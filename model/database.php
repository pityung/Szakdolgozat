<?php
$db = new DataBase;
define('DB_PREFIX', "nckp1tyung_");
class userTable
{
    function getClass()
    {
        $sql = "SELECT * FROM project_database;";
        $result = DataBase::$conn->query($sql);
        return $result;
    }

    function checkLogin($msg)
    {
        $sql = "SELECT id, username, user_password, first_name, last_name, email, phone, admin FROM " . DB_PREFIX . "user WHERE username = ?";
        $stmt = DataBase::$conn->prepare($sql);
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                if ($row['user_password'] == hash('sha256', $_POST['password'])) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION["username"] = $_POST['username'];
                    $_SESSION["first_name"] =  $row['first_name'];
                    $_SESSION["last_name"] =  $row['last_name'];
                    $_SESSION["name"] =  $row['first_name'] . " " . $row['last_name'];
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["phone"] =  $row['phone'];
                    $_SESSION["isAdmin"] = $row['admin'];
                    $_SESSION["isLoginedIn"] = true;
                } else {
                    $msg .= "Wrong password. ";
                }
            }
        } else {
            $msg .= "the " . $_POST['username'] . " username not found. ";
        }
        return $msg;
    }
    function addressIsSet()
    {
        $sql = "SELECT `user_id` FROM `" . DB_PREFIX . "user_address` WHERE `user_id` LIKE " . $_SESSION['id'] . "";
        if (!empty($sql)) {
            $result = DataBase::$conn->query($sql);
            if ($result->num_rows > 0) {
                $_SESSION['addressOk'] = true;
            } else {
                $_SESSION['addressOk'] = false;
            }
        }
    }
    function registerUser()
    {
        $sql = "INSERT INTO `" . DB_PREFIX . "user` ( `username`, `user_password`, `first_name`, `last_name`, `phone`, `email`, admin) VALUES ('" . $_POST['username'] . "','" . hash('sha256', $_POST['password']) . "','" . $_POST['first_name'] . "','" . $_POST['last_name'] . "','" . $_POST['phone'] . "','" . $_POST['email'] . "', 0);";
        DataBase::$conn->query($sql);
        $_SESSION['addressOk'] = false;
    }
    function registerUserAddress()
    {
        $sql = "INSERT INTO `" . DB_PREFIX . "user_address`( `user_id`, `address_line`, `city`, `postal_code`, `country`) VALUES ('" . $_SESSION['id'] . "','" . $_POST['address_line'] . "','" . $_POST['city'] . "','" . $_POST['postal_code'] . "','" . $_POST['country'] . "');";
        DataBase::$conn->query($sql);
        $_SESSION['addressOk'] = true;
    }
    function updateUser($msg)
    {
        $sql = "SELECT `username` FROM `nckp1tyung_user` WHERE `username` = '" . $_POST["username_edit"] . "'";
        $result = DataBase::$conn->query($sql);
        if ($result->num_rows > 0) {
            $msg .= "This username already in use!";
        } else {
            $sql = "UPDATE `nckp1tyung_user` SET `username`='" . $_POST['username_edit'] . "',`first_name`='" . $_POST['first_name_edit'] . "',`last_name`='" . $_POST['last_name_edit'] . "',`phone`='" . $_POST['phone_edit'] . "',`email`='" . $_POST['email_edit'] . "' WHERE  `id` = " . $_SESSION['id'] . "";
            DataBase::$conn->query($sql);
            $msg .= "Succesfully updated profile!";
        }
        return $msg;
    }
    function checkUsers($msg)
    {
        $sql = "SELECT username, user_password, first_name, last_name, email, phone FROM " . DB_PREFIX . "user WHERE username = ?";
        $stmt = DataBase::$conn->prepare($sql);
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $msg .= "this username already in use";
        }
        return $msg;
    }
    function getMajorCategories()
    {
        $sql = " SELECT DISTINCT `major_category` FROM `" . DB_PREFIX . "product_category`; ";
        $result = DataBase::$conn->query($sql);
        $majorCategorie[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($majorCategorie, $row['major_category']);
                }
            }
        }
        return $majorCategorie;
    }
    function getCategories_SubCategories()
    {
        $sql = " SELECT `major_category`,`name` FROM `" . DB_PREFIX . "product_category`;  ";
        $result = DataBase::$conn->query($sql);
        $Categories_SubCategories[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($Categories_SubCategories, $row['major_category'] . $row['name']);
                }
            }
        }
        return $Categories_SubCategories;
    }
    function getSubCategories()
    {
        $sql = " SELECT `name` FROM `" . DB_PREFIX . "product_category`;  ";
        $result = DataBase::$conn->query($sql);
        $SubCategories[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($SubCategories, $row['name']);
                }
            }
        }
        return $SubCategories;
    }
    function getPropertie()
    {
        $sql = "SELECT `riding_style` FROM `" . DB_PREFIX . "properties`";
        $result = DataBase::$conn->query($sql);
        $properties[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($properties, $row['riding_style']);
                }
            }
        }
        return $properties;
    }
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
    function checkUploadedProducts()
    {
        $sql = "SELECT * FROM `" . DB_PREFIX . "product` WHERE `name` LIKE '" . str_replace(" ", "", $_POST['productName']) . "_" . $_SESSION['id'] . "' AND `category_id` = " . (explode(',', $_POST['product_category_menu'], 2))[1] . "";
        $result = DataBase::$conn->query($sql);
        if ($result->num_rows == 0) {
            return;
        } else {
            return "product updated!";
        }
    }
    function updateProduct()
    {
        $sql = "UPDATE `" . DB_PREFIX . "product` SET `sex`='" . $_POST['sex'] . "',`description`='" . $_POST['description'] . "',`price`='" . $_POST['price'] . "',`propertie_id`='" . (explode(',', $_POST['Riding_style_menu'], 2))[1] . "',`quantity`='" . $_POST['quantity'] . "',`color`='" . $_POST['color'] . "'WHERE `name` LIKE '" . str_replace(" ", "", $_POST['productName']) . "_" . $_SESSION['id'] . "' AND `category_id` = " . (explode(',', $_POST['product_category_menu'], 2))[1] . "";
        DataBase::$conn->query($sql);
    }
    function uploadProduct()
    {
        $sql = "INSERT INTO `" . DB_PREFIX . "product` ( `name`, `sex`, `description`, `price`, `category_id`, `propertie_id`, `quantity` , `color`) VALUES ('" . str_replace(" ", "", $_POST['productName']) . "_" . $_SESSION['id'] . "','" . $_POST['sex'] . "','" . $_POST['description'] . "','" . $_POST['price'] . "','" . (explode(',', $_POST['product_category_menu'], 2))[1] . "','" . (explode(',', $_POST['Riding_style_menu'], 2))[1] . "','" . $_POST['quantity'] . "', '" . $_POST['color'] . "'); ";
        DataBase::$conn->query($sql);
    }
    function getProductDatas()
    {
        $sql = "SELECT `name`,`price`, `id` FROM `" . DB_PREFIX . "product` ";
        $result = DataBase::$conn->query($sql);
        $productDatas[0] = "";
        $productDatas[1] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($productDatas, $row['name'] . " " . $row['price'] . " " . $row['id']);
                }
            }
        }
        return $productDatas;
    }
    function deleteProductFromDatabase($removable)
    {
        $sql = "DELETE FROM `nckp1tyung_product` WHERE `id` = '" . $removable . "'";
        DataBase::$conn->query($sql);
    }
    function removeDeletedProductFromAllCart($removable)
    {
        $sql = "DELETE FROM `nckp1tyung_cart_item` WHERE `product_id`='" . $removable . "'";
        DataBase::$conn->query($sql);
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
    function moveProductToCart($productId, $sessionId)
    {
        $sql = "INSERT INTO `nckp1tyung_cart_item`( `product_id`, `quantity`, `session_id`) VALUES ('" . $productId . "','1','" . $sessionId . "');";
        DataBase::$conn->query($sql);
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
    function createOrderSession(){
        $sql = "INSERT INTO `nckp1tyung_order_details`( `user_id`) VALUES ('".$_SESSION['id']."')"; 
        DataBase::$conn->query($sql);
    }
    function createOrder($productId ){
        $sql = "SELECT  * FROM `nckp1tyung_order_details` WHERE `user_id` = ".$_SESSION['id']." 
        ORDER BY `id` desc  LIMIT 1 ;";
        $result = DataBase::$conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $OrderSessionId = $row['id'];
            }
        }
        $sql = "INSERT INTO `nckp1tyung_order_items`( `order_details_id`, `product_id`, `quantity`, `total_per_unit`) VALUES ('".$OrderSessionId ."','".$productId."','4','4')";
        DataBase::$conn->query($sql);
    }
    function deletEverythingFromCart($sessionId){
        $sql = "DELETE FROM `nckp1tyung_cart_item` WHERE `session_id`=".$sessionId. "";
        DataBase::$conn->query($sql);
    }
}

