<?php
function getClass()
{

    $sql = "SELECT * FROM project_database;";
    $result = DataBase::$conn->query($sql);

    return $result;
}


?>