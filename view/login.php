<?php
require "../helpers/mysql.php";
$db = new DataBase;
session_start();

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
        <div class="main__cards cards">
            <div class="cards__inner">
                <div class="cards__card card">
                    <div class="wrap">
                        <?php
                        $msg = '';
                        if (isset($_POST['password']) and isset($_POST['username'])) {
                            if (empty($_POST['username'])) $msg .= "there is no username ";
                            if (empty($_POST['password'])) $msg .= "there is no password ";
                            if (!$msg) {
                                $sql = "SELECT * FROM user WHERE username LIKE '" . $_POST['username'] . "';";
                                $result = DataBase::$conn->query($sql);
                                if ($result->num_rows > 0) {
                                    if ($row = $result->fetch_assoc()) {
                                        if ($row['user_password'] == hash('sha256', $_POST['password'])) {
                                            $msg .= "welcome: " . $_POST['username'];
                                            ?>
                                            <script>
                                                alert("Logined in Successfull now we get you back to the main page.");
                                                window.location.href = "../index.php";
                                            </script>
                                            <?php
                                        } else {
                                            $msg .= "Wrong password";
                                        }
                                    }
                                } else {
                                    $msg .= "Wrong username";
                                }
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