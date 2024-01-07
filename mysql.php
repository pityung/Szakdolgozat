<?php

$servername = "localhost";
$username = "Nick";
$password = "(jtc-t1@]g41Kq77";
$db = "teszt";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
