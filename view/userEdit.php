<?php
session_start();
require "../helpers/mysql.php";
require "../control/MainController.php";
$db = new DataBase;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body>
    <main class="main flow">
        <h1 class="main__heading">Update</h1>
        <br>
        <a href="../index.php">
            <input type="button" value="Go Back" id="goback-btn">
        </a>
        <div class="main__cards cards">
            <div class="cards__inner">
                <div class="cards__card card">
                    <div class="wrap">
                        <?php
                        if (isset($_POST['first_name_edit']) and isset($_POST['last_name_edit']) and isset($_POST['phone_edit'])  and isset($_POST['email_edit']) ) {
                            if (empty($msg)) {
                        ?>
                                <script>
                                    alert("Your Profile is updated!");
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
                            <?php
                            echo '  
                            <input type="text" name="first_name_edit" value="'.$_SESSION["first_name"].'" placeholder="'.$_SESSION["first_name"].'" id="first_name" required>
                            <br>
                            <input type="text" name="last_name_edit" value="'.$_SESSION["last_name"].'" placeholder="'.$_SESSION["last_name"].'" id="last_name" required>
                            <br>
                            <input type="phone" name="phone_edit" value="'.$_SESSION["phone"].'" placeholder="'.$_SESSION["phone"].'" id="phone" required>
                            <br>
                            <input type="email" name="email_edit" value="'.$_SESSION["email"].'" placeholder="'.$_SESSION["email"].'" id="email" required>
                            <br>
                            <input type="submit" name="submitbtn" value="Update" id="submit" class="submit-btn">
                            ';
                            ?>
                        </form>
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