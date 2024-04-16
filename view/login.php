<?php
session_start();
require "../helpers/mysql.php";
require "../control/UserController.php";
$db = new DataBase;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body>
    <main class="main flow">
        <h1 class="main__heading">Login</h1>
        <br>
        <form action="../index.php">
            <input type="submit" value="Go Back" id ="goback-btn" >
        </form>
        <div class="main__cards cards">
            <div class="cards__inner">
                <div class="cards__card card">
                    <div class="wrap">
                        <?php
                        if (isset($_POST['password']) and isset($_POST['username'])) {
                            if (empty($msg)) {
                        ?>
                                <script>
                                    alert("Logined in Successfull now we get you back to the main page.");
                                    window.location.href = "../index.php";
                                </script>
                        <?php
                            }
                        }
                        ?>
                        <form method="post">
                            <input type="text" name="username" placeholder="Username">
                            <br>
                            <input type="password" name="password" placeholder="Password">
                            <br>
                            <input type="submit" value="Login In" class="submit-btn">
                                <input type="button" value="To Register" class="submit-btn shuffle" onclick="location.href='register.php' ">
                        </form>
                    </div>
                </div>
            </div>
            <div class="overlay"></div>
        </div>
        <?php
        if (isset($msg)) {
            echo $msg;
        } else {
            echo "ok";
        }
        ?>
    </main>
    <script src="../scripts/cards.js"></script>
</body>

</html>