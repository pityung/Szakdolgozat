<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="scripts/shopScript.js"></script>
    <link rel="stylesheet" href="styles/shop.css">
</head>

<body class="w3-content" style="max-width:1200px">
<?php 

require "mysql.php";

?>
    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
        <div class="w3-container w3-display-container w3-padding-16">
            <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
            <a href="index.html"> <img src="images/logo.jpg" alt="LOGO" id="logo"></a>
        </div>
        <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
            <a onclick="shirtFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
                Shirts <i class="fa fa-caret-down"></i>
            </a>
            <div id="shirt" class="w3-bar-block w3-hide w3-padding-large w3-medium">
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Straight</a>
            </div>
            <a onclick="dressFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
                Dresses <i class="fa fa-caret-down"></i>
            </a>
            <div id="dress" class="w3-bar-block w3-hide w3-padding-large w3-medium">
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Straight</a>
            </div>
            <a onclick="jeansFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
                Jeans <i class="fa fa-caret-down"></i>
            </a>
            <div id="jeans" class="w3-bar-block w3-hide w3-padding-large w3-medium">
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Straight</a>
            </div>
            <a onclick="jacketFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
                Jackets <i class="fa fa-caret-down"></i>
            </a>
            <div id="jackets" class="w3-bar-block w3-hide w3-padding-large w3-medium">
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Straight</a>
            </div>
            <a onclick="gymWearFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
                Gymwear <i class="fa fa-caret-down"></i>
            </a>
            <div id="gymWear" class="w3-bar-block w3-hide w3-padding-large w3-medium">
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Straight</a>
            </div>
            <a onclick="blazerFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
                Blazers <i class="fa fa-caret-down"></i>
            </a>
            <div id="blazer" class="w3-bar-block w3-hide w3-padding-large w3-medium">
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Straight</a>
            </div>
            <a onclick="shoesFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align">
                shoes <i class="fa fa-caret-down"></i>
            </a>
            <div id="shoes" class="w3-bar-block w3-hide w3-padding-large w3-medium">
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Skinny</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Relaxed</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Bootcut</a>
                <a href="#" class="w3-bar-item w3-button w3-light-grey"><i
                        class="fa fa-caret-right w3-margin-right"></i>Straight</a>
            </div>
        </div>
    </nav>
    <!-- Top menu on small screens -->
    <header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
        <div class="w3-bar-item w3-padding-24 w3-wide">Shop</div>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i
                class="fa fa-bars"></i></a>
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu"
        id="myOverlay"></div>

    <!-- Jeans CONTENT! -->
    <div class="w3-main" style="margin-left:250px">

        <!-- Push down content on small screens -->
        <div class="w3-hide-large" style="margin-top:83px"></div>

        <!-- Top header -->
        <header class="w3-container w3-xlarge">
            <p class="w3-left">Jeans</p>
            <p class="w3-right">
                <i class="fa fa-shopping-cart w3-margin-right"></i>
                <i class="fa fa-search"></i>
            </p>
        </header>
        <!-- Image header -->


        <div class="w3-container w3-text-grey">
            <p>8 items</p>
        </div>

        <!-- Product grid -->
        <div class="w3-row w3-grayscale">
            <div class="w3-col l3 s6">
                <div class="w3-container">
                    <img src="/w3images/jeans1.jpg" alt="jeans" style="width:100%">
                    <p>Ripped Skinny Jeans<br><b>$24.99</b></p>
                </div>
                <div class="w3-container">
                    <img src="/w3images/jeans2.jpg" alt="jeans" style="width:100%">
                    <p>Mega Ripped Jeans<br><b>$19.99</b></p>
                </div>
            </div>

            <div class="w3-col l3 s6">
                <div class="w3-container">
                    <div class="w3-display-container">
                        <img src="/w3images/jeans2.jpg" alt="jeans" style="width:100%">
                        <span class="w3-tag w3-display-topleft">New</span>
                        <div class="w3-display-middle w3-display-hover">
                            <button class="w3-button w3-black">Buy now <i class="fa fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <p>Mega Ripped Jeans<br><b>$19.99</b></p>
                </div>
                <div class="w3-container">
                    <img src="/w3images/jeans3.jpg" alt="jeans" style="width:100%">
                    <p>Washed Skinny Jeans<br><b>$20.50</b></p>
                </div>
            </div>

            <div class="w3-col l3 s6">
                <div class="w3-container">
                    <img src="/w3images/jeans3.jpg" alt="jeans" style="width:100%">
                    <p>Washed Skinny Jeans<br><b>$20.50</b></p>
                </div>
                <div class="w3-container">
                    <div class="w3-display-container">
                        <img src="/w3images/jeans4.jpg" alt="jeans" style="width:100%">
                        <span class="w3-tag w3-display-topleft">Sale</span>
                        <div class="w3-display-middle w3-display-hover">
                            <button class="w3-button w3-black">Buy now <i class="fa fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <p>Vintage Skinny Jeans<br><b class="w3-text-red">$14.99</b></p>
                </div>
            </div>

            <div class="w3-col l3 s6">
                <div class="w3-container">
                    <img src="/w3images/jeans4.jpg" alt="jeans" style="width:100%">
                    <p>Vintage Skinny Jeans<br><b>$14.99</b></p>
                </div>
                <div class="w3-container">
                    <img src="/w3images/jeans1.jpg" alt="jeans" style="width:100%">
                    <p>Ripped Skinny Jeans<br><b>$24.99</b></p>
                </div>
            </div>
        </div>
    </div>

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
        <div class="w3-row w3-grayscale">
            <div class="w3-col l3 s6">
                <div class="w3-container">
                    <img src="/w3images/jeans1.jpg" alt="jeans" style="width:100%">
                    <p>Ripped Skinny Jeans<br><b>$24.99</b></p>
                </div>
                <div class="w3-container">
                    <img src="/w3images/jeans2.jpg" alt="jeans" style="width:100%">
                    <p>Mega Ripped Jeans<br><b>$19.99</b></p>
                </div>
            </div>

            <div class="w3-col l3 s6">
                <div class="w3-container">
                    <div class="w3-display-container">
                        <img src="/w3images/jeans2.jpg" alt="jeans" style="width:100%">
                        <span class="w3-tag w3-display-topleft">New</span>
                        <div class="w3-display-middle w3-display-hover">
                            <button class="w3-button w3-black">Buy now <i class="fa fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <p>Mega Ripped Jeans<br><b>$19.99</b></p>
                </div>
                <div class="w3-container">
                    <img src="/w3images/jeans3.jpg" alt="jeans" style="width:100%">
                    <p>Washed Skinny Jeans<br><b>$20.50</b></p>
                </div>
            </div>

            <div class="w3-col l3 s6">
                <div class="w3-container">
                    <img src="/w3images/jeans3.jpg" alt="jeans" style="width:100%">
                    <p>Washed Skinny Jeans<br><b>$20.50</b></p>
                </div>
                <div class="w3-container">
                    <div class="w3-display-container">
                        <img src="/w3images/jeans4.jpg" alt="jeans" style="width:100%">
                        <span class="w3-tag w3-display-topleft">Sale</span>
                        <div class="w3-display-middle w3-display-hover">
                            <button class="w3-button w3-black">Buy now <i class="fa fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <p>Vintage Skinny Jeans<br><b class="w3-text-red">$14.99</b></p>
                </div>
            </div>

            <div class="w3-col l3 s6">
                <div class="w3-container">
                    <img src="/w3images/jeans4.jpg" alt="jeans" style="width:100%">
                    <p>Vintage Skinny Jeans<br><b>$14.99</b></p>
                </div>
                <div class="w3-container">
                    <img src="/w3images/jeans1.jpg" alt="jeans" style="width:100%">
                    <p>Ripped Skinny Jeans<br><b>$24.99</b></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>