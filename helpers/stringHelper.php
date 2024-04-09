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
    function checkName($msg)
    {

        if (preg_match("/^[ ]*$/", $_POST['username']) and !preg_match("/^[a-záéíóöőúüűÁÉÍÓÖŐÚÜŰA-Z]*$/", $_POST['username'])) {
            $msg .= "The datas cannot contains full spaces! ";
        }
        if (!preg_match("/^[a-záéíóöőúüűÁÉÍÓÖŐÚÜŰA-Z-' ]*$/", $_POST['last_name'])) {
            $msg .= "The lastname only can contains letters and blank spaces! ";
        }
        if (!preg_match("/^[a-záéíóöőúüűÁÉÍÓÖŐÚÜŰA-Z-' ]*$/", $_POST['first_name'])) {
            $msg .= "The firstname only can contains letters and blank spaces! ";
        }
        if (mb_strlen($_POST['last_name'] or $_POST['first_name']) > 30) {
            $msg .= "The name only can contain 30 letter! ";
        }
        if (mb_strlen($_POST['last_name']) < 4) {
            $msg .= "The lastname should contain minimum 4 letter! ";
        }
        if (mb_strlen($_POST['first_name']) < 4) {
            $msg .= "The firstname should contain minimum 4 letter! ";
        }
        if (!($_POST['password'] == $_POST['password_again'])) {
            $msg .= "the confirmed password does not match your password! ";
        }
        if (mb_strlen($_POST['password']) < 12) {
            $msg .= "the password must contain 12 characters! ";
        }
        if (!preg_match('`[!"#$%&\'()*+,-./:;<=>?@\^_]`', $_POST['password'])) {
            $msg .= "the password must contain one special character! ";
        }
        if (!preg_match('`[0-9]`', $_POST['password'])) {
            $msg .= "the password must contain minimum one number ,one lower and one uppercase character! ";
        }
        if (!preg_match('`[a-z]`', $_POST['password'])) {
            $msg .= "the password must contain minimum one number ,one lower and one uppercase character! ";
        }
        if (!preg_match('`[A-Z]`', $_POST['password'])) {
            $msg .= "the password must contain minimum one number ,one lower and one uppercase character! ";
        }
        if (!preg_match('`[+]`', $_POST['phone'])) {
            $msg .= "the phone number should contain a '+' ";
        }
        $plusMark = strpos($_POST['phone'], "+");
        if ($plusMark != 0) {
            $msg .= "not a correct form at phone nnumber! the first element must be a '+' ";
        }
        $data = $_POST['phone'];
        $formattedPhonenumber = substr($data, strpos($data, "+") + 1);
        if (!preg_match('`[0-9]`', $formattedPhonenumber)) {
            $msg .= "not a correct form at phonen umber! the phone number only contains numbers! ";
        }
        if (mb_strlen($_POST['phone']) != 12) {
            $msg .= "the phone number is 12 character long! including the '+' character Like: +06203893109";
        }
        if (!preg_match('`[@.]`', $_POST['email'])) {
            $msg .= "the email should contain a '@' and a '.' ";
        }

        return $msg;
    }

    function checkUpdate($msg)
    {
        if (!preg_match("/^[a-záéíóöőúüűÁÉÍÓÖŐÚÜŰA-Z-' ]*$/", $_POST['last_name_edit'])) {
            $msg .= "The lastname only can contains letters and blank spaces! ";
        }
        if (!preg_match("/^[a-záéíóöőúüűÁÉÍÓÖŐÚÜŰA-Z-' ]*$/", $_POST['first_name_edit'])) {
            $msg .= "The firstname only can contains letters and blank spaces! ";
        }
        if (mb_strlen($_POST['last_name_edit'] or $_POST['first_name_edit']) > 30) {
            $msg .= "The name only can contain 30 letter! ";
        }
        if (mb_strlen($_POST['last_name_edit']) < 4) {
            $msg .= "The lastname should contain minimum 4 letter! ";
        }
        if (mb_strlen($_POST['first_name_edit']) < 4) {
            $msg .= "The firstname should contain minimum 4 letter! ";
        }
        if (!preg_match('`[+]`', $_POST['phone_edit'])) {
            $msg .= "the phone number should contain a '+' ";
        }
        $plusMark = strpos($_POST['phone_edit'], "+");
        if ($plusMark != 0) {
            $msg .= "not a correct form at phone nnumber! the first element must be a '+' ";
        }
        $data = $_POST['phone_edit'];
        $formattedPhonenumber = substr($data, strpos($data, "+") + 1);
        if (!preg_match('`[0-9]`', $formattedPhonenumber)) {
            $msg .= "not a correct form at phonen umber! the phone number only contains numbers! ";
        }
        if (mb_strlen($_POST['phone_edit']) != 12) {
            $msg .= "the phone number is 12 character long! including the '+' character Like: +06203893109";
        }
        if (!preg_match('`[@.]`', $_POST['email_edit'])) {
            $msg .= "the email should contain a '@' and a '.' ";
        }

        return $msg;
    }
}
