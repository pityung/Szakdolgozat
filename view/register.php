<?php
session_start();
require "../helpers/mysql.php";
require "../control/database.php";
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
        <a href="../index.php">
            <p class="main__heading">Go Back</p>
        </a>
        <div class="main__cards cards">
            <div class="cards__inner">
                <div class="cards__card card">
                    <div class="wrap">
                        <?php  
                        if (isset($_POST['password']) and isset($_POST['username']) and isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['email']) and isset($_POST['phone'])) {
                            if (empty($msg)) {
                        ?>
                                <script>
                                    alert("Registered in Successfull Please login in.");
                                //    window.location.href = "login.php";
                                </script>
                        <?php
                            }
                        } else {
                            $msg .= "fill all the boxes!";
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

    if(!empty($msg)){
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