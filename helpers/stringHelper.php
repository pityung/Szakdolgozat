<?php

class StringHelper
{
    public static function safe_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public static function checkName($name, $msg)
    {
        if (empty($_POST['username']) or empty($_POST['last_name']) or empty($_POST['first_name']) or empty($_POST['phone']) or empty($_POST['email']) or empty($_POST['password'])) {
            $msg .= "The datas cannot contains full spaces!";
        }
        if (!preg_match("/^[a-záéíóöőúüűÁÉÍÓÖŐÚÜŰA-Z-' ]*$/", $_POST['last_name'])) {
            $msg .= "The lastname only can contains letters and blank spaces!";
        }
        if (!preg_match("/^[a-záéíóöőúüűÁÉÍÓÖŐÚÜŰA-Z-' ]*$/", $_POST['first_name'])) {
            $msg .= "The firstname only can contains letters and blank spaces!";
        }
        if (mb_strlen($_POST['last_name'] or $_POST['first_name']) > 100) {
            $msg .= "The name only can contain 100 letter! ";
        }
        if (mb_strlen($_POST['last_name']) < 5) {
            $msg .= "The lastname should contain minimum 5 letter!";
        }
        if (mb_strlen($_POST['first_name']) < 5) {
            $msg .= "The firstname should contain minimum 5 letter!";
        }
        return $msg;
    }
}
