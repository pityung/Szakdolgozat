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
    <title>Address</title>
    <link rel="stylesheet" href="../styles/register.css">
</head>

<body>
    <main class="main flow">
        <h1 class="main__heading">Address</h1>
        <br>
        <form action="../index.php">
            <input type="submit" value="Go Back" id ="goback-btn" >
        </form>
        <div class="main__cards cards">
            <div class="cards__inner">
                <div class="cards__card card">
                    <div class="wrap">
                        <?php
                        if (isset($_POST['address_line']) and isset($_POST['city']) and isset($_POST['postal_code']) and isset($_POST['country'])) {
                            if (empty($msg)) {
                        ?>
                                <script>
                                    alert("Your Profile is now complete!");

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
                            <input type="text" name="address_line" placeholder="address Line" required>
                            <br>
                            <input type="text" name="city" placeholder="City" required>
                            <br>
                            <input type="text" name="postal_code" placeholder="postal Code" required>
                            <br>
                            <input type="text" name="country" placeholder="Country" required>
                            <br>
                            <input type="submit" name="submitbtn" value="submit" id="submit" class="submit-btn">
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