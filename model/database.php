<?php

$db = new DataBase;
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
        $sql = "SELECT username, user_password, first_name, last_name, email, phone FROM user WHERE username = ?";
        $stmt = DataBase::$conn->prepare($sql);
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                if ($row['user_password'] == hash('sha256', $_POST['password'])) {
                    $_SESSION["isLoginedIn"] = true;
                    $_SESSION["username"] = $_POST['username'];
                    $_SESSION["name"] =  $row['first_name'] . " " . $row['last_name'];
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["phone"] =  $row['phone'];
                } else {
                    $msg .= "Wrong password. ";
                }
            }
        } else {
            $msg .= "the " . $_POST['username'] . " username not found. ";
        }
        return $msg;
    }
    function registerUser()
    {
        $sql = "INSERT INTO `user` ( `username`, `user_password`, `first_name`, `last_name`, `phone`, `email`) VALUES ('" . $_POST['username'] . "','" . hash('sha256', $_POST['password']) . "','" . $_POST['first_name'] . "','" . $_POST['last_name'] . "','" . $_POST['phone'] . "','" . $_POST['email'] . "');";
        DataBase::$conn->query($sql);
    }
    function checkUsers($msg){
        $sql = "SELECT username, user_password, first_name, last_name, email, phone FROM user WHERE username = ?";
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
