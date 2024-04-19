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
    <title>Register</title>
    <link rel="stylesheet" href="../styles/register.css">
</head>

<body>
    <main class="main flow">
        <h1 class="main__heading">Register</h1>
        <br>
        <form action="../index.php">
            <input type="submit" value="Go Back" id="goback-btn">
        </form>
        <div class="main__cards cards">
            <div class="cards__inner">
                <div class="cards__card card">
                    <div class="wrap">
                        <?php
                        if (isset($_POST['password']) and isset($_POST['username']) and isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['email']) and isset($_POST['phone'])) {
                            if (empty($msg)) {
                        ?>
                                <script>
                                    alert("Registered and logined in Successfull.");

                                    localStorage.clear();
                                    window.location.href = "../index.php";
                                </script>
                        <?php
                            }
                        } elseif (isset($_POST['submitbtn'])) {
                            $msg .= "fill all the boxes!";
                        }
                        ?>
                        <form method="post">
                            <input type="text" name="username" value="" placeholder="Username" id="username" required>
                            <br>
                            <input type="text" name="first_name" value="" placeholder="First Name" id="first_name" required>
                            <br>
                            <input type="text" name="last_name" value="" placeholder="Last Name" id="last_name" required>
                            <br>
                            <input type="password" name="password" value="" placeholder="Password" required>
                            <br>
                            <input type="password" name="password_again" value="" placeholder="Password Again" required>
                            <br>
                            <input type="tel" name="phone" value="" placeholder="+36203893109 " id="phone" required>
                            <br>
                            <input type="email" name="email" value="" placeholder="Email" id="email" required>
                            <br>
                            <input type="submit" name="submitbtn" value="Register In" id="submit" class="submit-btn">
                            <input type="button" value="To Login" class="submit-btn shuffle" onclick="location.href='login.php' ">
                        </form>
                        <Script src="../scripts/register.js"></Script>
                    </div>
                </div>
            </div>
            <div class="overlay"></div>
        </div>
    </main>
    <script src="../scripts/cards.js"></script>
    <?php
    echo $msg;
    if (!empty($msg)) {
    ?>
        <script>
            var msg = "<?php print($msg) ?>";
            alert(msg);
        </script>
    <?php
    }
    ?>
</body>

</html>