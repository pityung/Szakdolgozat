<?php
class Propertie
{
    function getPropertie()
    {
        $sql = "SELECT `riding_style` FROM `" . DB_PREFIX . "properties`";
        $result = DataBase::$conn->query($sql);
        $properties[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($properties, $row['riding_style']);
                }
            }
        }
        return $properties;
    }
}

