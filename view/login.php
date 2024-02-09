<?php
session_start();
require "../helpers/mysql.php";
require '../control/database.php';
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
        <a href="../index.php"> <p  class="main__heading">Go Back</p> </a> 
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
                        <br>
                        <br>
                        <form method="post">
                            <input type="text" name="username" placeholder="Username">
                            <br>
                            <input type="password" name="password" placeholder="Password">
                            <br>
                            <input type="submit" value="submit" class="submit-btn">
                            <a href="../view/register.php" class="shuffle"><input type="button" value="register" class="submit-btn"></a>
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