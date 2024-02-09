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
        if (preg_match("/^[ ]*$/", $_POST['username']) and !preg_match("/^[a-záéíóöőúüűÁÉÍÓÖŐÚÜŰA-Z]*$/", $_POST['username'])) {
            $msg .= "The datas cannot contains full spaces!";
        }
        if (!preg_match("/^[a-záéíóöőúüűÁÉÍÓÖŐÚÜŰA-Z-' ]*$/", $_POST['last_name'])) {
            $msg .= "The lastname only can contains letters and blank spaces!";
        }
        if (!preg_match("/^[a-záéíóöőúüűÁÉÍÓÖŐÚÜŰA-Z-' ]*$/", $_POST['first_name'])) {
            $msg .= "The firstname only can contains letters and blank spaces!";
        }
        if (mb_strlen($_POST['last_name'] or $_POST['first_name']) > 30) {
            $msg .= "The name only can contain 30 letter! ";
        }
        if (mb_strlen($_POST['last_name']) < 4) {
            $msg .= "The lastname should contain minimum 4 letter!";
        }
        if (mb_strlen($_POST['first_name']) < 4) {
            $msg .= "The firstname should contain minimum 4 letter!";
        }
        return $msg;
    }
}
