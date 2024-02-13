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




<?php


// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>



<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
        <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
        <a href="../index.php"> <img src="../images/logo.jpg" alt="LOGO" id="logo"></a>
    </div>
    <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
        <a onclick="shirtFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
            Shirts <i class="fa fa-caret-down"></i>
        </a>
        <div id="shirt" class="w3-bar-block w3-hide w3-padding-large w3-medium">
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Straight</a>
        </div>
        <a onclick="dressFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
            Dresses <i class="fa fa-caret-down"></i>
        </a>
        <div id="dress" class="w3-bar-block w3-hide w3-padding-large w3-medium">
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Straight</a>
        </div>
        <a onclick="jeansFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
            Jeans <i class="fa fa-caret-down"></i>
        </a>
        <div id="jeans" class="w3-bar-block w3-hide w3-padding-large w3-medium">
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Straight</a>
        </div>
        <a onclick="jacketFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
            Jackets <i class="fa fa-caret-down"></i>
        </a>
        <div id="jackets" class="w3-bar-block w3-hide w3-padding-large w3-medium">
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Straight</a>
        </div>
        <a onclick="gymWearFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
            Gymwear <i class="fa fa-caret-down"></i>
        </a>
        <div id="gymWear" class="w3-bar-block w3-hide w3-padding-large w3-medium">
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Straight</a>
        </div>
        <a onclick="blazerFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
            Blazers <i class="fa fa-caret-down"></i>
        </a>
        <div id="blazer" class="w3-bar-block w3-hide w3-padding-large w3-medium">
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Straight</a>
        </div>
        <a onclick="shoesFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
            shoes <i class="fa fa-caret-down"></i>
        </a>
        <div id="shoes" class="w3-bar-block w3-hide w3-padding-large w3-medium">
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
            <a href="#" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>Straight</a>
        </div>
    </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
    <div class="w3-bar-item w3-padding-24 w3-wide">Shop</div>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Jeans CONTENT!-->

<!-- jacket CONTENT! -->
<div class="w3-main" style="margin-left:250px">

    <!-- Push down content on small screens -->
    <div class="w3-hide-large" style="margin-top:83px"></div>

    <!-- Top header -->
    <header class="w3-container w3-xlarge">
        <p class="w3-left">Jacket</p>
    </header>

    <!-- Image header -->
    <div class="w3-container w3-text-grey" id="jacket">
        <p>8 items</p>
    </div>

    <!-- Product grid -->


    <div id="card-container">
        <div class="card-container">

            <?php
            for ($i = 0; $i < 1; $i++) {
                echo '
                <div class="card">
                <div class="front">
                    <img src="../images/equestrianBoots.jpg" alt="equestrianBoots">
                </div>
            </div>
                ';
            }
            ?>

            <div class="card">
                <div class="front">
                    <form action="shop.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <button type="submit" value="Upload Image" name="submit" class="glyphicon glyphicon-plus"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>

</html>