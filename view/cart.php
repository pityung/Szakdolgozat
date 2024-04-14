<?php
session_start();
require "../helpers/mysql.php";
require "../control/MainController.php";
$db = new DataBase;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cart</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/shop.css">
    <script src="../scripts/shopScript.js"></script>
</head>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
        <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
        <a href="../index.php"> <img src="../images/logo.jpg" alt="LOGO" id="logo"></a>
    </div>
    <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
        <?php
        echo "<h1>your Total: </h1>";
        $totalPayment = 0;
        for ($i = 2; $i <  count($userCartItemes); $i++) {
            if(isset($userCartItemesPrices[$i])){
        $totalPayment += $userCartItemesPrices[$i]; 
            }
        }
        echo "<p>".$totalPayment."$</p>";
        
        echo ' <form method="post"> <input type="submit" name="buyCartProducts" value="Buy The Products" class="w3-button w3-black"> </form>';
        ?>
    </div>
</nav>
</script>
<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
    <div class="w3-bar-item w3-padding-24 w3-wide">Cart</div>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
<?php
$dir    = '../uploads';
$uploadFiles = scandir($dir);


echo '
    <div class="w3-main" style="margin-left:250px">
        <!-- Push down content on small screens -->
        <div class="w3-hide-large" style="margin-top:83px"></div>
        <!-- Top header -->
        <header class="w3-container w3-xlarge">
        <p class="w3-left">Your Products</p>
        </header>
        <!-- Image header -->
        <div class="w3-container w3-text-grey">';
echo '</div>';

echo '<div id="card-container">
            <div class="card-container">';
for ($i = 2; $i <  count($userCartItemes); $i++) {
    echo '
            <div class="w3-display-container">
                <div class="card">
                    <div class="front" >';
    for ($j = 0; $j < count($uploadFiles); $j++) {
        if (str_contains($uploadFiles[$j], $userCartItemes[$i])) {
            echo '<img src="../uploads/' . $uploadFiles[$j] . '" alt="image" >';
        }
    }
    echo '<p >' .preg_replace('/[0-9]+/', '', str_replace("_", " " , $userCartItemes[$i])) . '</p> ';
    echo '
    <div class="w3-display-middle w3-display-hover">';
    echo '
            <form method="post">
            <br> ';
            echo '<button name="btnRemoveFromCart' . "_" . ($i) . '" value="' . $userCartitmesId[$i] . '" class="w3-button w3-black">Remove <i class="fa fa-window-close"></i> </button>';
    echo '
                            </form>
                            
                            ';
    echo '
                        </div>
                        <div class="w3-display-bottomleft w3-display-hover">
                                <b>$' . $userCartItemesPrices[$i]. '</b>
                            </div>
                    </div>
                        
                    <div class="w3-display-middle w3-display-hover" >
                        </div>
                    </div>
                    <br><br>
                </div>
                ';
}

echo ' </div>
        </div>';
echo '
        </div>
        
        </div>
        ';

if (!empty($msg)) {
?>
    <script>
        var msg = "<?php print($msg) ?>";
        alert(msg);
    </script>
<?php
}
for ($i = 2; $i <  count($userCartItemes); $i++) { 
    if(isset($_POST["btnRemoveFromCart" . "_" . $i])){
    ?>
        <script>
            alert("The Product is Deleted from your cart!");
            window.location.href = "cart.php";
        </script>
    <?php
    }
}

if(isset($_POST['buyCartProducts'])){
    ?>
    <script>
        alert("This function is unavailable at the moment! but we got your order!");
        window.location.href = "cart.php";
        location.reload();
    </script>
<?php
}
?>
</div>
</body>

</html>