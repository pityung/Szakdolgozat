<?php
session_start();
require "../helpers/mysql.php";
require "../control/AppController.php";
$db = new DataBase;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>App</title>
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
        echo '
        <form method="post">
            <h2>Choose a Gender!</h2>
    <div class="gender">
    <input type="radio" name="gender" value="Male">
    <span>Male</span>
    </div>
    <div class="gender">
    <input type="radio" name="gender" value="Female" class="radio-btn">
    <span>Female</span>
    </div>
    <h2>Choose a Riding Style!</h2>
<div>
<select name="Riding_style_menu" class="riding-select">';
        for ($i = 1; $i < count($properties); $i++) {
            echo '
<option value="' . str_replace(" ", "_", $properties[$i]) . '" >' . $properties[$i] . '</option>';
        }
        echo '
</select>
</div>
<span>Chose by Color</span>
<div>
<select name="color_menu">
<option value="None">None</option>
<option value="White">White</option>
<option value="Black">Black</option>
<option value="Pink">Pink </option>
<option value="Green">Green</option>
<option value="Yellow">Yellow</option>
<option value="Blue">Blue</option>
<option value="Grey">Grey</option>
<option value="Red">Red</option>
</select>
</div>
<br>

<input type="submit" value="Get Items!" class="submit-btn">
</form  >

';
        ?>
    </div>
</nav>
<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
    <div class="w3-bar-item w3-padding-24 w3-wide">App</div>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
<?php
$dir    = '../uploads';
$uploadFiles = scandir($dir);
if (isset($_POST['gender'])) {
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
    for ($i = 2; $i <  count($selectedCartItem); $i++) {
        echo '
            <div class="w3-display-container">
                <div class="card">
                    <div class="front" >';
        for ($j = 0; $j < count($uploadFiles); $j++) {
            if (str_contains($uploadFiles[$j], $selectedCartItem[$i])) {
                echo '<img src="../uploads/' . $uploadFiles[$j] . '" alt="image" >';
            }
        }
        echo '<p >' . preg_replace('/[0-9]+/', '', str_replace("_", " ", $selectedCartItem[$i])) . '</p> ';
        echo '
    <div class="w3-display-middle w3-display-hover">';
        echo '
            <form method="post">
            <br> ';
            if($selectedCartItemQuantity[$i] > 0){
            if(isset($_SESSION["isLoginedIn"])){
        echo '<button name="btnBuy' . "_" . ($i) . '" value="' . $selectedCartItemId[$i] . '" class="w3-button w3-black">Buy now <i class="fa fa-shopping-cart"></i> </button>';
            }else{
                echo ' <button name="unsignedBuy'. "_" . ($i) .'" value="' . $selectedCartItemId[$i] . '"  class="w3-button w3-black" >Sign In to Buy</button>  ';
            }
        }
        echo '
                            </form>
                            
                            ';
        echo '
                        </div>
                        <div class="w3-display-bottomleft w3-display-hover">
                                <b>$' . $selectedCartItemPrices[$i] . '</b>
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
}

?>
</div>
<?php
if (!empty($msg)) {
?>
    <script>
        var msg = "<?php print($msg) ?>";
        alert(msg);
    </script>
<?php
}

    for ($i = 1; $i <  count($allProducts); $i++) {
    if (isset($_POST["unsignedBuy" . "_" . $i])) {
        
        $_SESSION['unsignedProduct'] = $_POST["unsignedBuy" . "_" . $i];
    ?>
        <script>
            alert("We get you to the login page");
            window.location.href = "login.php";
        </script>
<?php
    
    }
}
?>
</body>

</html>