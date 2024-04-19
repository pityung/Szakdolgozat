<?php
$db = new DataBase;
class appProducts{
    

    
    function getselectedCartItemByColor($gender, $style, $color)
    {
        $sql = 'SELECT `nckp1tyung_product`.*, `nckp1tyung_product_category`.`name` AS "category_name", `nckp1tyung_properties`.`riding_style`
        FROM `' . DB_PREFIX . 'product` 
            INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id` 
            INNER JOIN `nckp1tyung_properties` ON `nckp1tyung_product`.`propertie_id` = `nckp1tyung_properties`.`id`WHERE `nckp1tyung_product`.`sex` LIKE "'.$gender.'" AND `nckp1tyung_properties`.`riding_style` LIKE "'.$style.'" AND `nckp1tyung_product`.`color` LIKE "'.$color.'"
        ';
        $result = DataBase::$conn->query($sql);
        $userCartItemes[0] = "";
        $userCartItemes[1] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($userCartItemes, str_replace(" ", "_", $row['category_name']."_".$row['name']));
                }
            }
        }
        return $userCartItemes;
    }
    function getselectedCartItemPricesByColor($gender, $style, $color){
        $sql = 'SELECT `nckp1tyung_product`.*, `nckp1tyung_product_category`.`name` AS "category_name", `nckp1tyung_properties`.`riding_style`
        FROM `' . DB_PREFIX . 'product` 
            INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id` 
            INNER JOIN `nckp1tyung_properties` ON `nckp1tyung_product`.`propertie_id` = `nckp1tyung_properties`.`id`WHERE `nckp1tyung_product`.`sex` LIKE "'.$gender.'" AND `nckp1tyung_properties`.`riding_style` LIKE "'.$style.'" AND `nckp1tyung_product`.`color` LIKE "'.$color.'"
        ';   
        $result = DataBase::$conn->query($sql);
        $userCartItemesPrices[0] = "";
        $userCartItemesPrices[1] = "";
        if ($result->num_rows > 0) {

            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($userCartItemesPrices, $row['price']);
                }
            }
        }
        return $userCartItemesPrices;
    }

    function getselectedCartItemIdByColor($gender, $style, $color){
        $sql = 'SELECT `nckp1tyung_product`.*, `nckp1tyung_product_category`.`name` AS "category_name", `nckp1tyung_properties`.`riding_style`
        FROM `' . DB_PREFIX . 'product` 
            INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id` 
            INNER JOIN `nckp1tyung_properties` ON `nckp1tyung_product`.`propertie_id` = `nckp1tyung_properties`.`id`WHERE `nckp1tyung_product`.`sex` LIKE "'.$gender.'" AND `nckp1tyung_properties`.`riding_style` LIKE "'.$style.'" AND `nckp1tyung_product`.`color` LIKE "'.$color.'"
        ';     
        $result = DataBase::$conn->query($sql);
        $userCartitmesId[0] = "";
        $userCartitmesId[1] = "";
        if ($result->num_rows > 0) {

            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($userCartitmesId, $row['id']);
                }
            }
        }
        return $userCartitmesId;
    }
    function getselectedCartItemQuantityByColor($gender, $style, $color){
        $sql = 'SELECT `nckp1tyung_product`.*, `nckp1tyung_product_category`.`name` AS "category_name", `nckp1tyung_properties`.`riding_style`
        FROM `' . DB_PREFIX . 'product` 
            INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id` 
            INNER JOIN `nckp1tyung_properties` ON `nckp1tyung_product`.`propertie_id` = `nckp1tyung_properties`.`id`WHERE `nckp1tyung_product`.`sex` LIKE "'.$gender.'" AND `nckp1tyung_properties`.`riding_style` LIKE "'.$style.'" AND `nckp1tyung_product`.`color` LIKE "'.$color.'"
        ';     
        $result = DataBase::$conn->query($sql);
        $userCartitmesId[0] = "";
        $userCartitmesId[1] = "";
        if ($result->num_rows > 0) {

            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($userCartitmesId, $row['quantity']);
                }
            }
        }
        return $userCartitmesId;
    }

    function getselectedCartItem($gender, $style)
    {
        $sql = 'SELECT `nckp1tyung_product`.*, `nckp1tyung_product_category`.`name` AS "category_name", `nckp1tyung_properties`.`riding_style`
        FROM `' . DB_PREFIX . 'product` 
            INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id` 
            INNER JOIN `nckp1tyung_properties` ON `nckp1tyung_product`.`propertie_id` = `nckp1tyung_properties`.`id`WHERE `nckp1tyung_product`.`sex` LIKE "'.$gender.'" AND `nckp1tyung_properties`.`riding_style` LIKE "'.$style.'" 
        ';
        $result = DataBase::$conn->query($sql);
        $userCartItemes[0] = "";
        $userCartItemes[1] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($userCartItemes, str_replace(" ", "_", $row['category_name']."_".$row['name']));
                }
            }
        }
        return $userCartItemes;
    }
    function getselectedCartItemPrices($gender, $style){
        $sql = 'SELECT `nckp1tyung_product`.*, `nckp1tyung_product_category`.`name` AS "category_name", `nckp1tyung_properties`.`riding_style`
        FROM `' . DB_PREFIX . 'product` 
            INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id` 
            INNER JOIN `nckp1tyung_properties` ON `nckp1tyung_product`.`propertie_id` = `nckp1tyung_properties`.`id`WHERE `nckp1tyung_product`.`sex` LIKE "'.$gender.'" AND `nckp1tyung_properties`.`riding_style` LIKE "'.$style.'" 
        ';
        $result = DataBase::$conn->query($sql);
        $userCartItemesPrices[0] = "";
        $userCartItemesPrices[1] = "";
        if ($result->num_rows > 0) {

            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($userCartItemesPrices, $row['price']);
                }
            }
        }
        return $userCartItemesPrices;
    }

    function getselectedCartItemQuantity($gender, $style){
        $sql = 'SELECT `nckp1tyung_product`.*, `nckp1tyung_product_category`.`name` AS "category_name", `nckp1tyung_properties`.`riding_style`
        FROM `' . DB_PREFIX . 'product` 
            INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id` 
            INNER JOIN `nckp1tyung_properties` ON `nckp1tyung_product`.`propertie_id` = `nckp1tyung_properties`.`id`WHERE `nckp1tyung_product`.`sex` LIKE "'.$gender.'" AND `nckp1tyung_properties`.`riding_style` LIKE "'.$style.'" 
        ';
        $result = DataBase::$conn->query($sql);
        $userCartItemesPrices[0] = "";
        $userCartItemesPrices[1] = "";
        if ($result->num_rows > 0) {

            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($userCartItemesPrices, $row['quantity']);
                }
            }
        }
        return $userCartItemesPrices;
    }

    function getselectedCartItemId($gender, $style){
        $sql = 'SELECT `nckp1tyung_product`.*, `nckp1tyung_product_category`.`name` AS "category_name", `nckp1tyung_properties`.`riding_style`
        FROM `' . DB_PREFIX . 'product` 
            INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id` 
            INNER JOIN `nckp1tyung_properties` ON `nckp1tyung_product`.`propertie_id` = `nckp1tyung_properties`.`id`WHERE `nckp1tyung_product`.`sex` LIKE "'.$gender.'" AND `nckp1tyung_properties`.`riding_style` LIKE "'.$style.'" 
        ';
        $result = DataBase::$conn->query($sql);
        $userCartitmesId[0] = "";
        $userCartitmesId[1] = "";
        if ($result->num_rows > 0) {

            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($userCartitmesId, $row['id']);
                }
            }
        }
        return $userCartitmesId;
    }
}

?>