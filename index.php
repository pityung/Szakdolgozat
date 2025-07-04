<?php

session_start();

require "helpers/mysql.php";
$db = new DataBase;
require "model/user.php";
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'logout') {
        session_unset();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Horses</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/index_function.js"></script>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

    <!-- Navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" id="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="images/logo.jpg" alt="LOGO" id="darkmode" onclick="Darkmode()">
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#myPage">HOME</a></li>
<?php 
if(!empty($_SESSION["isLoginedIn"])){
echo ' <li><a href="view/cart.php">CART</a></li>';
}
?>
                    <li><a href="#cardheader">STYLES</a></li>
                    <li><a href="#shop">SHOP</a></li>
                    <li><a href="view/app.php">APP</a></li>
                    <!--User/login Menu-->
                    <?php
                    if (!empty($_SESSION["isLoginedIn"]) && $_SESSION["isLoginedIn"] == true) {
                        print '
                        <li ><a  onclick=toggleMenu()> <span class="glyphicon glyphicon-user" class="user-pic" id="user" ></span> </a></li>
                        ';
                    } else {
                        print '<li><a href="view/login.php"><span class="glyphicon glyphicon-user" id="user"></span></a></li>';
                    }
                    ?>
                </ul>

                <?php 
                if (!empty($_SESSION["isLoginedIn"]) && $_SESSION["isLoginedIn"] == true) {
                print '<div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <h2>' . $_SESSION["username"] . '</h2>
                        
                    </div>
                    <a href="index.php?action=logout" class="sub-menu-link">
                        <p>Exit</p>
                        <span>></span>
                    </a>';
                    echo  '<a href="view/userEdit.php" class="sub-menu-link">
                    <p> Edit profile</p>
                    <span>></span>
                    </a>';
            if ($_SESSION['addressOk'] == false) {
                echo '   </a>
                            <a href="view/userAddress.php" class="sub-menu-link">
                            <p> Finish your profile</p>
                            <span>></span>
                            </a>';
            } else {
                echo ' <p>Your profile is complete</p>';
            }
            echo '<hr>
                    <a  class="sub-menu-link">
                        <p>' . $_SESSION["name"] . '</p>
                        
                    </a>
                    <a  class="sub-menu-link">
                        <p>' . $_SESSION["phone"] . '</p>
                    </a>
                    
                </div>
            </div>
            ';}
                ?>
            </div>
        </div>
    </nav>
    <!-- Main horse pictures -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="images/horse.jpg" alt="Horse">
            </div>
            <div class="item">
                <img src="images/horse2.jpg" alt="Horse">
            </div>
            <div class="item">
                <img src="images/horse3.jpg" alt="Horse">
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div id="cardheader">
        <!-- Overview of horse riding -->
        <h1> Overview of Horse Riding Styles</h1>
        <p> In the vast and varied world of equestrian sports, understanding the different horse riding styles is key to
            appreciating and participating in this rich cultural activity. Let’s explore the primary styles – Western,
            English, and Group Riding – each with its unique history, techniques, and cultural significance.</p>
        <h1> Western Riding</h1>
        <p> Western riding, originating from the cattle-herding traditions of the American West, is characterized by its
            practicality and deep-rooted connection to ranch work. This style is known for its relaxed stance and the
            use of a larger, more comfortable saddle designed to provide security and endurance over long hours of
            riding.</p>
        <h1>English Riding</h1>
        <p> English riding, tracing its origins back to European military traditions, is distinguished by its emphasis
            on formality, precision, and grace. This style utilizes a smaller, closer-fitting saddle, allowing for
            greater contact and communication between the rider and the horse.</p>
        <h1> Group Riding</h1>
        <p>Group riding encompasses various styles that involve multiple riders and, often, teamwork. This category
            includes disciplines like polo, where teams of riders work together in a fast-paced ball game, and fox
            hunting,
            a traditional activity that involves riders following a scent trail in a group.</p>
        <p> <b>But the most important is to love horses, because you only need to live, love, ride</b></p>
    </div>
            <!-- Cards -->
            <div id="card-container">
            <div class="card-container">
                <div class="card">
                    <div class="front">
                        <img src="images/equestrianHelmet.jpg" alt="equestrianBlazer">
                    </div>
                    <div class="back">
                        <div class="details">
                            <div class="caption">
                                " Protect your passion, safeguard your ride. Wear a helmet, ride with pride. "
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="front">
                        <img src="images/equestrianBlazer.jpg" alt="horse">
                    </div>
                    <div class="back">
                        <div class="details">
                            <div class="caption">
                                "Elegance in motion, strength in style. Women's riding suits, where grace meets stride."
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="front">
                        <img src="images/equestrianTrouser.jpg" alt="horse">
                    </div>
                    <div class="back">
                        <div class="details">
                            <div class="caption">
                                " In the saddle, comfort reigns supreme. Riding trousers: the perfect blend of form and function for every equestrian dream. "
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="front">
                        <img src="images/equestrianBoots.jpg" alt="equestrianBoots">
                    </div>
                    <div class="back">
                        <div class="details">
                            <div class="caption">
                                " Stride with confidence, step into the saddle. Riding boots: the ultimate companion for every equestrian adventure. "
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    <hr>
    <!-- The shop -->
    <div class="container-fluid bg-3 text-center">
        <h3 id="shop"><a href="view/shop.php">what to buy?</a> </h3>
        <div class="row">
            <div class="col-sm-4">
                <p>For Horses</p>
                <div class="container">
                    <a href="view/shop.php"> <img src="images/forHorses1.jpg" alt="Horse" class="image"> </a>
                    <div class="overlay">
                        <a href="view/shop.php">
                            <div class="text"><img src="images/forHorses2.jpg" alt="horse"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <p>For Riders</p>
                <div class="container">
                    <a href="view/shop.php"> <img src="images/forRiders.jpg" alt="Horse" class="image"></a>
                    <div class="overlay">
                        <a href="view/shop.php">
                            <div class="text"><img src="images/forRiders2.jpg" alt="horse"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <p>For Stables</p>
                <div class="container">
                    <a href="view/shop.php"> <img src="images/forHusbandry.jpg" alt="Horse" class="image"></a>
                    <div class="overlay">
                        <a href="view/shop.php">
                            <div class="text"><img src="images/forHusbandry2.jpg" alt="Horse2"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <!-- App -->
    <div id="appbutton">
        <p>or if you dont know what to buy, check our app</p>
        <a href="view/app.php" id="app" class="btn btn-secondary btn-lg btn-block">App</button>
        </a>
    </div>
    <br>
    <!-- About Section -->
    <div class="about-section">
        <strong>
            Equestrian accessories, horse equipment, riding clothing for competition and everyday life
        </strong>
        <div>
            <p>Our large selection of equestrian equipment provide you with everything you need for your favourite
                hobby. But we
                know that riding is not just a sport. It's a life style that connects you with your horse. That's why we
                want to supply you with high-quality horse riding gear and horse accessories</p>
        </div>
    </div>
    <!-- Footer -->
    <footer class="text-center">
        <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
    </footer>
                <?php
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