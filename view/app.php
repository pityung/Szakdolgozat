<?php
session_start();
require "../helpers/mysql.php";
require "../control/MainController.php";
$db = new DataBase;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>App</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../styles/appMain.css">
    <script src="../scripts/app.js"></script>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
    <nav class="navbar navbar-default navbar-fixed-top" id="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="../images/logo.jpg" alt="LOGO" id="darkmode" onclick="Darkmode()">
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../index.php">HOME</a></li>
                    <?php
                    if (empty($_SESSION["isLoginedIn"])) {
                        echo '<li><a href="../view/login.php"><span class="glyphicon glyphicon-user" id="user"></span></a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    echo '
<form method="post">
<div class="container">
<h2>Choose a Gender!</h2>
<div class="gender">
<input type="radio" name="gender" value="Male">
<span>Male</span>
</div>
<div class="gender">
<input type="radio" name="gender" value="Female" class="radio-btn">
<span>Female</span>
</div>
</div>

<div class="container">
<h2>Choose a Riding Style!</h2>
<select name="Riding_style_menu" class="riding-select">';
    for ($i = 1; $i < count($properties); $i++) {
        echo '
<option value="' . str_replace(" ", "_", $properties[$i]) . '" >' . $properties[$i] . '</option>';
    }
    echo '
</select>
   
</div>

<div class="container">
<div class="gender">
<input type="checkbox" class="checkbox-btn" id="myCheck" onclick="colorFunction()">
<span>Chose by Color</span>
</div>
<div class="gender">



<select name="color_menu" class="riding-select" style="display:none" id="color">
<option value="White">White</option>
<option value="Black">Black</option>
<option value="Pink">Pink </option>
<option value="Green">Green</option>
<option value="Yellow">Yellow</option>
<option value="Blue">Blue</option>
<option value="Grey">Grey</option>
<option value="Red">Red</option>
</select>
<script>
function colorFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("color");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
</div>
<input type="submit" value="Send!" class="submit-btn">
</div>

</form>';
    ?>

</body>

</html>




