<?php
$db = new DataBase;

class User{
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
            $sql = "UPDATE `nckp1tyung_user` SET `first_name`='" . $_POST['first_name_edit'] . "',`last_name`='" . $_POST['last_name_edit'] . "',`phone`='" . $_POST['phone_edit'] . "',`email`='" . $_POST['email_edit'] . "' WHERE  `id` = " . $_SESSION['id'] . "";
            DataBase::$conn->query($sql);
            $msg .= "Succesfully updated profile!";
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
}

?>