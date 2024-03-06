<?php

$db = new DataBase;
define('DB_PREFIX',"nckp1tyung_");
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
        $sql = "SELECT id, username, user_password, first_name, last_name, email, phone, admin FROM ".DB_PREFIX."user WHERE username = ?";
        $stmt = DataBase::$conn->prepare($sql);
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                if ($row['user_password'] == hash('sha256', $_POST['password'])) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION["username"] = $_POST['username'];
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
    function addressIsSet(){
        $sql = "SELECT `user_id` FROM `".DB_PREFIX."user_address` WHERE `user_id` LIKE ".$_SESSION['id']."";
        if(!empty($sql)){
        $result = DataBase::$conn->query($sql);
        if ($result->num_rows > 0) {
        $_SESSION['addressOk'] = true;
        }else{
        $_SESSION['addressOk'] = false;
        }
    }
    }
    function registerUser()
    {
        $sql = "INSERT INTO `".DB_PREFIX."user` ( `username`, `user_password`, `first_name`, `last_name`, `phone`, `email`, admin) VALUES ('" . $_POST['username'] . "','" . hash('sha256', $_POST['password']) . "','" . $_POST['first_name'] . "','" . $_POST['last_name'] . "','" . $_POST['phone'] . "','" . $_POST['email'] . "', 0);";
        DataBase::$conn->query($sql);
        $_SESSION['addressOk'] = false;
    }
    function registerUserAddress()
    {

        $sql = "INSERT INTO `".DB_PREFIX."user_address`( `user_id`, `address_line`, `city`, `postal_code`, `country`) VALUES ('" . $_SESSION['id'] . "','" . $_POST['address_line'] . "','" . $_POST['city'] . "','" . $_POST['postal_code'] . "','" . $_POST['country'] . "');";
        DataBase::$conn->query($sql);
        $_SESSION['addressOk'] = true;
    }
    function checkUsers($msg)
    {
        $sql = "SELECT username, user_password, first_name, last_name, email, phone FROM ".DB_PREFIX."user WHERE username = ?";
        $stmt = DataBase::$conn->prepare($sql);
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $msg .= "this username already in use";
        }
        return $msg;
    }
    function getMajorCategories(){
        $sql = " SELECT DISTINCT `major_category` FROM `".DB_PREFIX."product_category`; ";
        $result = DataBase::$conn->query($sql);
        $majorCategorie[0] = "";
        if ($result->num_rows > 0) {
            for ($i=0; $i < $result->num_rows; $i++) { 
            if ($row = $result->fetch_assoc()) {
                array_push($majorCategorie, $row['major_category']);
        }
    }
        }
        return $majorCategorie;
    }
    function getCategories_SubCategories(){
        $sql = " SELECT `major_category`,`name` FROM `".DB_PREFIX."product_category`;  ";
        $result = DataBase::$conn->query($sql);
        $Categories_SubCategories[0] = "";
        if ($result->num_rows > 0) {
            for ($i=0; $i < $result->num_rows; $i++) { 
            if ($row = $result->fetch_assoc()) {
                array_push($Categories_SubCategories, $row['major_category'].$row['name']);
        }
    }
        }
        return $Categories_SubCategories;
    }
    function getSubCategories(){
        $sql = " SELECT `name` FROM `".DB_PREFIX."product_category`;  ";
        $result = DataBase::$conn->query($sql);
        $SubCategories[0] = "";
        if ($result->num_rows > 0) {
            for ($i=0; $i < $result->num_rows; $i++) { 
            if ($row = $result->fetch_assoc()) {
                array_push($SubCategories, $row['name']);
        }
    }
        }
        return $SubCategories;
    }
    function uploadProduct(){
        $sql = "INSERT INTO `nckp1tyung_product` ( `name`, `sex`, `description`, `price`, `category_id`, `propertie_id`, `quantity`) VALUES ('".$_POST['productName']."','".$_POST['sex']."','".$_POST['description']."','".$_POST['price']."','".(explode(',', $_POST['product_category_menu'],2))[1]."','1','".$_POST['quantity']."'); ";
        DataBase::$conn->query($sql);
    }
function getProductDatas(){
    $sql = "SELECT `name`,`price` FROM `nckp1tyung_product` ";
    $result = DataBase::$conn->query($sql);
    $productDatas[0] = "";
    if ($result->num_rows > 0) {
        for ($i=0; $i < $result->num_rows; $i++) { 
        if ($row = $result->fetch_assoc()) {
            array_push($productDatas, $row['name']." ".$row['price']);

    }
}
    }
    return $productDatas;
}

}