<?php
session_start();
require "../helpers/mysql.php";
require "../control/database.php";
$db = new DataBase;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../scripts/shopScript.js"></script>
    <link rel="stylesheet" href="../styles/shop.css">
</head>
<!-- Sidebar/menu -->


<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
        <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
        <a href="../index.php"> <img src="../images/logo.jpg" alt="LOGO" id="logo"></a>
    </div>
    <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
        <?php

        for ($i = 1; $i < count($majorCategorie); $i++) {
            echo '     <a onclick="' . "menu" . $i . 'Func()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
            ' . $majorCategorie[$i] . ' <i class="fa fa-caret-down"></i>
        </a>
        <div id="' . $majorCategorie[$i] . '" class="w3-bar-block w3-hide w3-padding-large w3-medium">
        ';
            for ($j = 1; $j < count($Categories_SubCategories); $j++) {
                if (str_contains($Categories_SubCategories[$j], $majorCategorie[$i])) {
                    echo '    
            <a href="' . str_replace(" ", "_", "#" . str_replace($majorCategorie[$i], "", $Categories_SubCategories[$j]) ) . '" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>' . str_replace($majorCategorie[$i], "", $Categories_SubCategories[$j]) . '</a>';
                }
            }
            echo '
            </div>
        <script>
            
function ' . "menu" . $i . 'Func() {
    var x = document.getElementById("' . $majorCategorie[$i] . '");
    if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    } else {
    x.className = x.className.replace(" w3-show", "");
    }
}
</script>
        ';
        }
        ?>
    </div>
</nav>

</script>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
    <div class="w3-bar-item w3-padding-24 w3-wide">Shop</div>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<?php
if (isset($_SESSION['isLoginedIn']) and $_SESSION['isAdmin'] == 1) {
    echo '
            <div class="w3-main" style="margin-left:250px">
                <!-- Push down content on small screens -->
                <div class="w3-hide-large" style="margin-top:83px"></div>
                <!-- Top header -->
                <header class="w3-container w3-xlarge">
                    <p class="w3-left">Add Items</p>
                </header>
                <!-- Image header -->
                <div class="w3-container w3-text-grey">
                
<!-- plus grid -->
<p>Add an item</p>
<div id="card-container">
    <div class="card-container">';

    echo '<div class="card" id="plus">
            <div class="front">
                <form action="shop.php" method="post" enctype="multipart/form-data">
                    <input type="checkbox" id="show">
                    <label for="show" class="show-btn"><span class="glyphicon glyphicon-plus"> </span></label>
                    <div class="container">
                        <label for="show" class="glyphicon glyphicon-remove" title="close"></label>
                        <div class="text">
                        </div>
                        <form action="#">
                            <div>
                                <input type="file" name="fileToUpload" id="fileToUpload" required>
                            </div>
                            <br>
                            <smal>Select the Product category:</smal>
                            <select name="product_category_menu">
                            ';
                            for ($i=1; $i < count($SubCategories); $i++) { 
                                echo'
                            <option value="'. str_replace(" ", "_", $SubCategories[$i]).'">'.$SubCategories[$i].'</option>';
                            }
                            
                            echo'
                            </select>
                            <br>
                            <br>
                            <input type="text" name="productName" placeholder="name" required>
                            <br>
                            <input type="text" name="description" placeholder="description" required>
                            <br>
                            <input type="number" name="quantity" placeholder="quantity" required>
                            <br>
                            <div>
                                <button type="submit" value="Upload Image" name="submit">Uppload</button>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
        </div>
        </div>
</div>
</div>
</div>
        ';
}
$dir    = '../uploads';
$uploadFiles = scandir($dir);

for ($i = 1; $i < count($Categories_SubCategories); $i++) {
    $shopItemCount = 0;
    echo '
    <div class="w3-main" style="margin-left:250px">
        <!-- Push down content on small screens -->
        <div class="w3-hide-large" style="margin-top:83px"></div>
        <!-- Top header -->
        <header class="w3-container w3-xlarge">
        <p class="w3-left" id="' . str_replace(" ", "_", $SubCategories[$i]) . '">' . $SubCategories[$i] . '</p>
        </header>
        <!-- Image header -->
        <div class="w3-container w3-text-grey">';
    for ($j = 2; $j < count($uploadFiles); $j++) {
        if (str_contains($uploadFiles[$j], str_replace(" ", "_", $SubCategories[$i]))) {
            $shopItemCount++;
        }
    }
    echo '<p>' . ($shopItemCount) . ' items</p>';
    echo '</div>';
    echo '<div id="card-container">
            <div class="card-container">';
    for ($k = 2; $k < count($uploadFiles); $k++) {
        if (str_contains($uploadFiles[$k],  str_replace(" ", "_", $SubCategories[$i]))) {
            echo '
        <div class="card">
                    <div class="front">
                    <img src="../uploads/' . $uploadFiles[$k] . '" alt="image">
                    
                        </div>
                </div>
                ';
        }
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
</body>

</html>