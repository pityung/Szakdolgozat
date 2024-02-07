<?php
session_start();
require "../helpers/mysql.php";
$db = new DataBase;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../styles/register.css">
</head>

<body>
    <main class="main flow">
        <h1 class="main__heading">Register</h1>
        <div class="main__cards cards">
            <div class="cards__inner">
                <div class="cards__card card">
                    <div class="wrap">
                        <?php
                        $msg = '';
                        if (isset($_POST['password']) and isset($_POST['username']) and isset($_POST['last_name']) and isset($_POST['first_name']) and isset($_POST['password_again']) and isset($_POST['phone']) and isset($_POST['email'])) {
                            if (empty($_POST['password'])  or empty($_POST['username']) or empty($_POST['first_name']) or empty($_POST['last_name']) or  empty($_POST['phone']) or empty($_POST['email'])) {
                                $msg .= "fill all the boxes!";
                            }
                            if (empty($_POST['password_again'])) {
                                $msg .= "you must confirm your password!";
                            }
                            if ($_POST['password'] != $_POST['password_again']) {
                                $msg .= "your password and confirmed password does not match!";
                            }
                            if (empty($msg)) {
                                $sql = "INSERT INTO `user` ( `username`, `user_password`, `first_name`, `last_name`, `phone`, `email`) VALUES ('" . $_POST['username'] . "','" . hash('sha256', $_POST['password']) . "','" . $_POST['first_name'] . "','" . $_POST['last_name'] . "','" . $_POST['phone'] . "','" . $_POST['email'] . "');";
                                $result = DataBase::$conn->query($sql);
                                $msg .= "Succesfull registration, please login in!";
                                $_SESSION["isLoginedIn"] = true;
                                $_SESSION["username"] =$_POST['username'];
                        ?>
                                <script>
                                    alert("Registered Successfull and logined in, now we get you back to the main page.");
                                    window.location.href = "../index.php";
                                </script>
                        <?php
                            }
                        }
                        ?>
                        <form method="post">
                            <input type="text" name="username" value="" placeholder="Username" required>
                            <br>
                            <input type="text" name="first_name" value="" placeholder="First Name" required>
                            <br>
                            <input type="text" name="last_name" value="" placeholder="Last Name" required>
                            <br>
                            <input type="password" name="password" value="" placeholder="Password" required>
                            <br>
                            <input type="password" name="password_again" value="" placeholder="Password Again" required>
                            <br>
                            <input type="phone" name="phone" value="" placeholder="Phone Number" required>
                            <br>
                            <input type="email" name="email" value="" placeholder="Email" required>
                            <br>
                            <input type="submit" value="submit" class="submit-btn">
                        </form>
                        <a href="../view/login.php" class="shuffle"><input type="submit" value="Login" class="submit-btn"></a>
                    </div>
                </div>
            </div>
            <div class="overlay"></div>
        </div>
    </main>
    <script src="../scripts/cards.js"></script>
    <?php
    echo $msg;
    ?>
</body>

</html>